<?php

namespace phpStack\WebSocket;

use React\Socket\ConnectionInterface;
use phpStack\Core\Container;

class WebSocketManager implements MessageComponentInterface
{
    protected \SplObjectStorage $clients;
    protected UpdateDispatcher $updateDispatcher;

    public function __construct(UpdateDispatcher $updateDispatcher)
    {
        $this->clients = new \SplObjectStorage;
        $this->updateDispatcher = $updateDispatcher;
    }

    public function onOpen(ConnectionInterface $conn): void
    {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, string $msg): void
    {
        $data = json_decode($msg, true);
        if (is_array($data)) {
            $this->updateDispatcher->dispatch($from, $data);
        }
    }

    public function onClose(ConnectionInterface $conn): void
    {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e): void
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function broadcast(string $message): void
    {
        foreach ($this->clients as $client) {
            if ($client instanceof ConnectionInterface) {
                $client->send($message);
            }
        }
    }
}
