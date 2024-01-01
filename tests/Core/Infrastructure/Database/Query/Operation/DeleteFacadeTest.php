<?php

namespace Phractico\Tests\Core\Infrastructure\Database\Query\Operation;

use PHPUnit\Framework\TestCase;
use Phractico\Core\Facades\DatabaseOperation;
use Phractico\Core\Infrastructure\Database\Query\Grammar\Comparison;

class DeleteFacadeTest extends TestCase
{
    public function testBuildShouldComposeStatementForUpdateOperation(): void
    {
        $statement = DatabaseOperation::table('tests')
            ->delete()
            ->build();
        $stmt = $statement->toArray();

        $expectedSql = "DELETE FROM tests";

        $this->assertEquals($expectedSql, $stmt['sql']);
    }

    public function testBuildShouldComposeStatementWithWhereClause(): void
    {
        $statement = DatabaseOperation::table('tests')
            ->delete()
            ->where('field', Comparison::EQUAL, 'value')
            ->build();
        $stmt = $statement->toArray();

        $expectedSql = "DELETE FROM tests WHERE field = :field";
        $expectedParams = [
            ':field' => 'value'
        ];

        $this->assertEquals($expectedSql, $stmt['sql']);
        $this->assertCount(1, $stmt['params']);
        $this->assertEquals($expectedParams, $stmt['params']);
    }

    public function testBuildShouldComposeStatementWithMultipleWhereClauses(): void
    {
        $statement = DatabaseOperation::table('tests')
            ->delete()
            ->where('field', Comparison::EQUAL, 'value')
            ->andWhere('another_field', Comparison::EQUAL, 'another_value')
            ->build();
        $stmt = $statement->toArray();

        $expectedSql = "DELETE FROM tests WHERE field = :field AND another_field = :another_field";
        $expectedParams = [
            ':field' => 'value',
            ':another_field' => 'another_value',
        ];

        $this->assertEquals($expectedSql, $stmt['sql']);
        $this->assertCount(2, $stmt['params']);
        $this->assertEquals($expectedParams, $stmt['params']);
    }
}
