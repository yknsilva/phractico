<?php

declare(strict_types=1);

namespace Phractico\Tests\Helpers\Database\Connection;

use Phractico\Core\Infrastructure\Database\Connection;
use Phractico\Core\Infrastructure\Database\Query\Statement;
use Phractico\Core\Infrastructure\Database\Result;

class DummyDatabase implements Connection
{
    public function connect(): void
    {
        return;
    }

    public function close(): void
    {
        return;
    }

    public function performStatement(Statement $statement): Result
    {
        return Result::empty();
    }
}
