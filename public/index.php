<?php

require_once __DIR__ . '/../vendor/autoload.php';

use phpStack\Core\Application;

// Create the application instance
$app = Application::getInstance();

// Load configuration
$app->getConfig()->load(__DIR__ . '/../config/app.php');

// Set up routes
$router = $app->getRouter();

$router->get('/', function () {
    return new phpStack\Http\Response('Welcome to phpStack Framework!');
});

$router->get('/hello/{name}', function (phpStack\Http\Request $request) use ($router) {
    $name = $router->getRouteParameter('name');
    return new phpStack\Http\Response("Hello, {$name}!");
});

// Run the application
$app->run();