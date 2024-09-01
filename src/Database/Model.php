<?php

namespace phpStack\Database;

use phpStack\Core\Container;

/**
 * @phpstan-consistent-constructor
 */
abstract class Model
{
    protected static string $table;
    protected static array $fillable = [];
    protected array $attributes = [];
    protected array $original = [];
    protected static ?Connection $connection = null;

    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    public static function getTable(): string
    {
        return static::$table ?? strtolower(class_basename(static::class)) . 's';
    }

    public static function getConnection(): Connection
    {
        if (static::$connection === null) {
            static::$connection = Container::getInstance()->make(Connection::class);
        }
        return static::$connection;
    }

    public static function query(): QueryBuilder
    {
        return (new QueryBuilder(static::getConnection()))->table(static::getTable());
    }

    public static function create(array $attributes): static
    {
        $model = new static($attributes);
        $model->save();
        return $model;
    }

    public function fill(array $attributes): self
    {
        foreach ($attributes as $key => $value) {
            if (in_array($key, static::$fillable)) {
                $this->setAttribute($key, $value);
            }
        }
        return $this;
    }

    public function setAttribute($key, $value): void
    {
        $this->attributes[$key] = $value;
    }

    public function getAttribute($key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function save(): bool
    {
        if (empty($this->attributes)) {
            return false;
        }

        if (isset($this->attributes['id'])) {
            return $this->update();
        }

        return $this->insert();
    }

    protected function insert(): bool
    {
        $result = static::query()->insert($this->attributes);
        if ($result) {
            $this->attributes['id'] = static::getConnection()->lastInsertId();
            $this->syncOriginal();
        }
        return $result;
    }

    protected function update(): bool
    {
        $dirty = $this->getDirty();
        if (empty($dirty)) {
            return true;
        }

        $result = static::query()
            ->where('id', '=', $this->attributes['id'])
            ->update($dirty);

        if ($result) {
            $this->syncOriginal();
        }

        return (bool) $result;
    }

    public function delete(): bool
    {
        if (!isset($this->attributes['id'])) {
            return false;
        }

        return (bool) static::query()
            ->where('id', '=', $this->attributes['id'])
            ->delete();
    }

    public static function find($id)
    {
        return static::query()->where('id', '=', $id)->first();
    }

    public static function all(): array
    {
        return static::query()->get();
    }

    protected function getDirty(): array
    {
        return array_diff_assoc($this->attributes, $this->original);
    }

    protected function syncOriginal(): void
    {
        $this->original = $this->attributes;
    }

    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }

    public function toArray(): array
    {
        return $this->attributes;
    }

    public function hasMany(string $relatedClass, string $foreignKey = null, string $localKey = 'id'): Relations\HasMany
    {
        $foreignKey = $foreignKey ?? $this->getForeignKey();
        return new Relations\HasMany($this, $relatedClass, $foreignKey, $localKey);
    }

    protected function getForeignKey(): string
    {
        return strtolower(class_basename($this)) . '_id';
    }
}
