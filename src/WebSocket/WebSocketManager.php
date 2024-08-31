<?php

namespace phpStack\WebSocket;

use Swoole\WebSocket\Server;
use Swoole\Http\Request;
use phpStack\Core\Container;

class WebSocketManager implements MessageComponentInterface
{
    protected array $clients = [];
    protected UpdateDispatcher $updateDispatcher;

    public function __construct(UpdateDispatcher $updateDispatcher)
    {
        $this->updateDispatcher = $updateDispatcher;
    }

    public function onOpen(Server $server, Request $request): void
    {
        $this->clients[$request->fd] = $request->fd;
        echo "New connection! (FD: {$request->fd})\n";
    }

    public function onMessage(Server $server, \Swoole\WebSocket\Frame $frame): void
    {
        $data = json_decode($frame->data, true);
        if (is_array($data)) {
            $this->updateDispatcher->dispatch($server, $frame->fd, $data);
        }
    }

    public function onClose(Server $server, int $fd): void
    {
        unset($this->clients[$fd]);
        echo "Connection {$fd} has disconnected\n";
    }

    public function broadcast(Server $server, string $message): void
    {
        foreach ($this->clients as $fd) {
            $server->push($fd, $message);
        }
    }
}
