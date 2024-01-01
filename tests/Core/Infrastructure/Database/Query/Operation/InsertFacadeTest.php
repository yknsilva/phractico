<?php

namespace Phractico\Tests\Core\Infrastructure\Database\Query\Operation;

use PHPUnit\Framework\TestCase;
use Phractico\Core\Facades\DatabaseOperation;

class InsertFacadeTest extends TestCase
{
    public function testBuildShouldComposeStatementForInsertOperation(): void
    {
        $statement = DatabaseOperation::table('tests')
            ->insert()
            ->data(['foo' => 'bar'])
            ->build();
        $stmt = $statement->toArray();

        $expectedSql = "INSERT INTO tests (foo) VALUES (:foo)";
        $expectedParams = [':foo' => 'bar'];

        $this->assertEquals($expectedSql, $stmt['sql']);
        $this->assertCount(1, $stmt['params']);
        $this->assertEquals($expectedParams, $stmt['params']);
    }
}
