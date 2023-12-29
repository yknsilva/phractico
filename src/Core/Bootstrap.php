<?php

declare(strict_types=1);

namespace Phractico\Core;

use Phractico\Core\Infrastructure\Http\ControllerProvider;
use Phractico\Core\Infrastructure\Http\Request\RouteHandler;

class Bootstrap
{
    public static function init(ControllerProvider $controllerProvider): void
    {
        self::routing($controllerProvider->getControllers());
    }

    private static function routing(array $controllers): void
    {
        RouteHandler::init($controllers);
    }
}
