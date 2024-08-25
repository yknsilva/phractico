<?php

declare(strict_types=1);

namespace App\API\Http\Provider;

use App\API\Http\Controller\ExampleController;
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
