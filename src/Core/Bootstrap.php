<?php

declare(strict_types=1);

namespace Phractico\Core;

use Phractico\Core\Infrastructure\Database\DatabaseConnection;
use Phractico\Core\Infrastructure\Database\DatabaseProvider;
use Phractico\Core\Infrastructure\Http\ControllerProvider;
use Phractico\Core\Infrastructure\Http\Request\RouteHandler;
use Psr\Container\ContainerInterface;

class Bootstrap
{
    public static function init(ContainerInterface $container): void
    {
        self::routing($container);
        self::database($container);
    }

    private static function routing(ContainerInterface $container): void
    {
        $controllerProvider = $container->get(ControllerProvider::class);
        $controllers = $controllerProvider->getControllers();
        RouteHandler::init($controllers);
    }

    private static function database(ContainerInterface $container): void
    {
        $databaseProvider = $container->get(DatabaseProvider::class);
        $databaseConnection = $databaseProvider->getConnection();
        DatabaseConnection::setConnection($databaseConnection);
    }
}
