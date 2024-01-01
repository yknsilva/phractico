<?php

declare(strict_types=1);

namespace Phractico\Core\Facades;

use Phractico\Core\Infrastructure\Database\DatabaseConnection;
use Phractico\Core\Infrastructure\Database\Query\Statement;
use Phractico\Core\Infrastructure\Database\Result;

class Database
{
    public static function execute(Statement $statement): Result
    {
        $connection = DatabaseConnection::getConnection();
        $result = $connection->performStatement($statement);
        return $result;
    }
}
