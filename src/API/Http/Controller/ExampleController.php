<?php

declare(strict_types=1);

namespace Phractico\API\Http\Controller;

use Phractico\Core\Infrastructure\Http\Controller;
use Phractico\Core\Infrastructure\Http\Request\Route;
use Phractico\Core\Infrastructure\Http\Request\RouteCollection;
use Phractico\Core\Infrastructure\Http\Response;
use Phractico\Core\Infrastructure\Http\Response\JsonResponse;

class ExampleController implements Controller
{
    public function routes(): RouteCollection
    {
        $routeCollection = RouteCollection::for($this);
        $routeCollection->add(Route::create('GET', '/example'), 'itWorks');
        return $routeCollection;
    }

    public function itWorks(): Response
    {
        $body = [
            'status' => 'success',
            'message' => 'It works! :)'
        ];
        return new JsonResponse(200, $body);
    }
}
