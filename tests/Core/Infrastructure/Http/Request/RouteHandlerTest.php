<?php

namespace Phractico\Tests\Core\Infrastructure\Http\Request;

use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use Phractico\Core\Infrastructure\Http\Request\RouteHandler;
use Phractico\Tests\Helpers\API\Http\FakeController;

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
}
