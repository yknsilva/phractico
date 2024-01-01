<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Database\Query\Operation;

use Phractico\Core\Infrastructure\Database\Query\Statement;

interface Facade
{
    /**
     * @return Statement
     * Return a statement composed according related facade
     * (select, insert, update, etc.)
     */
    public function build(): Statement;
}
