<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Http\Request;

use Psr\Http\Message\RequestInterface;

interface HttpRequestInterceptor
{
    public function intercept(): RequestInterface;
}
