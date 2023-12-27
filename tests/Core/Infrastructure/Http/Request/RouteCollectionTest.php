<?php

namespace Phractico\Tests\Core\Infrastructure\Http\Request;

use PHPUnit\Framework\Attributes\CoversClass;
use Phractico\Core\Infrastructure\Http\Request\Route;
use Phractico\Core\Infrastructure\Http\Request\RouteCollection;
use PHPUnit\Framework\TestCase;
use Phractico\Tests\Helpers\API\Http\FakeController;

#[CoversClass(RouteCollection::class)]
final class RouteCollectionTest extends TestCase
{
    public function testCanDefineRoutesForController(): void
    {
        $routeCollection = RouteCollection::for(new FakeController());
        $routeCollection->add(Route::create('GET', '/getting'), 'get_action');
        $routeCollection->add(Route::create('POST', '/posting'), 'post_action');
        $routeCollection->add(Route::create('DELETE', '/deleting'), 'delete_action');

        $routesMapping = $routeCollection->getRoutesMapping();

        $this->assertCount(3, $routesMapping);
        $this->assertArrayHasKey('get_action', $routesMapping);
        $this->assertArrayHasKey('post_action', $routesMapping);
        $this->assertArrayHasKey('delete_action', $routesMapping);
    }
}
