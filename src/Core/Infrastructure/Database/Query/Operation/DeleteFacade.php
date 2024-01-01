<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Database\Query\Operation;

use Phractico\Core\Infrastructure\Database\Query\Grammar\Comparison;
use Phractico\Core\Infrastructure\Database\Query\Param;
use Phractico\Core\Infrastructure\Database\Query\ParamCollection;
use Phractico\Core\Infrastructure\Database\Query\Statement;

class DeleteFacade implements Facade
{
    private array $conditions;
    private ParamCollection $params;

    public function __construct(private readonly string $table)
    {
        $this->conditions = [];
        $this->params = ParamCollection::builder();
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
        $sql = "DELETE FROM {$this->table}";
        foreach ($this->conditions as $condition) {
            $sql .= $condition;
        }

        $statement = new Statement($sql);
        $statement->withParams($this->params);
        return $statement;
    }
}
