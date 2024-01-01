<?php

require_once __DIR__ . '/vendor/autoload.php';

$httpRequestInterceptor = new \Phractico\API\Http\Request\SymfonyHttpRequestInterceptor();
$controllerProvider = new \Phractico\API\Http\Provider\ApplicationControllerProvider();
$databaseProvider = new \Phractico\Database\ApplicationDatabaseProvider();

$application = new \Phractico\Application(
    $httpRequestInterceptor,
    $controllerProvider,
    $databaseProvider,
);
$application->run();
