<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Database\Query;

class ParamCollection
{
    private array $params;

    private function __construct()
    {
        $this->params = [];
    }

    public static function builder(): self
    {
        return new self();
    }

    public function add(Param $param): self
    {
        $this->params[] = $param;
        return $this;
    }

    /** @return Param[] */
    public function getParams(): array
    {
        return $this->params;
    }
}
