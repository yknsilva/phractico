<?php

declare(strict_types=1);

namespace Phractico\Database\Connection;

use Phractico\Core\Infrastructure\Database\Connection;
use Phractico\Core\Infrastructure\Database\Query\Statement;
use Phractico\Core\Infrastructure\Database\Result;

class SQLiteAdapter implements Connection
{
    private \SQLite3 $connection;

    public function __construct(private readonly string $databaseFilePath)
    {
    }

    public function connect(): void
    {
        $this->connection = new \SQLite3($this->databaseFilePath);
    }

    public function close(): void
    {
        $this->connection->close();
    }

    public function performStatement(Statement $statement): Result
    {
        $stmt = $statement->toArray();
        $sqliteStatement = $this->connection->prepare($stmt['sql']);
        foreach ($stmt['params'] as $key => $value) {
            $sqliteStatement->bindValue($key, $value);
        }
        $result = $sqliteStatement->execute();
        if ($result && $stmt['has_returning_results']) {
            return $this->prepareReturningResult($result);
        }
        return Result::empty();
    }

    private function prepareReturningResult(\SQLite3Result $statementExecutionResult): Result
    {
        $result = [];
        while ($row = $statementExecutionResult->fetchArray(SQLITE3_ASSOC)) {
            $result[] = $row;
        }
        return Result::from($result);
    }
}
