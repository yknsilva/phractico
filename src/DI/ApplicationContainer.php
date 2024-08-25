<?php

declare(strict_types=1);

namespace App\DI;

use App\API\Http\Provider\ApplicationControllerProvider;
use App\API\Http\Request\SymfonyHttpRequestInterceptor;
use App\Database\ApplicationDatabaseProvider;
use Phractico\Core\Infrastructure\Database\DatabaseProvider;
use Phractico\Core\Infrastructure\DI\Container;
use Phractico\Core\Infrastructure\DI\ContainerRegistry;
use Phractico\Core\Infrastructure\Http\ControllerProvider;
use Phractico\Core\Infrastructure\Http\Request\HttpRequestInterceptor;
use Psr\Container\ContainerInterface;

class ApplicationContainer
{
    public static function resolve(): ContainerInterface
    {
        $container = Container::create();
        $container->set(HttpRequestInterceptor::class, fn() => new SymfonyHttpRequestInterceptor());
        $container->set(ControllerProvider::class, fn() => new ApplicationControllerProvider());
        $container->set(DatabaseProvider::class, fn() => new ApplicationDatabaseProvider());

        ContainerRegistry::clear();
        ContainerRegistry::setContainer($container);

        return $container;
    }
}
