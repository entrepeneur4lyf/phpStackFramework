<?php

namespace phpStack\Database\Migration;

use phpStack\Database\Connection;

class Schema
{
    protected Connection $connection;
    protected array $columns = [];
    protected array $indexes = [];
    protected ?string $primaryKey = null;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function id(): self
    {
        $this->addColumn('id', 'INTEGER', ['unsigned' => true, 'autoIncrement' => true]);
        $this->primary('id');
        return $this;
    }

    public function string(string $name, int $length = 255): self
    {
        return $this->addColumn($name, "VARCHAR({$length})");
    }

    public function integer(string $name): self
    {
        return $this->addColumn($name, 'INTEGER');
    }

    public function text(string $name): self
    {
        return $this->addColumn($name, 'TEXT');
    }

    public function timestamp(string $name): self
    {
        return $this->addColumn($name, 'TIMESTAMP');
    }

    public function addColumn(string $name, string $type, array $options = []): self
    {
        $this->columns[$name] = array_merge(['type' => $type], $options);
        return $this;
    }

    public function primary(string $column): self
    {
        $this->primaryKey = $column;
        return $this;
    }

    public function index(string $column): self
    {
        $this->indexes[] = $column;
        return $this;
    }

    public function toSql(string $table): string
    {
        $columnDefinitions = [];
        foreach ($this->columns as $name => $options) {
            $columnDefinitions[] = $this->columnDefinition($name);
        }

        $sql = "CREATE TABLE {$table} (\n\t" . implode(",\n\t", $columnDefinitions);

        if ($this->primaryKey) {
            $sql .= ",\n\tPRIMARY KEY ({$this->primaryKey})";
        }

        foreach ($this->indexes as $index) {
            $sql .= ",\n\tINDEX ({$index})";
        }

        $sql .= "\n)";

        return $sql;
    }

    public function columnDefinition(string $name): string
    {
        $options = $this->columns[$name];
        $definition = "{$name} {$options['type']}";

        if (!empty($options['unsigned'])) {
            $definition .= ' UNSIGNED';
        }

        if (!empty($options['nullable'])) {
            $definition .= ' NULL';
        } else {
            $definition .= ' NOT NULL';
        }

        if (isset($options['default'])) {
            $definition .= ' DEFAULT ' . $this->connection->getPdo()->quote($options['default']);
        }

        if (!empty($options['autoIncrement'])) {
            $definition .= ' AUTO_INCREMENT';
        }

        return $definition;
    }
}