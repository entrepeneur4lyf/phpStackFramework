<?php

namespace phpStack\Database\Seeder;

use phpStack\Database\Connection;

abstract class Seeder
{
    protected Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    abstract public function run(): void;
}