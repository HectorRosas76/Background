<?php


use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$endpoints = require __DIR__ .'/../app/Presentation/Routers/endpoints.php';

$app = AppFactory::create();

$endpoints($app);

$app->run();