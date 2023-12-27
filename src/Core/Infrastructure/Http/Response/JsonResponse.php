<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Http\Response;

use GuzzleHttp\Psr7\Response as HttpResponse;
use Phractico\Core\Infrastructure\Http\Response;
use Psr\Http\Message\ResponseInterface;

readonly class JsonResponse implements Response
{
    public function __construct(
        private int   $status,
        private array $body
    ) {
    }

    public function render(): ResponseInterface
    {
        return new HttpResponse(
            status: $this->status,
            headers: ['Content-Type' => 'application/json'],
            body: json_encode($this->body)
        );
    }
}
