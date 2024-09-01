<?php

namespace phpStack\Database;

use PDO;
use PDOException;
use phpStack\Core\Config;

class Connection
{
    protected PDO $pdo;
    protected Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->connect();
    }

    protected function connect(): void
    {
        $driver = $this->config->get('database.default');
        $config = $this->config->get("database.connections.{$driver}");

        try {
            $this->pdo = new PDO(
                $this->getDsn($driver, $config),
                $config['username'],
                $config['password'],
                $config['options'] ?? []
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException("Failed to connect to database: " . $e->getMessage());
        }
    }

    protected function getDsn(string $driver, array $config): string
    {
        return match ($driver) {
            'mysql' => "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}",
            'pgsql' => "pgsql:host={$config['host']};port={$config['port']};dbname={$config['database']}",
            'sqlite' => "sqlite:{$config['database']}",
            default => throw new PDOException("Unsupported database driver: {$driver}")
        };
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    public function query(string $sql, array $params = []): \PDOStatement
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
        return $statement;
    }

    public function transaction(callable $callback): mixed
    {
        $this->pdo->beginTransaction();
        try {
            $result = $callback($this);
            $this->pdo->commit();
            return $result;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function lastInsertId(): string
    {
        return $this->pdo->lastInsertId();
    }
}
