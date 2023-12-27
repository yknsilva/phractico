<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\Http\Response\Factory;

use Phractico\Core\Infrastructure\Http\Response\JsonResponse;

class JsonResponseFactory
{
    public static function internalServerError(): JsonResponse
    {
        return new JsonResponse(
            status: 500,
            body: ['error' => 'Internal Server Error']
        );
    }
}
