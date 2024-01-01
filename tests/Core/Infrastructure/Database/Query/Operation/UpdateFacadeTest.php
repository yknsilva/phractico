<?php

namespace Phractico\Tests\Core\Infrastructure\Database\Query\Operation;

use PHPUnit\Framework\TestCase;
use Phractico\Core\Facades\DatabaseOperation;
use Phractico\Core\Infrastructure\Database\Query\Grammar\Comparison;

class UpdateFacadeTest extends TestCase
{
    public function testBuildShouldComposeStatementForUpdateOperation(): void
    {
        $data = [
            'some_field' => 'some_field_new_value',
            'another_field' => 'another_field_new_value'
        ];
        $statement = DatabaseOperation::table('tests')
            ->update()
            ->data($data)
            ->build();
        $stmt = $statement->toArray();

        $expectedSql = "UPDATE tests SET some_field = :some_field, another_field = :another_field";
        $expectedParams = [
            ':some_field' => 'some_field_new_value',
            ':another_field' => 'another_field_new_value'
        ];

        $this->assertEquals($expectedSql, $stmt['sql']);
        $this->assertCount(2, $stmt['params']);
        $this->assertEquals($expectedParams, $stmt['params']);
    }

    public function testBuildShouldComposeStatementWithWhereClause(): void
    {
        $statement = DatabaseOperation::table('tests')
            ->update()
            ->data(['field' => 'new_value'])
            ->where('condition', Comparison::EQUAL, 'condition_value')
            ->build();
        $stmt = $statement->toArray();

        $expectedSql = "UPDATE tests SET field = :field WHERE condition = :condition";
        $expectedParams = [
            ':field' => 'new_value',
            ':condition' => 'condition_value'
        ];

        $this->assertEquals($expectedSql, $stmt['sql']);
        $this->assertCount(2, $stmt['params']);
        $this->assertEquals($expectedParams, $stmt['params']);
    }

    public function testBuildShouldComposeStatementWithMultipleWhereClauses(): void
    {
        $statement = DatabaseOperation::table('tests')
            ->update()
            ->data(['field' => 'new_value'])
            ->where('condition', Comparison::EQUAL, 'condition_value')
            ->andWhere('another_condition', Comparison::EQUAL, 'another_condition_value')
            ->build();
        $stmt = $statement->toArray();

        $expectedSql = "UPDATE tests SET field = :field WHERE condition = :condition AND another_condition = :another_condition";
        $expectedParams = [
            ':field' => 'new_value',
            ':condition' => 'condition_value',
            ':another_condition' => 'another_condition_value'
        ];

        $this->assertEquals($expectedSql, $stmt['sql']);
        $this->assertCount(3, $stmt['params']);
        $this->assertEquals($expectedParams, $stmt['params']);
    }
}
