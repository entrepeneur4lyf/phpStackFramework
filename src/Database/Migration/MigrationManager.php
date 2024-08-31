<?php

namespace phpStack\Database\Migration;

use phpStack\Database\Connection;
use phpStack\Container\Container;

class MigrationManager
{
    protected $connection;
    protected $migrationsPath;
    protected $migrationsTable = 'migrations';

    public function __construct(Connection $connection, $migrationsPath)
    {
        $this->connection = $connection;
        $this->migrationsPath = $migrationsPath;
        $this->ensureMigrationsTableExists();
    }

    protected function ensureMigrationsTableExists()
    {
        $query = "CREATE TABLE IF NOT EXISTS {$this->migrationsTable} (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            batch INT
        )";
        $this->connection->query($query);
    }

    public function getMigrationsFiles()
    {
        return glob($this->migrationsPath . '/*.php');
    }

    public function getRunMigrations()
    {
        return $this->connection->table($this->migrationsTable)->pluck('migration');
    }

    public function runMigrations()
    {
        $files = $this->getMigrationsFiles();
        $ranMigrations = $this->getRunMigrations();
        $batch = $this->getNextBatchNumber();

        foreach ($files as $file) {
            $migrationName = basename($file, '.php');
            if (!in_array($migrationName, $ranMigrations)) {
                $this->runMigration($file, $migrationName, $batch);
            }
        }
    }

    protected function runMigration($file, $migrationName, $batch)
    {
        require_once $file;
        $className = 'Migration_' . $migrationName;
        $migration = new $className($this->connection);
        $migration->up();

        $this->connection->table($this->migrationsTable)->insert([
            'migration' => $migrationName,
            'batch' => $batch
        ]);

        echo "Migrated: $migrationName\n";
    }

    public function rollback()
    {
        $lastBatch = $this->getLastBatchNumber();
        $migrations = $this->connection->table($this->migrationsTable)
            ->where('batch', $lastBatch)
            ->get();

        foreach ($migrations as $migration) {
            $this->rollbackMigration($migration);
        }
    }

    protected function rollbackMigration($migration)
    {
        $file = $this->migrationsPath . '/' . $migration['migration'] . '.php';
        require_once $file;
        $className = 'Migration_' . $migration['migration'];
        $instance = new $className($this->connection);
        $instance->down();

        $this->connection->table($this->migrationsTable)
            ->where('migration', $migration['migration'])
            ->delete();

        echo "Rolled back: {$migration['migration']}\n";
    }

    protected function getNextBatchNumber()
    {
        $lastBatch = $this->getLastBatchNumber();
        return $lastBatch + 1;
    }

    protected function getLastBatchNumber()
    {
        $lastBatch = $this->connection->table($this->migrationsTable)
            ->max('batch');
        return $lastBatch ?: 0;
    }
}