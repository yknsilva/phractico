<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Database\Query;

class Statement
{
    private ParamCollection $paramsCollection;
    private bool $hasReturningResults;

    public function __construct(
        private readonly string $sql,
    ) {
        $this->paramsCollection = ParamCollection::builder();
        $this->hasReturningResults = false;
    }

    public function withParams(ParamCollection $params): self
    {
        $this->paramsCollection = $params;
        return $this;
    }

    public function returningResults(): void
    {
        $this->hasReturningResults = true;
    }

    public function toArray(): array
    {
        $params = [];
        foreach ($this->paramsCollection->getParams() as $param) {
            $params[$param->key] = $param->value;
        }
        return [
            'sql' => $this->sql,
            'params' => $params,
            'has_returning_results' => $this->hasReturningResults,
        ];
    }
}
