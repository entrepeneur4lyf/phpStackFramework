<?php

namespace phpStack\WebSocket;

use Swoole\WebSocket\Server;
use Swoole\Http\Request;

interface MessageComponentInterface
{
    public function onOpen(Server $server, Request $request): void;
    public function onMessage(Server $server, \Swoole\WebSocket\Frame $frame): void;
    public function onClose(Server $server, int $fd): void;
}
