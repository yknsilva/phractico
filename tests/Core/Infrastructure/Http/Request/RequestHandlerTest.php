<?php

namespace Phractico\Tests\Core\Infrastructure\Http\Request;

use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use Phractico\Core\Infrastructure\Http\Request\HttpRequestInterceptor;
use Phractico\Core\Infrastructure\Http\Request\RequestHandler;

class RequestHandlerTest extends TestCase
{
    public function testHandleShouldReturnInterceptedRequest(): void
    {
        $requestMethod = 'POST';
        $requestUri = '/test';

        $httpRequestInterceptorStub = $this->createStub(HttpRequestInterceptor::class);
        $httpRequestInterceptorStub
            ->method('intercept')
            ->willReturn(new Request($requestMethod, $requestUri));

        $handledRequest = RequestHandler::handle($httpRequestInterceptorStub);

        $this->assertEquals($requestMethod, $handledRequest->getMethod());
        $this->assertEquals($requestUri, (string) $handledRequest->getUri());
    }
}
