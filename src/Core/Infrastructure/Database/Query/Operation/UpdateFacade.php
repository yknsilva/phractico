<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Database\Query\Operation;

use Phractico\Core\Infrastructure\Database\Query\Grammar\Comparison;
use Phractico\Core\Infrastructure\Database\Query\Param;
use Phractico\Core\Infrastructure\Database\Query\ParamCollection;
use Phractico\Core\Infrastructure\Database\Query\Statement;

class UpdateFacade implements Facade
{
    private array $data;
    private array $conditions;
    private ParamCollection $params;

    public function __construct(private readonly string $table)
    {
        $this->data = [];
        $this->conditions = [];
        $this->params = ParamCollection::builder();
    }

    public function data(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function where(string $column, Comparison $comparison, string $value): self
    {
        $this->conditions[] = " WHERE $column {$comparison->operator()} :$column";
        $this->params->add(new Param(":$column", $value));
        return $this;
    }

    public function andWhere(string $column, Comparison $comparisonOperator, string $value): self
    {
        $this->conditions[] = " AND $column {$comparisonOperator->operator()} :$column";
        $this->params->add(new Param(":$column", $value));
        return $this;
    }

    public function build(): Statement
    {
        $updatingFields = $this->parseUpdatingFields();
        $sql = "UPDATE {$this->table} SET $updatingFields";
        foreach ($this->conditions as $condition) {
            $sql .= $condition;
        }

        $statement = new Statement($sql);
        $statement->withParams($this->params);
        return $statement;
    }

    private function parseUpdatingFields(): string
    {
        $updateOperationClauses = [];
        foreach ($this->data as $key => $value) {
            $updateOperationClauses[] = "$key = :$key";
            $this->params->add(new Param(":$key", $value));
        }
        return implode(', ', $updateOperationClauses);
    }
}
