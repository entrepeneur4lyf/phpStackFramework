<?php

namespace phpStack\Providers;

use phpStack\Core\ServiceProvider;
use phpStack\Templating\ComponentRegistry;
use phpStack\Templating\LayoutManager;
use phpStack\Templating\RenderEngine;
use phpStack\Templating\DiffEngine;
use phpStack\WebSocket\UpdateDispatcher;
use phpStack\Core\Cache\CacheManager;

class TemplatingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->container->singleton(ComponentRegistry::class, function ($container) {
            return new ComponentRegistry($container);
        });

        $this->container->singleton(LayoutManager::class, function ($container) {
            return new LayoutManager($container->get(ComponentRegistry::class));
        });

        $this->container->singleton(DiffEngine::class, function ($container) {
            return new DiffEngine();
        });

        $this->container->singleton(CacheManager::class, function ($container) {
            // Implement CacheManager instantiation
            return new CacheManager();
        });

        $this->container->singleton(RenderEngine::class, function ($container) {
            return new RenderEngine(
                $container->get(ComponentRegistry::class),
                $container->get(LayoutManager::class),
                $container->get(CacheManager::class),
                $container
            );
        });

        $this->container->singleton(UpdateDispatcher::class, function ($container) {
            return new UpdateDispatcher(
                $container->get(RenderEngine::class),
                $container->get(DiffEngine::class)
            );
        });
    }

    public function boot(): void
    {
        $componentRegistry = $this->container->get(ComponentRegistry::class);
        $layoutManager = $this->container->get(LayoutManager::class);

        // Register default components
        $componentRegistry->register('main-layout', function ($container) use ($componentRegistry) {
            return new \phpStack\Components\MainLayout($componentRegistry);
        });
        $componentRegistry->register('header', \phpStack\Components\Header::class);
        $componentRegistry->register('footer', \phpStack\Components\Footer::class);
        $componentRegistry->register('sidebar', \phpStack\Components\Sidebar::class);

        // Register new page components
        $componentRegistry->register('home-page', \phpStack\Components\HomePage::class);
        $componentRegistry->register('about-page', \phpStack\Components\AboutPage::class);
        $componentRegistry->register('dynamic-content', \phpStack\Components\DynamicContent::class);

        // Register layouts
        $layoutManager->registerLayout('main-layout', 'main-layout');
    }
}
