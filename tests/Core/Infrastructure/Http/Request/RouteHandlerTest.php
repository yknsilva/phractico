<?php

namespace Phractico\Tests\Core\Infrastructure\Http\Request;

use App\Tests\Helpers\API\Http\FakeController;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use PHPUnit\Framework\TestCase;
use Phractico\Core\Infrastructure\Http\Request\HttpRequestInterceptor;
use Phractico\Core\Infrastructure\Http\Request\RequestHandler;
use Phractico\Core\Infrastructure\Http\Request\RouteHandler;
use Psr\Http\Message\RequestInterface;

class RouteHandlerTest extends TestCase
{
    public function testHandleShouldRouteRequestToExpectedController(): void
    {
        $fakeController = new FakeController();
        $controllerMapping = [get_class($fakeController)];
        RouteHandler::init($controllerMapping);

        $request = new Request('POST', '/fake');
        $response = RouteHandler::handle($request);
        $responseBody = $response->getBody()->getContents();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($responseBody);
        $this->assertEquals(json_encode(['message' => 'FakeController']), $responseBody);
    }

    public function testHandleShouldReturnInternalServerErrorOnUndefinedControllerMapping(): void
    {
        $controllerMapping = [];
        RouteHandler::init($controllerMapping);

        $request = new Request('POST', '/fake');
        $response = RouteHandler::handle($request);
        $responseBody = $response->getBody()->getContents();

        $this->assertEquals(500, $response->getStatusCode());
        $this->assertJson($responseBody);
        $this->assertEquals(json_encode(['error' => 'Internal Server Error']), $responseBody);
    }

    public function testHandlerShouldMatchUrisWithQueryParams(): void
    {

        $fakeController = new FakeController();
        $controllerMapping = [get_class($fakeController)];
        RouteHandler::init($controllerMapping);

        $requestUri = new Uri('/fake?param=1&paramm=2');
        $request = new Request('POST', $requestUri);
        $response = RouteHandler::handle($request);
        $responseBody = $response->getBody()->getContents();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($responseBody);
        $this->assertEquals(json_encode(['message' => 'FakeController']), $responseBody);
    }

    public function testHandlerShouldBeAbleToAccessTheRequestObject(): void
    {

        $fakeController = new FakeController();
        $controllerMapping = [get_class($fakeController)];
        RouteHandler::init($controllerMapping);

        $requestUri = new Uri('/fakeWithRequestInterface?param=1&paramm=2');
        $request = new Request('POST', $requestUri);
        $httpRequestInterceptor = new class($request) implements HttpRequestInterceptor {
            public function __construct(private RequestInterface $request) {}
            public function intercept(): RequestInterface
            {
                return $this->request;
            }
        };

        RequestHandler::handle($httpRequestInterceptor);
        $response = RouteHandler::handle($request);
        $responseBody = $response->getBody()->getContents();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($responseBody);
        $this->assertEquals(json_encode(['message' => 'FakeController with params: param=1&paramm=2']), $responseBody);
    }
}
