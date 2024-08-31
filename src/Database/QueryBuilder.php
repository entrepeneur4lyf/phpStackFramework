<?php

namespace phpStack\Database;

class QueryBuilder
{
    protected Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function table(string $table): self
    {
        // Implement table method
        return $this;
    }

    public function where(string $column, mixed $value): self
    {
        // Implement where method
        return $this;
    }

    public function get(): array
    {
        // Implement get method
        return [];
    }

    public function first(): ?array
    {
        // Implement first method
        return null;
    }

    public function insert(array $data): bool
    {
        // Implement insert method
        return false;
    }

    public function update(array $data): int
    {
        // Implement update method
        return 0;
    }

    public function delete(): int
    {
        // Implement delete method
        return 0;
    }

    public function max(string $column): mixed
    {
        // Implement max method
        return null;
    }

    public function pluck(string $column): array
    {
        // Implement pluck method
        return [];
    }
}
