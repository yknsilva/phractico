<?php

declare(strict_types=1);

namespace Phractico\Database;

use Phractico\Core\Infrastructure\Database\Connection;
use Phractico\Core\Infrastructure\Database\DatabaseProvider;
use Phractico\Database\Connection\SQLiteAdapter;

class ApplicationDatabaseProvider implements DatabaseProvider
{
    public function getConnection(): Connection
    {
        return new SQLiteAdapter(__DIR__ . '/../../database/database.sqlite');
    }
}
