# Phase 2 Development Guide: Database Abstraction and ORM

## 1. Develop Database Components

### Connection Class

First, let's create a Connection class to manage database connections:

File: `src/Database/Connection.php`

```php
<?php

namespace YourFramework\Database;

use PDO;
use PDOException;

class Connection
{
    protected PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = "mysql:host={$config['host']};dbname={$config['database']};charset={$config['charset']}";
        
        try {
            $this->pdo = new PDO($dsn, $config['username'], $config['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            throw new \Exception("Database connection failed: " . $e->getMessage());
        }
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
```

### QueryBuilder Class

Now, let's create a QueryBuilder to construct SQL queries:

File: `src/Database/QueryBuilder.php`

```php
<?php

namespace YourFramework\Database;

class QueryBuilder
{
    protected Connection $connection;
    protected string $table;
    protected array $wheres = [];
    protected array $bindings = [];

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function table(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function where(string $column, string $operator, $value): self
    {
        $this->wheres[] = "$column $operator ?";
        $this->bindings[] = $value;
        return $this;
    }

    public function get(): array
    {
        $sql = "SELECT * FROM {$this->table}";
        
        if (!empty($this->wheres)) {
            $sql .= " WHERE " . implode(' AND ', $this->wheres);
        }

        $stmt = $this->connection->getPdo()->prepare($sql);
        $stmt->execute($this->bindings);

        return $stmt->fetchAll();
    }

    public function insert(array $data): int
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";

        $stmt = $this->connection->getPdo()->prepare($sql);
        $stmt->execute(array_values($data));

        return (int) $this->connection->getPdo()->lastInsertId();
    }

    // Add update and delete methods here
}
```

## 2. Create ORM Features

### Model Class

Let's create a basic Model class that will serve as the foundation for our ORM:

File: `src/Database/Model.php`

```php
<?php

namespace YourFramework\Database;

abstract class Model
{
    protected static string $table;
    protected array $attributes = [];
    protected static QueryBuilder $query;

    public static function setQueryBuilder(QueryBuilder $query)
    {
        static::$query = $query;
    }

    public static function find(int $id)
    {
        return static::$query->table(static::$table)->where('id', '=', $id)->get()[0] ?? null;
    }

    public static function all(): array
    {
        return static::$query->table(static::$table)->get();
    }

    public function save(): bool
    {
        if (isset($this->attributes['id'])) {
            // Update existing record
            return static::$query->table(static::$table)
                ->where('id', '=', $this->attributes['id'])
                ->update($this->attributes);
        } else {
            // Insert new record
            $id = static::$query->table(static::$table)->insert($this->attributes);
            $this->attributes['id'] = $id;
            return $id !== false;
        }
    }

    public function __get(string $name)
    {
        return $this->attributes[$name] ?? null;
    }

    public function __set(string $name, $value)
    {
        $this->attributes[$name] = $value;
    }
}
```

## 3. Implement Repository Pattern

Let's create a base Repository class and an example implementation:

File: `src/Database/Repository.php`

```php
<?php

namespace YourFramework\Database;

abstract class Repository
{
    protected QueryBuilder $query;
    protected string $model;

    public function __construct(QueryBuilder $query)
    {
        $this->query = $query;
    }

    public function find(int $id)
    {
        return $this->query->table($this->getTable())->where('id', '=', $id)->get()[0] ?? null;
    }

    public function all(): array
    {
        return $this->query->table($this->getTable())->get();
    }

    protected function getTable(): string
    {
        return $this->model::$table;
    }
}
```

Example implementation:

File: `src/Database/Repositories/UserRepository.php`

```php
<?php

namespace YourFramework\Database\Repositories;

use YourFramework\Database\Repository;
use App\Models\User;

class UserRepository extends Repository
{
    protected string $model = User::class;

    public function findByEmail(string $email)
    {
        return $this->query->table($this->getTable())
            ->where('email', '=', $email)
            ->get()[0] ?? null;
    }
}
```

## 4. Database Migrations

Let's create a simple migration system:

File: `src/Database/Migration.php`

```php
<?php

namespace YourFramework\Database;

abstract class Migration
{
    protected Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    abstract public function up(): void;
    abstract public function down(): void;

    protected function createTable(string $table, array $columns): void
    {
        $columnsSQL = implode(', ', $columns);
        $sql = "CREATE TABLE IF NOT EXISTS $table ($columnsSQL)";
        $this->connection->getPdo()->exec($sql);
    }

    protected function dropTable(string $table): void
    {
        $sql = "DROP TABLE IF EXISTS $table";
        $this->connection->getPdo()->exec($sql);
    }
}
```

Example migration:

File: `database/migrations/CreateUsersTable.php`

```php
<?php

use YourFramework\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        $this->createTable('users', [
            'id INT AUTO_INCREMENT PRIMARY KEY',
            'name VARCHAR(255) NOT NULL',
            'email VARCHAR(255) NOT NULL UNIQUE',
            'password VARCHAR(255) NOT NULL',
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
        ]);
    }

    public function down(): void
    {
        $this->dropTable('users');
    }
}
```

## Integration with the Framework

Now, let's integrate these database components into our framework:

1. Add database configuration:

File: `config/database.php`

```php
<?php

return [
    'default' => 'mysql',
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'your_database',
            'username' => 'your_username',
            'password' => 'your_password',
            'charset' => 'utf8mb4',
        ],
    ],
];
```

2. Create a DatabaseServiceProvider:

File: `src/Providers/DatabaseServiceProvider.php`

```php
<?php

namespace YourFramework\Providers;

use YourFramework\Core\ServiceProvider;
use YourFramework\Database\Connection;
use YourFramework\Database\QueryBuilder;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->container->bind(Connection::class, function ($container) {
            $config = $container->make('config')->get('database.connections.mysql');
            return new Connection($config);
        });

        $this->container->bind(QueryBuilder::class, function ($container) {
            return new QueryBuilder($container->make(Connection::class));
        });
    }
}
```

3. Register the DatabaseServiceProvider in your Application class:

Update `src/Core/Application.php`:

```php
<?php

namespace YourFramework\Core;

use YourFramework\Providers\DatabaseServiceProvider;

class Application
{
    // ... existing code ...

    public function boot(): void
    {
        $this->registerServiceProviders();
        // ... other boot logic ...
    }

    protected function registerServiceProviders(): void
    {
        $providers = [
            DatabaseServiceProvider::class,
            // ... other service providers ...
        ];

        foreach ($providers as $provider) {
            $providerInstance = new $provider($this->container);
            $providerInstance->register();
            $providerInstance->boot();
        }
    }

    // ... existing code ...
}
```

With these components in place, you now have a basic database abstraction layer and ORM system. You can use it like this:

```php
<?php

use App\Models\User;
use YourFramework\Database\QueryBuilder;

// In a controller or service:
$queryBuilder = $this->container->make(QueryBuilder::class);
User::setQueryBuilder($queryBuilder);

// Find a user
$user = User::find(1);

// Create a new user
$newUser = new User();
$newUser->name = 'John Doe';
$newUser->email = 'john@example.com';
$newUser->password = password_hash('secret', PASSWORD_DEFAULT);
$newUser->save();

// Using a repository
$userRepository = new UserRepository($queryBuilder);
$user = $userRepository->findByEmail('john@example.com');
```

This setup provides a solid foundation for database operations in your framework. In the next phases, we'll build upon this to add more advanced features like relationships, lazy loading, and more sophisticated querying capabilities.
