<?php

namespace phpStack\WebSocket;

use React\Socket\ConnectionInterface;

interface MessageComponentInterface
{
    public function onOpen(ConnectionInterface $conn);
    public function onMessage(ConnectionInterface $from, $msg);
    public function onClose(ConnectionInterface $conn);
    public function onError(ConnectionInterface $conn, \Exception $e);
}
