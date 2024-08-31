<?php

namespace phpStack\Database;

class QueryBuilder
{
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function table(string $table)
    {
        // Implement table method
    }

    public function where($column, $value)
    {
        // Implement where method
    }

    public function get()
    {
        // Implement get method
    }

    public function first()
    {
        // Implement first method
    }

    public function insert(array $data)
    {
        // Implement insert method
    }

    public function update(array $data)
    {
        // Implement update method
    }

    public function delete()
    {
        // Implement delete method
    }

    public function max(string $column)
    {
        // Implement max method
    }

    public function pluck(string $column)
    {
        // Implement pluck method
    }
}
