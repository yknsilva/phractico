<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Http\Response;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class ResponseHandler
{
    private Response $response;

    private function __construct(ResponseInterface $response)
    {
        $this->response = new Response();

        $this->response->headers->add($response->getHeaders());
        $this->response->setStatusCode($response->getStatusCode());
        $this->response->setContent($response->getBody()->getContents());
    }

    public static function handle(ResponseInterface $response): self
    {
        return new self($response);
    }

    public function send(): void
    {
        $this->response->send();
    }
}
