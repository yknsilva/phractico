<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Http\Request;

use Psr\Http\Message\UriInterface;

class Route
{
    private function __construct(
        public readonly string $httpMethod,
        public readonly string $resource,
    ) {}

    public static function create(string $httpMethod, string|UriInterface $resource): self
    {
        if ($resource instanceof UriInterface) {
            $resource = $resource->getPath();
        }
        return new self($httpMethod, $resource);
    }

    public function match(Route $route): bool
    {
        return $this->httpMethod === $route->httpMethod
            && $this->resource === $route->resource;
    }
}
