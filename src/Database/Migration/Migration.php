<?php

namespace phpStack\Database\Migration;

use phpStack\Database\Connection;

abstract class Migration
{
    protected Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    abstract public function up(): void;

    abstract public function down(): void;

    protected function createTable(string $table, callable $callback): void
    {
        $schema = new Schema($this->connection);
        $callback($schema);
        $this->connection->query($schema->toSql($table));
    }

    protected function dropTable(string $table): void
    {
        $this->connection->query("DROP TABLE IF EXISTS {$table}");
    }

    protected function addColumn(string $table, string $column, string $type, array $options = []): void
    {
        $schema = new Schema($this->connection);
        $schema->addColumn($column, $type, $options);
        $this->connection->query("ALTER TABLE {$table} ADD COLUMN " . $schema->columnDefinition($column));
    }

    protected function dropColumn(string $table, string $column): void
    {
        $this->connection->query("ALTER TABLE {$table} DROP COLUMN {$column}");
    }
}
