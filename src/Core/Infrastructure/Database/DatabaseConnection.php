<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Database;

class DatabaseConnection
{
    private static ?Connection $connection = null;

    public static function setConnection(Connection $connection): void
    {
        self::$connection = $connection;
        self::$connection->connect();
    }

    public static function getConnection(): Connection
    {
        if (!self::$connection) {
            throw new \RuntimeException('Database connection is not defined');
        }
        return self::$connection;
    }

    public static function reset(): void
    {
        self::$connection->close();
        self::$connection = null;
    }
}
