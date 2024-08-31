<?php

namespace phpStack\Providers;

use phpStack\Core\ServiceProvider;
use phpStack\Database\Connection;
use phpStack\Database\Migration\MigrationManager;
use phpStack\Database\QueryBuilder;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->container->singleton(Connection::class, function ($container) {
            $config = $container->get('config')['database'];
            return new Connection(
                $config['host'],
                $config['database'],
                $config['username'],
                $config['password']
            );
        });

        $this->container->singleton(QueryBuilder::class, function ($container) {
            return new QueryBuilder($container->get(Connection::class));
        });

        $this->container->singleton(MigrationManager::class, function ($container) {
            $connection = $container->get(Connection::class);
            $migrationsPath = $container->get('config')['database']['migrations_path'];
            return new MigrationManager($connection, $migrationsPath);
        });
    }

    public function boot()
    {
        // Any additional setup after all services are registered
    }
}
