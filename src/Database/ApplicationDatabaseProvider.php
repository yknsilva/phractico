<?php

declare(strict_types=1);

namespace App\Database;

use App\Database\Connection\SQLiteAdapter;
use Phractico\Core\Infrastructure\Database\Connection;
use Phractico\Core\Infrastructure\Database\DatabaseProvider;

class ApplicationDatabaseProvider implements DatabaseProvider
{
    public function getConnection(): Connection
    {
        return new SQLiteAdapter(__DIR__ . '/../../database/database.sqlite');
    }
}
