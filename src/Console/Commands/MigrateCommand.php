<?php

namespace phpStack\Console\Commands;

use phpStack\Database\Connection;
use phpStack\Database\Migration\MigrationManager;

class MigrateCommand
{
    protected Connection $connection;
    protected string $migrationPath;

    public function __construct(Connection $connection, string $migrationPath)
    {
        $this->connection = $connection;
        $this->migrationPath = $migrationPath;
    }

    public function handle(array $args): void
    {
        $manager = new MigrationManager($this->connection, $this->migrationPath);

        if (isset($args[1]) && $args[1] === 'rollback') {
            $steps = isset($args[2]) ? (int) $args[2] : 1;
            $manager->rollback($steps);
        } else {
            $manager->migrate();
        }
    }
}