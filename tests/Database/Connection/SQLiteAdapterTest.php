<?php

namespace Phractico\Tests\Database\Connection;

use PHPUnit\Framework\TestCase;
use Phractico\Core\Infrastructure\Database\Query\Param;
use Phractico\Core\Infrastructure\Database\Query\ParamCollection;
use Phractico\Core\Infrastructure\Database\Query\Statement;
use Phractico\Database\Connection\SQLiteAdapter;

class SQLiteAdapterTest extends TestCase
{
    public function testPersistAndRetrieve(): void
    {
        $sqliteConnection = new SQLiteAdapter(':memory:');
        $sqliteConnection->connect();

        $createTestTable = <<<SQL
CREATE TABLE IF NOT EXISTS `tests`(
    `id` INTEGER PRIMARY KEY,
    `field` TEXT
)
SQL;
        $statement = new Statement($createTestTable);
        $sqliteConnection->performStatement($statement);

        $insertTestData = <<<SQL
INSERT INTO `tests` (`field`) VALUES (:value)
SQL;
        $statement = new Statement($insertTestData);
        $params = ParamCollection::builder()->add(new Param(':value', $value = uniqid('test')));
        $statement->withParams($params);
        $sqliteConnection->performStatement($statement);

        $selectTestData = <<<SQL
SELECT * FROM `tests`
SQL;
        $statement = new Statement($selectTestData);
        $statement->returningResults();
        $result = $sqliteConnection->performStatement($statement);

        $this->assertCount(1, $result->getRows());
        $this->assertEquals($value, $result->getRows()[0]['field']);

        $sqliteConnection->close();
    }
}
