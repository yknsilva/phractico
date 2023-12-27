<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Http\Request;

class Route
{
    private function __construct(
        public readonly string $httpMethod,
        public readonly string $resource,
    ) {
    }

    public static function create(string $httpMethod, string $resource): self
    {
        return new self($httpMethod, $resource);
    }

    public function match(Route $route): bool
    {
        return $this->httpMethod === $route->httpMethod
            && $this->resource === $route->resource;
    }
}
