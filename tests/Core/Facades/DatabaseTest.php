<?php

namespace Phractico\Tests\Core\Facades;

use Phractico\Core\Facades\Database;
use PHPUnit\Framework\TestCase;
use Phractico\Core\Infrastructure\Database\DatabaseConnection;
use Phractico\Core\Infrastructure\Database\Query\Param;
use Phractico\Core\Infrastructure\Database\Query\ParamCollection;
use Phractico\Core\Infrastructure\Database\Query\Statement;
use Phractico\Database\Connection\SQLiteAdapter;

class DatabaseTest extends TestCase
{
    public function testExecuteShouldPerformStatementUsingDatabaseConnection(): void
    {
        $connection = new SQLiteAdapter(':memory:');
        DatabaseConnection::setConnection($connection);

        $createTestTable = <<<SQL
CREATE TABLE IF NOT EXISTS `tests`(
    `id` INTEGER PRIMARY KEY,
    `field` TEXT
)
SQL;
        $statement = new Statement($createTestTable);
        Database::execute($statement);

        $insertTestData = <<<SQL
INSERT INTO `tests` (`field`) VALUES (:value)
SQL;
        $statement = new Statement($insertTestData);
        $params = ParamCollection::builder()->add(new Param(':value', $value = uniqid('test')));
        $statement->withParams($params);
        Database::execute($statement);

        $selectTestData = <<<SQL
SELECT * FROM `tests`
SQL;
        $statement = new Statement($selectTestData);
        $statement->returningResults();
        $results = Database::execute($statement);

        $this->assertCount(1, $results->getRows());
        $this->assertEquals($value, $results->getRows()[0]['field']);

        $connection->close();
    }
}
