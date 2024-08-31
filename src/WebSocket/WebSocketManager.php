<?php

namespace phpStack\WebSocket;

use React\Socket\ConnectionInterface;
use phpStack\Core\Container;

class WebSocketManager implements MessageComponentInterface
{
    protected $clients;
    protected $updateDispatcher;

    public function __construct(UpdateDispatcher $updateDispatcher)
    {
        $this->clients = new \SplObjectStorage;
        $this->updateDispatcher = $updateDispatcher;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);
        $this->updateDispatcher->dispatch($from, $data);
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function broadcast($message)
    {
        foreach ($this->clients as $client) {
            $client->send($message);
        }
    }
}
