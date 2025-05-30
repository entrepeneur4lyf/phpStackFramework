<?php

require_once __DIR__ . '/../vendor/autoload.php';

use phpStack\Core\Application;
use phpStack\Templating\RenderEngine;
use phpStack\WebSocket\WebSocketManager;
use phpStack\WebSocket\UpdateDispatcher;
use OpenSwoole\HTTP\Server;
use OpenSwoole\HTTP\Request;
use OpenSwoole\HTTP\Response;
use OpenSwoole\WebSocket\Frame;
use OpenSwoole\WebSocket\Server as WebSocketServer;

$app = Application::getInstance();

// CORS headers
$corsHeaders = [
    'Access-Control-Allow-Origin' => '*',
    'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
    'Access-Control-Allow-Headers' => 'Origin, Content-Type, Accept, Authorization, X-Request-With',
    'Access-Control-Allow-Credentials' => 'true'
];

if (php_sapi_name() === 'cli-server') {
    // Running with PHP's built-in server
    $uri = $_SERVER['REQUEST_URI'];
    $renderEngine = $app->container->get(RenderEngine::class);

    // Add CORS headers
    foreach ($corsHeaders as $key => $value) {
        header("$key: $value");
    }

    // Handle preflight requests
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        exit(0);
    }

    if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|ico)$/', $uri)) {
        return false;    // serve the requested resource as-is.
    } else {
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
    }
} else {
    // Running with OpenSwoole
    $server = new WebSocketServer("0.0.0.0", 8080);

    $server->on("start", function (Server $server) {
        echo "Swoole server is started at http://127.0.0.1:8080\n";
    });

    $server->on("request", function (Request $request, Response $response) use ($app, $corsHeaders) {
        // Add CORS headers
        foreach ($corsHeaders as $key => $value) {
            $response->header($key, $value);
        }

        // Handle preflight requests
        if ($request->server['request_method'] === 'OPTIONS') {
            $response->end();
            return;
        }

        $renderEngine = $app->container->get(RenderEngine::class);

        $uri = $request->server['request_uri'];
        if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|ico)$/', $uri)) {
            $filePath = __DIR__ . $uri;
            if (file_exists($filePath)) {
                $response->sendfile($filePath);
            } else {
                $response->status(404);
                $response->end("File not found: " . $uri);
            }
        } else {
            switch ($uri) {
                case '/':
                case '/home':
                    $content = $renderEngine->renderLayout('main-layout', [
                        'title' => 'Home',
                        'content' => $renderEngine->resolve('home-page')
                    ]);
                    break;
                case '/about':
                    $content = $renderEngine->renderLayout('main-layout', [
                        'title' => 'About',
                        'content' => $renderEngine->resolve('about-page')
                    ]);
                    break;
                default:
                    $response->status(404);
                    $content = "404 Not Found: " . $uri;
                    break;
            }

            if (empty($content)) {
                $content = "Error: No content generated for URI: " . $uri;
            }

            $response->header("Content-Type", "text/html; charset=utf-8");
            $response->end($content);
        }
    });

    $server->on('open', function (WebSocketServer $server, $request) {
        echo "New WebSocket connection: {$request->fd}\n";
    });

    $server->on('request', function (Request $request, Response $response) use ($app, $corsHeaders) {
        // Add CORS headers
        foreach ($corsHeaders as $key => $value) {
            $response->header($key, $value);
        }

        // Handle preflight requests
        if ($request->server['request_method'] === 'OPTIONS') {
            $response->end();
            return;
        }

        $renderEngine = $app->container->get(RenderEngine::class);

        $uri = $request->server['request_uri'];
        if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|ico)$/', $uri)) {
            $filePath = __DIR__ . $uri;
            if (file_exists($filePath)) {
                $response->sendfile($filePath);
            } else {
                $response->status(404);
                $response->end("File not found: " . $uri);
            }
        } else {
            switch ($uri) {
                case '/':
                case '/home':
                    if ($request->header('HX-Request')) {
                        $content = $renderEngine->render('home-page');
                    } else {
                        $content = $renderEngine->renderLayout('main-layout', [
                            'title' => 'Home',
                            'content' => $renderEngine->resolve('home-page')
                        ]);
                    }
                    break;
                case '/about':
                    if ($request->header('HX-Request')) {
                        $content = $renderEngine->render('about-page');
                    } else {
                        $content = $renderEngine->renderLayout('main-layout', [
                            'title' => 'About',
                            'content' => $renderEngine->resolve('about-page')
                        ]);
                    }
                    break;
                case '/welcome':
                    $dynamicContent = $app->container->get(DynamicContent::class);
                    $content = $dynamicContent->welcome();
                    break;
                case '/team':
                    $dynamicContent = $app->container->get(DynamicContent::class);
                    $content = $dynamicContent->team();
                    break;
                default:
                    $response->status(404);
                    $content = "404 Not Found: " . $uri;
                    break;
            }

            if (empty($content)) {
                $content = "Error: No content generated for URI: " . $uri;
            }

            $response->header("Content-Type", "text/html; charset=utf-8");
            $response->end($content);
        }
    });

    $server->on('message', function (WebSocketServer $server, Frame $frame) use ($app) {
        echo "Received WebSocket message from connection {$frame->fd}: " . substr($frame->data, 0, 50) . "...\n";
        // Handle WebSocket messages if needed
    });

    $server->on('close', function (WebSocketServer $server, $fd) {
        echo "Connection closed: {$fd}\n";
    });

    $server->start();
}
