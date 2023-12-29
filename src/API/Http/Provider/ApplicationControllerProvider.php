<?php

declare(strict_types=1);

namespace Phractico\API\Http\Provider;

use Phractico\API\Http\Controller\ExampleController;
use Phractico\Core\Infrastructure\Http\ControllerProvider;

class ApplicationControllerProvider implements ControllerProvider
{
    public function getControllers(): array
    {
        return [
            ExampleController::class,
        ];
    }
}
