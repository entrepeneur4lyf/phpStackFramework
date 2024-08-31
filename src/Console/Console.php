<?php

namespace phpStack\Console;

use phpStack\Core\Container;
use phpStack\Database\Migration\MigrationManager;

class Console
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function run($argv)
    {
        if (!isset($argv[1])) {
            echo "Please provide a command.\n";
            return;
        }

        $command = $argv[1];
        $method = 'command' . ucfirst($command);

        if (method_exists($this, $method)) {
            $this->$method(array_slice($argv, 2));
        } else {
            echo "Unknown command: $command\n";
        }
    }

    protected function commandMigrate()
    {
        $manager = $this->container->get(MigrationManager::class);
        $manager->runMigrations();
    }

    protected function commandRollback()
    {
        $manager = $this->container->get(MigrationManager::class);
        $manager->rollback();
    }

    protected function commandMakeMigration($args)
    {
        if (empty($args)) {
            echo "Please provide a migration name.\n";
            return;
        }

        $name = $args[0];
        $timestamp = date('Y_m_d_His');
        $filename = $timestamp . '_' . $name . '.php';
        $path = $this->container->get('config')['database']['migrations_path'] . '/' . $filename;

        $stub = file_get_contents(__DIR__ . '/stubs/migration.stub');
        $stub = str_replace('{{className}}', 'Migration_' . $timestamp . '_' . $name, $stub);

        file_put_contents($path, $stub);

        echo "Created Migration: $filename\n";
    }
}
