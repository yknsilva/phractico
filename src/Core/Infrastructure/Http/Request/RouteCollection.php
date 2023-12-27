<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Http\Request;

use Phractico\Core\Infrastructure\Http\Controller;

class RouteCollection
{
    private array $routes = [];

    private function __construct(private readonly string $controllerClass)
    {
        $this->routes[$controllerClass] = [];
    }

    public static function for(Controller $controller)
    {
        $controllerClass = get_class($controller);
        return new self($controllerClass);
    }

    public function add(Route $route, string $controllerAction): self
    {
        $this->routes[$this->controllerClass] += [$controllerAction => $route];
        return $this;
    }

    public function getRoutesMapping(): array
    {
        return $this->routes[$this->controllerClass];
    }
}
