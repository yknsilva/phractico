<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Http;

use Phractico\Core\Infrastructure\Http\Request\RouteCollection;

interface Controller
{
    public function routes(): RouteCollection;
}
