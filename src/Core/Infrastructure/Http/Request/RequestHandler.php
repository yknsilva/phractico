<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Http\Request;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Symfony\Component\HttpFoundation\Request as APIRequest;

class RequestHandler
{
    public static function handle(): RequestInterface
    {
        $request = APIRequest::createFromGlobals();
        return new Request(
            $request->getMethod(),
            $request->getUri(),
            $request->headers->all(),
            $request->getContent()
        );
    }
}
