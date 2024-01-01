<?php

declare(strict_types=1);

namespace Phractico\Core\Facades;

use Phractico\Core\Infrastructure\Database\Query\Operation\DeleteFacade;
use Phractico\Core\Infrastructure\Database\Query\Operation\InsertFacade;
use Phractico\Core\Infrastructure\Database\Query\Operation\SelectFacade;
use Phractico\Core\Infrastructure\Database\Query\Operation\UpdateFacade;

class DatabaseOperation
{
    private function __construct(
        private readonly string $table,
    ) {
    }

    public static function table(string $table): self
    {
        return new self($table);
    }

    public function select(): SelectFacade
    {
        return new SelectFacade($this->table);
    }

    public function insert(): InsertFacade
    {
        return new InsertFacade($this->table);
    }

    public function update(): UpdateFacade
    {
        return new UpdateFacade($this->table);
    }

    public function delete(): DeleteFacade
    {
        return new DeleteFacade($this->table);
    }
}
