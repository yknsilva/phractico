<?php

declare(strict_types=1);

namespace Phractico\Core;

use Phractico\Core\Infrastructure\Database\Connection;
use Phractico\Core\Infrastructure\Database\DatabaseConnection;
use Phractico\Core\Infrastructure\Database\DatabaseProvider;
use Phractico\Core\Infrastructure\Http\ControllerProvider;
use Phractico\Core\Infrastructure\Http\Request\RouteHandler;

class Bootstrap
{
    public static function init(
        ControllerProvider $controllerProvider,
        DatabaseProvider $databaseProvider,
    ): void {
        self::routing($controllerProvider->getControllers());
        self::database($databaseProvider->getConnection());
    }

    private static function routing(array $controllers): void
    {
        RouteHandler::init($controllers);
    }

    private static function database(Connection $databaseConnection): void
    {
        DatabaseConnection::setConnection($databaseConnection);
    }
}
