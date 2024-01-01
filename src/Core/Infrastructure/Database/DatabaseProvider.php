<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Database;

interface DatabaseProvider
{
    public function getConnection(): Connection;
}
