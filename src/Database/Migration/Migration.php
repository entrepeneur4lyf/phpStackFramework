<?php

namespace phpStack\Database\Migration;

use phpStack\Database\Connection;
use phpStack\Core\Container;

abstract class Migration
{
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    abstract public function up();
    abstract public function down();
}
