<?php

declare(strict_types=1);

namespace App\API\Http\Request;

use GuzzleHttp\Psr7\Request;
use Phractico\Core\Infrastructure\Http\Request\HttpRequestInterceptor;
use Psr\Http\Message\RequestInterface;
use Symfony\Component\HttpFoundation\Request as SymfonyRequestComponent;

class SymfonyHttpRequestInterceptor implements HttpRequestInterceptor
{
    public function intercept(): RequestInterface
    {
        $request = SymfonyRequestComponent::createFromGlobals();
        return new Request(
            $request->getMethod(),
            $request->getUri(),
            $request->headers->all(),
            $request->getContent()
        );
    }
}
