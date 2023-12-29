<?php

require_once __DIR__ . '/vendor/autoload.php';

$httpRequestInterceptor = new \Phractico\API\Http\Request\SymfonyHttpRequestInterceptor();
$controllerProvider = new \Phractico\API\Http\Provider\ApplicationControllerProvider();

$application = new \Phractico\Application($httpRequestInterceptor, $controllerProvider);
$application->run();
