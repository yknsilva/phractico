<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\DI;

use Phractico\Core\Infrastructure\DI\Exception\EntryNotFoundException;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class Container implements ContainerInterface
{
    private array $entries;


    public static function create(): self
    {
        return new self();
    }

    private function __construct()
    {
        $this->entries = [];
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->entries);
    }

    /** @throws NotFoundExceptionInterface */
    public function get(string $id)
    {
        if (!array_key_exists($id, $this->entries)) {
            throw new EntryNotFoundException("No entry found for `$id`");
        }
        $callable = $this->entries[$id];
        return $callable();
    }

    public function set(string $id, \Closure $callable): void
    {
        $this->entries[$id] = $callable;
    }
}
