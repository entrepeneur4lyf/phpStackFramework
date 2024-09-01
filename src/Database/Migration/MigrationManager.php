<?php

namespace phpStack\Database\Migration;

use phpStack\Database\Connection;

class MigrationManager
{
    protected Connection $connection;
    protected string $migrationPath;
    protected string $migrationTable = 'migrations';

    public function __construct(Connection $connection, string $migrationPath)
    {
        $this->connection = $connection;
        $this->migrationPath = $migrationPath;
        $this->createMigrationTableIfNotExists();
    }

    public function migrate(): void
    {
        $migrations = $this->getPendingMigrations();

        foreach ($migrations as $migration) {
            $this->runMigration($migration);
        }
    }

    public function rollback(int $steps = 1): void
    {
        $migrations = $this->getLastMigrations($steps);

        foreach ($migrations as $migration) {
            $this->rollbackMigration($migration);
        }
    }

    protected function getPendingMigrations(): array
    {
        $files = $this->getMigrationFiles();
        $ran = $this->getRanMigrations();

        return array_diff($files, $ran);
    }

    protected function getLastMigrations(int $steps): array
    {
        $query = $this->connection->query(
            "SELECT migration FROM {$this->migrationTable} ORDER BY id DESC LIMIT ?",
            [$steps]
        );

        return array_column($query->fetchAll(\PDO::FETCH_ASSOC), 'migration');
    }

    protected function getMigrationFiles(): array
    {
        $files = glob($this->migrationPath . '/*.php');
        return array_map('basename', $files);
    }

    protected function getRanMigrations(): array
    {
        $query = $this->connection->query("SELECT migration FROM {$this->migrationTable}");
        return array_column($query->fetchAll(\PDO::FETCH_ASSOC), 'migration');
    }

    protected function runMigration(string $migration): void
    {
        require_once $this->migrationPath . '/' . $migration;

        $class = $this->getMigrationClass($migration);
        $instance = new $class($this->connection);

        $instance->up();

        $this->connection->query(
            "INSERT INTO {$this->migrationTable} (migration) VALUES (?)",
            [$migration]
        );

        echo "Migrated: {$migration}\n";
    }

    protected function rollbackMigration(string $migration): void
    {
        require_once $this->migrationPath . '/' . $migration;

        $class = $this->getMigrationClass($migration);
        $instance = new $class($this->connection);

        $instance->down();

        $this->connection->query(
            "DELETE FROM {$this->migrationTable} WHERE migration = ?",
            [$migration]
        );

        echo "Rolled back: {$migration}\n";
    }

    protected function getMigrationClass(string $migration): string
    {
        return 'Migration_' . pathinfo($migration, PATHINFO_FILENAME);
    }

    protected function createMigrationTableIfNotExists(): void
    {
        $this->connection->query("
            CREATE TABLE IF NOT EXISTS {$this->migrationTable} (
                id INTEGER PRIMARY KEY AUTO_INCREMENT,
                migration VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");
    }
}
