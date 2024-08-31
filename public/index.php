<?php

require_once __DIR__ . '/../vendor/autoload.php';

use phpStack\Core\Application;
use phpStack\Templating\RenderEngine;
use phpStack\WebSocket\WebSocketManager;
use phpStack\WebSocket\UpdateDispatcher;

$app = Application::getInstance();

if (php_sapi_name() === 'cli-server') {
    // Running with PHP's built-in server
    $uri = $_SERVER['REQUEST_URI'];
    $renderEngine = $app->container->get(RenderEngine::class);

    switch ($uri) {
        case '/':
        case '/home':
            $content = $renderEngine->renderLayout('main-layout', [
                'title' => 'Home',
                'content' => $renderEngine->render('home-page')
            ]);
            break;
        case '/about':
            $content = $renderEngine->renderLayout('main-layout', [
                'title' => 'About',
                'content' => $renderEngine->render('about-page')
            ]);
            break;
        default:
            http_response_code(404);
            $content = "404 Not Found";
            break;
    }

    echo $content;
} else {
    // Running with OpenSwoole
    use OpenSwoole\HTTP\Server;
    use OpenSwoole\HTTP\Request;
    use OpenSwoole\HTTP\Response;
    use OpenSwoole\WebSocket\Server as WebSocketServer;
    use OpenSwoole\WebSocket\Frame;

    $server = new WebSocketServer("0.0.0.0", 8080);

    $server->on("start", function (Server $server) {
        echo "Swoole server is started at http://127.0.0.1:8080\n";
    });

    $server->on("request", function (Request $request, Response $response) use ($app) {
        $renderEngine = $app->container->get(RenderEngine::class);

        switch ($request->server['request_uri']) {
            case '/':
            case '/home':
                $content = $renderEngine->renderLayout('main-layout', [
                    'title' => 'Home',
                    'content' => $renderEngine->render('home-page')
                ]);
                break;
            case '/about':
                $content = $renderEngine->renderLayout('main-layout', [
                    'title' => 'About',
                    'content' => $renderEngine->render('about-page')
                ]);
                break;
            default:
                $response->status(404);
                $content = "404 Not Found";
                break;
        }

        $response->end($content);
    });

    $server->on('message', function (WebSocketServer $server, Frame $frame) use ($app) {
        $updateDispatcher = $app->container->get(UpdateDispatcher::class);
        $webSocketManager = new WebSocketManager($updateDispatcher);
        
        // Handle WebSocket messages
        $webSocketManager->onMessage($frame->fd, $frame->data);
    });

    $server->start();
}
