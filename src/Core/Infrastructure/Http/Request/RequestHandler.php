<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Http\Request;

use Psr\Http\Message\RequestInterface;

class RequestHandler
{
    public static function handle(HttpRequestInterceptor $interceptor): RequestInterface
    {
        return $interceptor->intercept();
    }
}
