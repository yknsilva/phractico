<?php

declare(strict_types=1);

namespace Phractico;

use Phractico\Core\Bootstrap;
use Phractico\Core\Infrastructure\Http\Request\RequestHandler;
use Phractico\Core\Infrastructure\Http\Request\RouteHandler;
use Phractico\Core\Infrastructure\Http\Response\ResponseHandler;

final class Application
{
    public function __construct()
    {
        Bootstrap::init();
    }

    public function run(): void
    {
        $request = RequestHandler::handle();
        $response = RouteHandler::handle($request);
        $responseHandler = ResponseHandler::handle($response);
        $responseHandler->send();
    }
}
