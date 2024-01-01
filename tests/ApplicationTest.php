<?php

namespace Phractico\Tests;

use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use Phractico\Application;
use Phractico\Core\Infrastructure\Database\DatabaseProvider;
use Phractico\Core\Infrastructure\Http\ControllerProvider;
use Phractico\Core\Infrastructure\Http\Request\HttpRequestInterceptor;
use Phractico\Tests\Helpers\API\Http\FakeController;
use Phractico\Tests\Helpers\Database\Connection\DummyDatabase;

class ApplicationTest extends TestCase
{
    public function testApplication(): void
    {
        $controllerProviderStub = $this->createStub(ControllerProvider::class);
        $controllerProviderStub
            ->method('getControllers')
            ->willReturn([get_class($fakeController = new FakeController())]);

        $databaseProviderStub = $this->createStub(DatabaseProvider::class);
        $databaseProviderStub
            ->method('getConnection')
            ->willReturn(new DummyDatabase());

        $httpRequestInterceptorStub = $this->createStub(HttpRequestInterceptor::class);
        $httpRequestInterceptorStub
            ->method('intercept')
            ->willReturn(new Request('POST', '/fake'));

        $fakeControllerResponse = $fakeController->fake()->render();
        $this->expectOutputString($fakeControllerResponse->getBody()->getContents());

        $application = new Application(
            $httpRequestInterceptorStub,
            $controllerProviderStub,
            $databaseProviderStub,
        );
        $application->run();
    }
}
