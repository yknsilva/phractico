<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Database\Query\Grammar;

enum Comparison
{
    case EQUAL;
    case NOT_EQUAL;
    case LESS_THAN;
    case LESS_THAN_OR_EQUAL;
    case GREATER_THAN;
    case GREATER_THAN_OR_EQUAL;
    case LIKE;

    public function operator(): string
    {
        return match($this) {
            self::EQUAL => '=',
            self::NOT_EQUAL => '!=',
            self::LESS_THAN => '<',
            self::LESS_THAN_OR_EQUAL => '<=',
            self::GREATER_THAN => '>',
            self::GREATER_THAN_OR_EQUAL => '>=',
            self::LIKE => 'LIKE',
        };
    }
}
