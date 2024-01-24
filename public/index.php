<?php

use Phractico\Application;
use Phractico\DI\ApplicationContainer;

require __DIR__ . '/../vendor/autoload.php';

$container = ApplicationContainer::resolve();

$application = new Application($container);
$application->run();
