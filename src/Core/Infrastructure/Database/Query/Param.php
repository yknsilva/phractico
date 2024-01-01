<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Database\Query;

readonly class Param
{
    public function __construct(
        public string $key,
        public string $value,
    ) {
    }
}
