<?php

namespace phpStack\Database\Seeder;

use phpStack\Database\Connection;

class SeederManager
{
    protected Connection $connection;
    protected string $seederPath;

    public function __construct(Connection $connection, string $seederPath)
    {
        $this->connection = $connection;
        $this->seederPath = $seederPath;
    }

    public function seed(string $seeder = null): void
    {
        if ($seeder) {
            $this->runSeeder($seeder);
        } else {
            $this->runAllSeeders();
        }
    }

    protected function runAllSeeders(): void
    {
        $seeders = $this->getSeederFiles();

        foreach ($seeders as $seeder) {
            $this->runSeeder($seeder);
        }
    }

    protected function runSeeder(string $seeder): void
    {
        $seederFile = $this->seederPath . '/' . $seeder . '.php';

        if (!file_exists($seederFile)) {
            throw new \RuntimeException("Seeder file not found: {$seederFile}");
        }

        require_once $seederFile;

        $class = $this->getSeederClass($seeder);
        $instance = new $class($this->connection);

        $instance->run();

        echo "Seeded: {$seeder}\n";
    }

    protected function getSeederFiles(): array
    {
        $files = glob($this->seederPath . '/*.php');
        return array_map(function ($file) {
            return pathinfo($file, PATHINFO_FILENAME);
        }, $files);
    }

    protected function getSeederClass(string $seeder): string
    {
        return $seeder;
    }
}