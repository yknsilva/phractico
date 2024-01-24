<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\DI;

use Phractico\Core\Infrastructure\DI\Exception\MissingContainerRegisterException;
use Psr\Container\ContainerInterface;

class ContainerRegistry
{
    private static ?ContainerInterface $container = null;

    public static function setContainer(ContainerInterface $container): void
    {
        self::$container = $container;
    }

    /** @throws MissingContainerRegisterException */
    public static function getContainer(): ContainerInterface
    {
        self::validateContainerInstance();
        return self::$container;
    }

    /** @throws MissingContainerRegisterException */
    private static function validateContainerInstance(): void
    {
        if (empty(self::$container)) {
            throw new MissingContainerRegisterException('Container instance was not registered');
        }
    }

    public static function clear(): void
    {
        self::$container = null;
    }
}
