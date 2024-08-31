<?php

namespace phpStack\WebSocket;

use Ratchet\ConnectionInterface;
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

    public function dispatch(ConnectionInterface $from, array $data)
    {
        if (!isset($data['action']) || !isset($data['component'])) {
            return;
        }

        switch ($data['action']) {
            case 'update':
                $this->handleUpdate($from, $data['component'], $data['data'] ?? [], $data['oldContent'] ?? '');
                break;
            // Add more cases for different actions as needed
        }
    }

    protected function handleUpdate(ConnectionInterface $from, string $componentName, array $componentData, string $oldContent)
    {
        $updatedContent = $this->renderEngine->partialUpdate($componentName, $componentData);
        $diff = $this->diffEngine->calculateDiff($oldContent, $updatedContent);
        
        $from->send(json_encode([
            'action' => 'update',
            'component' => $componentName,
            'diff' => $diff
        ]));
    }
}