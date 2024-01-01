<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Database\Query\Operation;

use Phractico\Core\Infrastructure\Database\Query\Param;
use Phractico\Core\Infrastructure\Database\Query\ParamCollection;
use Phractico\Core\Infrastructure\Database\Query\Statement;

class InsertFacade implements Facade
{
    private array $data;
    private ParamCollection $params;

    public function __construct(private readonly string $table)
    {
        $this->data = [];
        $this->params = ParamCollection::builder();
    }

    public function data(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function build(): Statement
    {
        $columns = $this->parseSqlColumns();
        $values = $this->parseSqlValuesParams();

        $statement = new Statement("INSERT INTO {$this->table} ($columns) VALUES ($values)");
        $this->composeStatementParams($statement);
        return $statement;
    }

    private function parseSqlColumns(): string
    {
        return implode(', ', array_keys($this->data));
    }

    private function parseSqlValuesParams(): string
    {
        return implode(', ', array_map(function ($column) {
            return ":$column";
        }, array_keys($this->data)));
    }

    private function composeStatementParams(Statement $statement): void
    {
        foreach ($this->data as $column => $value) {
            $this->params->add(new Param(":$column", $value));
        }
        $statement->withParams($this->params);
    }
}
