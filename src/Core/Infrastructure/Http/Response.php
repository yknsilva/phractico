<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Http;

use Psr\Http\Message\ResponseInterface;

interface Response
{
    public function render(): ResponseInterface;
}
