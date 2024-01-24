<?php

namespace Phractico\Tests\Core\Facades;

use PHPUnit\Framework\TestCase;
use Phractico\Core\Facades\ContainerDI;
use Phractico\Core\Infrastructure\DI\Container;
use Phractico\Core\Infrastructure\DI\ContainerRegistry;
use Phractico\Tests\Core\Infrastructure\DI\Support\DummyInstanceForContainerDI;
use Phractico\Tests\Core\Infrastructure\DI\Support\SupportInterfaceContainerDI;

class ContainerDITest extends TestCase
{
    public function testShouldRetrieveStoredEntryFromContainer(): void
    {
        $container = Container::create();
        ContainerRegistry::setContainer($container);

        $container->set(SupportInterfaceContainerDI::class, fn () => new DummyInstanceForContainerDI());

        $retrievedEntry = ContainerDI::get(SupportInterfaceContainerDI::class);

        $this->assertInstanceOf(DummyInstanceForContainerDI::class, $retrievedEntry);
    }
}
