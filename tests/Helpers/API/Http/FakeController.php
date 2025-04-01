<?php

declare(strict_types=1);

namespace App\Tests\Helpers\API\Http;

use Phractico\Core\Infrastructure\Http\Controller;
use Phractico\Core\Infrastructure\Http\Request\RequestHandler;
use Phractico\Core\Infrastructure\Http\Request\Route;
use Phractico\Core\Infrastructure\Http\Request\RouteCollection;
use Phractico\Core\Infrastructure\Http\Response;
use Phractico\Core\Infrastructure\Http\Response\JsonResponse;
use Psr\Http\Message\RequestInterface;

class FakeController implements Controller
{
    public function routes(): RouteCollection
    {
        $collection = RouteCollection::for($this);
        $collection->add(Route::create('POST', '/fake'), 'fake');
        $collection->add(Route::create('POST', '/fakeWithRequestInterface'), 'fakeWithRequestInterface');
        return $collection;
    }

    public function fake(): Response
    {
        return new JsonResponse(
            status: 200,
            body: ['message' => 'FakeController']
        );
    }

    public function fakeWithRequestInterface(): Response
    {
        $request = RequestHandler::getIncomingRequest();
        return new JsonResponse(
            status: 200,
            body: ['message' => 'FakeController with params: ' . $request->getUri()->getQuery()],
        );
    }
}
