<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Database;

class Result
{
    public function __construct(private readonly array $rows)
    {
    }

    public static function from(array $result): self
    {
        return new self($result);
    }

    public static function empty(): self
    {
        return new self([]);
    }

    public function getRows(): array
    {
        return $this->rows;
    }
}
