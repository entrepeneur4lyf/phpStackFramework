<?php

namespace phpStack\Templating;

use phpStack\Core\Container;
use phpStack\Core\Cache\CacheManager;

class RenderEngine
{
    protected $componentRegistry;
    protected $layoutManager;
    protected $cacheManager;
    protected $container;

    public function __construct(
        ComponentRegistry $componentRegistry,
        LayoutManager $layoutManager,
        CacheManager $cacheManager,
        Container $container
    ) {
        $this->componentRegistry = $componentRegistry;
        $this->layoutManager = $layoutManager;
        $this->cacheManager = $cacheManager;
        $this->container = $container;
    }

    public function render(string $componentName, array $data = [], bool $useCache = true): string
    {
        $cacheKey = $this->getCacheKey($componentName, $data);

        if ($useCache && $this->cacheManager->has($cacheKey)) {
            return $this->cacheManager->get($cacheKey);
        }

        $component = $this->componentRegistry->resolve($componentName, $data);
        $renderedContent = $component->render();

        if ($useCache) {
            $this->cacheManager->set($cacheKey, $renderedContent);
        }

        return $renderedContent;
    }

    public function resolve(string $componentName, array $data = []): ComponentService
    {
        return $this->componentRegistry->resolve($componentName, $data);
    }

    public function renderLayout(string $layoutName, array $data = [], bool $useCache = true): string
    {
        $cacheKey = $this->getCacheKey($layoutName, $data, 'layout');

        if ($useCache && $this->cacheManager->has($cacheKey)) {
            return $this->cacheManager->get($cacheKey);
        }

        // Render the content first if it's a ComponentService
        if (isset($data['content'])) {
            if ($data['content'] instanceof ComponentService) {
                $data['content'] = $data['content']->render();
            } elseif (is_string($data['content'])) {
                // If it's already a string, we don't need to do anything
            } else {
                // If it's neither a ComponentService nor a string, render it as an empty string
                $data['content'] = '';
            }
        }

        if (!isset($data['content']) || empty($data['content'])) {
            $data['content'] = '<p>No content available.</p>';
        }

        $renderedContent = $this->layoutManager->render($layoutName, $data);

        if ($useCache) {
            $this->cacheManager->set($cacheKey, $renderedContent);
        }

        return $renderedContent;
    }

    public function partialUpdate(string $componentName, array $data = []): string
    {
        $component = $this->componentRegistry->resolve($componentName, $data);
        return $component->render();
    }

    protected function getCacheKey(string $name, array $data, string $type = 'component'): string
    {
        $dataHash = md5(serialize($data));
        return "render:{$type}:{$name}:{$dataHash}";
    }

    public function renderPartialUpdate(string $componentName, array $data = []): string
    {
        $component = $this->componentRegistry->resolve($componentName, $data);
        return $component->render();
    }
}
