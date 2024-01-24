<?php

declare(strict_types=1);

namespace Phractico;

use Phractico\Core\Bootstrap;
use Phractico\Core\Infrastructure\Http\Request\HttpRequestInterceptor;
use Phractico\Core\Infrastructure\Http\Request\RequestHandler;
use Phractico\Core\Infrastructure\Http\Request\RouteHandler;
use Phractico\Core\Infrastructure\Http\Response\ResponseHandler;
use Psr\Container\ContainerInterface;

final class Application
{
    public function __construct(
        private readonly ContainerInterface $container,
    ) {
        Bootstrap::init($container);
    }

    public function run(): void
    {
        $httpRequestInterceptor = $this->container->get(HttpRequestInterceptor::class);
        $request = RequestHandler::handle($httpRequestInterceptor);
        $response = RouteHandler::handle($request);
        $responseHandler = ResponseHandler::handle($response);
        $responseHandler->send();
    }
}
