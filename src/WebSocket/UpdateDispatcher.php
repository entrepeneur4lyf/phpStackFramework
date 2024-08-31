<?php

namespace phpStack\WebSocket;

use Swoole\WebSocket\Server;
use phpStack\Core\Container;
use phpStack\Templating\RenderEngine;
use phpStack\Templating\DiffEngine;

class UpdateDispatcher
{
    protected $renderEngine;
    protected $diffEngine;

    public function __construct(RenderEngine $renderEngine, DiffEngine $diffEngine)
    {
        $this->renderEngine = $renderEngine;
        $this->diffEngine = $diffEngine;
    }

    public function dispatch(Server $server, int $fd, array $data)
    {
        if (!isset($data['action']) || !isset($data['component'])) {
            return;
        }

        switch ($data['action']) {
            case 'update':
                $this->handleUpdate($server, $fd, $data['component'], $data['data'] ?? [], $data['oldContent'] ?? '');
                break;
            // Add more cases for different actions as needed
        }
    }

    protected function handleUpdate(Server $server, int $fd, string $componentName, array $componentData, string $oldContent)
    {
        $updatedContent = $this->renderEngine->partialUpdate($componentName, $componentData);
        $diff = $this->diffEngine->calculateDiff($oldContent, $updatedContent);
        
        $server->push($fd, json_encode([
            'action' => 'update',
            'component' => $componentName,
            'diff' => $diff
        ]));
    }
}
