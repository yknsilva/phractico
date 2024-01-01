<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Http\Request;

use Psr\Http\Message\RequestInterface;

class RequestHandler
{
    private static RequestInterface $incomingRequest;

    public static function handle(HttpRequestInterceptor $interceptor): RequestInterface
    {
        $request = $interceptor->intercept();
        self::$incomingRequest = $request;
        return $request;
    }

    public static function getIncomingRequest(): RequestInterface
    {
        return self::$incomingRequest;
    }
}
