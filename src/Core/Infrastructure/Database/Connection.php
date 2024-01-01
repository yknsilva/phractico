<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Database;

use Phractico\Core\Infrastructure\Database\Query\Statement;

interface Connection
{
    public function connect(): void;
    public function close(): void;
    public function performStatement(Statement $statement): Result;
}
