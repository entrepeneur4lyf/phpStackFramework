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

    public function renderLayout(string $layoutName, array $data = [], bool $useCache = true): string
    {
        $cacheKey = $this->getCacheKey($layoutName, $data, 'layout');

        if ($useCache && $this->cacheManager->has($cacheKey)) {
            return $this->cacheManager->get($cacheKey);
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
}
