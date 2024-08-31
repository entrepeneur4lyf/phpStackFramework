<?php

namespace phpStack\WebSocket;

use Swoole\WebSocket\Server;
use phpStack\Core\Container;

class SwooleServer
{
    protected $server;
    protected $webSocketManager;

    public function __construct(WebSocketManager $webSocketManager, string $host = '0.0.0.0', int $port = 9501)
    {
        $this->webSocketManager = $webSocketManager;
        $this->server = new Server($host, $port);

        $this->server->on('open', [$this->webSocketManager, 'onOpen']);
        $this->server->on('message', [$this->webSocketManager, 'onMessage']);
        $this->server->on('close', [$this->webSocketManager, 'onClose']);
    }

    public function start(): void
    {
        echo "WebSocket server is running on ws://{$this->server->host}:{$this->server->port}\n";
        $this->server->start();
    }
}
