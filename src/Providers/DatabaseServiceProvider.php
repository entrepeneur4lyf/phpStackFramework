<?php

namespace PhpStack\Providers;

use PhpStack\Core\ServiceProvider;
use PhpStack\Database\Connection;
use PhpStack\Database\QueryBuilder;
use PhpStack\Database\Migration\MigrationManager;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->container->singleton(Connection::class, function ($container) {
            $config = $container->get('config')->get('database', []);
            return new Connection($config);
        });

        $this->container->singleton(QueryBuilder::class, function ($container) {
            return new QueryBuilder($container->get(Connection::class));
        });

        $this->container->singleton(MigrationManager::class, function ($container) {
            $connection = $container->get(Connection::class);
            $migrationsPath = $container->get('config')->get('database.migrations_path');
            return new MigrationManager($connection, $migrationsPath);
        });
    }

    public function boot(): void
    {
        // Any additional setup after all services are registered
    }
}
