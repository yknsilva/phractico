<?php

declare(strict_types=1);

namespace Phractico;

use Phractico\Core\Bootstrap;
use Phractico\Core\Infrastructure\Database\DatabaseProvider;
use Phractico\Core\Infrastructure\Http\ControllerProvider;
use Phractico\Core\Infrastructure\Http\Request\HttpRequestInterceptor;
use Phractico\Core\Infrastructure\Http\Request\RequestHandler;
use Phractico\Core\Infrastructure\Http\Request\RouteHandler;
use Phractico\Core\Infrastructure\Http\Response\ResponseHandler;

final class Application
{
    public function __construct(
        private readonly HttpRequestInterceptor $httpRequestInterceptor,
        ControllerProvider $controllerProvider,
        DatabaseProvider $databaseProvider,
    ) {
        Bootstrap::init($controllerProvider, $databaseProvider);
    }

    public function run(): void
    {
        $request = RequestHandler::handle($this->httpRequestInterceptor);
        $response = RouteHandler::handle($request);
        $responseHandler = ResponseHandler::handle($response);
        $responseHandler->send();
    }
}
