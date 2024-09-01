<?php

namespace phpStack\Database;

class QueryBuilder
{
    protected Connection $connection;
    protected string $table = '';
    protected array $columns = ['*'];
    protected array $wheres = [];
    protected array $orderBy = [];
    protected ?int $limit = null;
    protected ?int $offset = null;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function table(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function select(array $columns = ['*']): self
    {
        $this->columns = $columns;
        return $this;
    }

    public function where(string $column, string $operator, $value): self
    {
        $this->wheres[] = compact('column', 'operator', 'value');
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): self
    {
        $this->orderBy[] = compact('column', 'direction');
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    public function get(): array
    {
        $sql = $this->toSql();
        $statement = $this->connection->query($sql, $this->getBindings());
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function first()
    {
        $result = $this->limit(1)->get();
        return $result[0] ?? null;
    }

    public function insert(array $data): bool
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        return $this->connection->query($sql, array_values($data))->rowCount() > 0;
    }

    public function update(array $data): int
    {
        $set = implode(', ', array_map(fn($col) => "{$col} = ?", array_keys($data)));
        $sql = "UPDATE {$this->table} SET {$set}" . $this->compileWheres();
        $bindings = array_merge(array_values($data), $this->getWhereBindings());
        return $this->connection->query($sql, $bindings)->rowCount();
    }

    public function delete(): int
    {
        $sql = "DELETE FROM {$this->table}" . $this->compileWheres();
        return $this->connection->query($sql, $this->getWhereBindings())->rowCount();
    }

    protected function toSql(): string
    {
        $sql = "SELECT " . implode(', ', $this->columns) . " FROM {$this->table}";
        $sql .= $this->compileWheres();
        $sql .= $this->compileOrderBy();
        $sql .= $this->compileLimit();
        $sql .= $this->compileOffset();
        return $sql;
    }

    protected function compileWheres(): string
    {
        if (empty($this->wheres)) {
            return '';
        }
        $conditions = array_map(fn($where) => "{$where['column']} {$where['operator']} ?", $this->wheres);
        return " WHERE " . implode(' AND ', $conditions);
    }

    protected function compileOrderBy(): string
    {
        if (empty($this->orderBy)) {
            return '';
        }
        $orders = array_map(fn($order) => "{$order['column']} {$order['direction']}", $this->orderBy);
        return " ORDER BY " . implode(', ', $orders);
    }

    protected function compileLimit(): string
    {
        return $this->limit !== null ? " LIMIT {$this->limit}" : '';
    }

    protected function compileOffset(): string
    {
        return $this->offset !== null ? " OFFSET {$this->offset}" : '';
    }

    protected function getBindings(): array
    {
        return array_merge($this->getWhereBindings(), $this->getOrderByBindings());
    }

    protected function getWhereBindings(): array
    {
        return array_column($this->wheres, 'value');
    }

    protected function getOrderByBindings(): array
    {
        return [];
    }
}
