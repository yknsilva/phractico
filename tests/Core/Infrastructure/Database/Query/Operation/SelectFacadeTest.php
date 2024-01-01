<?php

namespace Phractico\Tests\Core\Infrastructure\Database\Query\Operation;

use PHPUnit\Framework\TestCase;
use Phractico\Core\Facades\DatabaseOperation;
use Phractico\Core\Infrastructure\Database\Query\Grammar\Comparison;

class SelectFacadeTest extends TestCase
{
    public function testBuildShouldComposeStatementForSelectOperation(): void
    {
        $statement = DatabaseOperation::table('tests')
            ->select()
            ->build();
        $stmt = $statement->toArray();

        $expectedSql = 'SELECT * FROM tests';

        $this->assertEquals($expectedSql, $stmt['sql']);
    }

    public function testBuildShouldComposeStatementForSpecificTableColumns(): void
    {
        $statement = DatabaseOperation::table('tests')
            ->select()
            ->columns(['column1', 'column2'])
            ->build();
        $stmt = $statement->toArray();

        $expectedSql = 'SELECT column1, column2 FROM tests';

        $this->assertEquals($expectedSql, $stmt['sql']);
    }

    public function testBuildShouldComposeStatementWithWhereClause(): void
    {
        $statement = DatabaseOperation::table('tests')
            ->select()
            ->where('field', Comparison::EQUAL, 'something')
            ->build();
        $stmt = $statement->toArray();

        $expectedSql = 'SELECT * FROM tests WHERE field = :field';
        $expectedParams = [':field' => 'something'];

        $this->assertEquals($expectedSql, $stmt['sql']);
        $this->assertCount(1, $stmt['params']);
        $this->assertEquals($expectedParams, $stmt['params']);
    }

    public function testBuildShouldComposeStatementWithMultipleWhereClauses(): void
    {
        $statement = DatabaseOperation::table('tests')
            ->select()
            ->where('field', Comparison::EQUAL, 'something')
            ->andWhere('another_field', Comparison::LIKE, '%any%')
            ->build();
        $stmt = $statement->toArray();

        $expectedSql = 'SELECT * FROM tests WHERE field = :field AND another_field LIKE :another_field';
        $expectedParams = [
            ':field' => 'something',
            ':another_field' => '%any%'
        ];

        $this->assertEquals($expectedSql, $stmt['sql']);
        $this->assertCount(2, $stmt['params']);
        $this->assertEquals($expectedParams, $stmt['params']);
    }
}
