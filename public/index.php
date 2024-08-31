<?php

require_once __DIR__ . '/../vendor/autoload.php';

use phpStack\Core\Application;
use phpStack\Templating\RenderEngine;
use phpStack\WebSocket\WebSocketManager;
use phpStack\WebSocket\UpdateDispatcher;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

$app = Application::getInstance();

// Handle HTTP requests
$request = $_SERVER['REQUEST_URI'];

$renderEngine = $app->container->get(RenderEngine::class);

switch ($request) {
    case '/':
    case '/home':
        echo $renderEngine->renderLayout('main-layout', [
            'title' => 'Home',
            'content' => $renderEngine->render('home-page')
        ]);
        break;
    case '/about':
        echo $renderEngine->renderLayout('main-layout', [
            'title' => 'About',
            'content' => $renderEngine->render('about-page')
        ]);
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}

// Set up WebSocket server
$updateDispatcher = $app->container->get(UpdateDispatcher::class);
$webSocketManager = new WebSocketManager($updateDispatcher);

$server = IoServer::factory(
    new HttpServer(
        new WsServer($webSocketManager)
    ),
    8080
);

$server->run();
