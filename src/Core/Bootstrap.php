<?php

declare(strict_types=1);

namespace Phractico\Core;

use Phractico\API\Http\Controller\ExampleController;
use Phractico\Core\Infrastructure\Http\Controller;
use Phractico\Core\Infrastructure\Http\Request\RouteHandler;

class Bootstrap
{
    public static function init(): void
    {
        self::routing(self::getControllers());
    }

    private static function routing(array $controllers): void
    {
        RouteHandler::init($controllers);
    }

    private static function getControllers(): array
    {
        return [
            ExampleController::class,
        ];
    }
}
