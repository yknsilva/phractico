<?php

declare(strict_types=1);

namespace App\API\Http\Controller;

use Phractico\Core\Facades\Database;
use Phractico\Core\Facades\DatabaseOperation;
use Phractico\Core\Infrastructure\Database\Query\Statement;
use Phractico\Core\Infrastructure\Http\Controller;
use Phractico\Core\Infrastructure\Http\Request\RequestHandler;
use Phractico\Core\Infrastructure\Http\Request\Route;
use Phractico\Core\Infrastructure\Http\Request\RouteCollection;
use Phractico\Core\Infrastructure\Http\Response;
use Phractico\Core\Infrastructure\Http\Response\JsonResponse;

class ExampleController implements Controller
{
    public function routes(): RouteCollection
    {
        $routeCollection = RouteCollection::for($this);
        $routeCollection->add(Route::create('GET', '/example'), 'itWorks');
        $routeCollection->add(Route::create('GET', '/exampleDatabase'), 'itWorksWithDatabase');
        return $routeCollection;
    }

    public function itWorks(): Response
    {
        $body = [
            'status' => 'success',
            'message' => 'It works! :)'
        ];
        return new JsonResponse(200, $body);
    }

    public function itWorksWithDatabase(): Response
    {
        Database::execute(new Statement(
            "CREATE TABLE IF NOT EXISTS `tests`(`id` INTEGER PRIMARY KEY, `key` TEXT, `value` TEXT)"
        ));

        $incomingRequest = RequestHandler::getIncomingRequest();
        $decodedRequestBody = json_decode($incomingRequest->getBody()->getContents(), true);

        foreach ($decodedRequestBody as $key => $value) {
            $data = ['key' => $key, 'value' => $value];
            $statement = DatabaseOperation::table('tests')
                ->insert()
                ->data($data)
                ->build();
            Database::execute($statement);
        }

        $statement = DatabaseOperation::table('tests')
            ->select()
            ->build();
        $result = Database::execute($statement);
        $body = [
            'status' => 'success',
            'message' => 'It works with database! :)',
            'result' => $result->getRows()
        ];
        return new JsonResponse(200, $body);
    }
}
