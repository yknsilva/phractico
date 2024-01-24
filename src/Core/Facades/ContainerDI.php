<?php

declare(strict_types=1);

namespace Phractico\Core\Facades;

use Phractico\Core\Infrastructure\DI\ContainerRegistry;

class ContainerDI
{
    public static function get(string $entryKey)
    {
        $container = ContainerRegistry::getContainer();
        return $container->get($entryKey);
    }
}
