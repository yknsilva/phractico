<?php

namespace Phractico\Tests\Core\Infrastructure\DI;

use PHPUnit\Framework\TestCase;
use Phractico\Core\Infrastructure\DI\ContainerRegistry;
use Phractico\Core\Infrastructure\DI\Exception\MissingContainerRegisterException;

class ContainerRegistryTest extends TestCase
{
    public function testGetContainerShouldThrowExceptionWhenContainerInstanceIsMissing(): void
    {
        ContainerRegistry::clear();

        $this->expectException(MissingContainerRegisterException::class);
        $this->expectExceptionMessage('Container instance was not registered');

        ContainerRegistry::getContainer();
    }
}
