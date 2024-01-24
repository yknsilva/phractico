<?php

declare(strict_types=1);

namespace Phractico\DI;

use Phractico\API\Http\Provider\ApplicationControllerProvider;
use Phractico\API\Http\Request\SymfonyHttpRequestInterceptor;
use Phractico\Core\Infrastructure\Database\DatabaseProvider;
use Phractico\Core\Infrastructure\DI\Container;
use Phractico\Core\Infrastructure\DI\ContainerRegistry;
use Phractico\Core\Infrastructure\Http\ControllerProvider;
use Phractico\Core\Infrastructure\Http\Request\HttpRequestInterceptor;
use Phractico\Database\ApplicationDatabaseProvider;
use Psr\Container\ContainerInterface;

class ApplicationContainer
{
    public static function resolve(): ContainerInterface
    {
        $container = Container::create();
        $container->set(HttpRequestInterceptor::class, fn () => new SymfonyHttpRequestInterceptor());
        $container->set(ControllerProvider::class, fn () => new ApplicationControllerProvider());
        $container->set(DatabaseProvider::class, fn () => new ApplicationDatabaseProvider());

        ContainerRegistry::clear();
        ContainerRegistry::setContainer($container);

        return $container;
    }
}
