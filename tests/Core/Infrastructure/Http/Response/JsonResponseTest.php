<?php

declare(strict_types=1);

namespace Phractico\Tests\Core\Infrastructure\Http\Response;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Phractico\Core\Infrastructure\Http\Response\JsonResponse;

#[CoversClass(JsonResponse::class)]
final class JsonResponseTest extends TestCase
{
    public function testRenderShouldParseBodyAsJson(): void
    {
        $jsonResponse = new JsonResponse(200, ['message' => 'anything']);

        $response = $jsonResponse->render();
        $responseBody = $response->getBody()->getContents();

        $this->assertJson($responseBody);
        $this->assertJsonStringEqualsJsonString('{"message": "anything"}', $responseBody);
    }

    public function testRenderShouldContainJsonContentType(): void
    {
        $jsonResponse = new JsonResponse(200, []);
        $response = $jsonResponse->render();

        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
    }
}
