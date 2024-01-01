<?php

namespace Phractico\Tests\Core\Infrastructure\Database\Factory;

use PHPUnit\Framework\TestCase;
use Phractico\Core\Infrastructure\Database\DatabaseConnection;
use Phractico\Tests\Helpers\Database\Connection\DummyDatabase;

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
