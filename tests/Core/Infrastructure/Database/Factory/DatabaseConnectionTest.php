<?php

namespace Phractico\Tests\Core\Infrastructure\Database\Factory;

use App\Tests\Helpers\Database\Connection\DummyDatabase;
use PHPUnit\Framework\TestCase;
use Phractico\Core\Infrastructure\Database\DatabaseConnection;

class DatabaseConnectionTest extends TestCase
{
    public function testGetConnectionShouldReturnConnectionSingleton(): void
    {
        $connection = new DummyDatabase();
        DatabaseConnection::setConnection($connection);

        $connectionFromFirstCall = DatabaseConnection::getConnection();
        $connectionFromSecondCall = DatabaseConnection::getConnection();

        $this->assertEquals($connectionFromFirstCall, $connectionFromSecondCall);
    }

    public function testGetConnectionShouldThrowExceptionIfConnectionWasNotDefined(): void
    {
        DatabaseConnection::reset();

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Database connection is not defined');

        DatabaseConnection::getConnection();
    }
}
