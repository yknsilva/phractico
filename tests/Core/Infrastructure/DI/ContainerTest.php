<?php

namespace Phractico\Tests\Core\Infrastructure\DI;

use PHPUnit\Framework\TestCase;
use Phractico\Core\Infrastructure\DI\Container;
use Phractico\Tests\Core\Infrastructure\DI\Support\DummyInstanceForContainerDI;
use Phractico\Tests\Core\Infrastructure\DI\Support\SupportInterfaceContainerDI;
use Psr\Container\NotFoundExceptionInterface;

class ContainerTest extends TestCase
{
    private Container $container;

    /** @before */
    protected function initContainer(): void
    {
        $this->container = Container::create();
    }

    public function testHasShouldReturnTrueWhenEntryExists(): void
    {
        $this->container->set(SupportInterfaceContainerDI::class, fn () => new class () {});

        $this->assertTrue($this->container->has(SupportInterfaceContainerDI::class));
    }

    public function testHasShouldReturnFalseWhenEntryDoesNotExist(): void
    {
        $this->assertFalse($this->container->has(SupportInterfaceContainerDI::class));
    }

    public function testGetShouldReturnExistingEntry(): void
    {
        $this->container->set(SupportInterfaceContainerDI::class, fn () => new DummyInstanceForContainerDI());

        $actualDummyInstance = $this->container->get(SupportInterfaceContainerDI::class);

        $this->assertInstanceOf(DummyInstanceForContainerDI::class, $actualDummyInstance);
    }

    public function testGetShouldThrowExceptionWhenEntryDoesNotExist(): void
    {
        $this->expectException(NotFoundExceptionInterface::class);

        $this->container->get(SupportInterfaceContainerDI::class);
    }
}
