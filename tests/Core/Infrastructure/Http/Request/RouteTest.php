<?php

namespace Phractico\Tests\Core\Infrastructure\Http\Request;

use PHPUnit\Framework\Attributes\CoversClass;
use Phractico\Core\Infrastructure\Http\Request\Route;
use PHPUnit\Framework\TestCase;

#[CoversClass(Route::class)]
final class RouteTest extends TestCase
{
    public function testMatchShouldReturnTrueForRouteComparison(): void
    {
        $route = Route::create('POST', '/resource');
        $routeToBeCompared = Route::create('POST', '/resource');

        $this->assertTrue($route->match($routeToBeCompared));
    }

    public function testMatchShouldReturnFalseForRouteComparison(): void
    {
        $route = Route::create('POST', '/resource');
        $routeToBeCompared = Route::create('GET', '/anotherResource');

        $this->assertFalse($route->match($routeToBeCompared));
    }
}
