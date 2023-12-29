<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Http;

interface ControllerProvider
{
    /**
     * Returns a list of available controllers.
     *
     * @return string[]
     * Fully qualified names of controller classes.
     * Each string represents a class name that is a subtype of Controller::class
     */
    public function getControllers(): array;
}
