<?php

namespace phpStack\Console\Commands;

use phpStack\Database\Connection;
use phpStack\Database\Seeder\SeederManager;

class SeedCommand
{
    protected Connection $connection;
    protected string $seederPath;

    public function __construct(Connection $connection, string $seederPath)
    {
        $this->connection = $connection;
        $this->seederPath = $seederPath;
    }

    public function handle(array $args): void
    {
        $manager = new SeederManager($this->connection, $this->seederPath);

        if (isset($args[1])) {
            $manager->seed($args[1]);
        } else {
            $manager->seed();
        }
    }
}