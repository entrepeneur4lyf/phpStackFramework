<?php

namespace phpStack\Database;

use phpStack\Database\QueryBuilder;

abstract class Model
{
    protected $table;
    protected $primaryKey = 'id';
    protected $attributes = [];
    protected $relations = [];
    protected static $queryBuilder;

    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    public function fill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }
    }

    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function getAttribute($key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->attributes)) {
            return $this->getAttribute($key);
        }

        if (method_exists($this, $key)) {
            return $this->getRelationValue($key);
        }
    }

    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }

    // CRUD Operations
    public function save()
    {
        $query = self::getQueryBuilder();
        if (isset($this->attributes[$this->primaryKey])) {
            // Update
            $query->table($this->table)
                  ->where($this->primaryKey, $this->attributes[$this->primaryKey])
                  ->update($this->attributes);
        } else {
            // Insert
            $id = $query->table($this->table)->insert($this->attributes);
            $this->setAttribute($this->primaryKey, $id);
        }
        return $this;
    }

    public static function find($id)
    {
        $query = self::getQueryBuilder();
        $model = new static();
        $result = $query->table($model->table)
                        ->where($model->primaryKey, $id)
                        ->first();
        return $result ? new static($result) : null;
    }

    public static function all()
    {
        $query = self::getQueryBuilder();
        $model = new static();
        $results = $query->table($model->table)->get();
        return array_map(function ($result) {
            return new static($result);
        }, $results);
    }

    public function delete()
    {
        $query = self::getQueryBuilder();
        return $query->table($this->table)
                     ->where($this->primaryKey, $this->attributes[$this->primaryKey])
                     ->delete();
    }

    // Relationship methods
    public function hasOne($related, $foreignKey = null, $localKey = null)
    {
        $foreignKey = $foreignKey ?: $this->getForeignKey();
        $localKey = $localKey ?: $this->primaryKey;
        return $this->getRelationship($related, $foreignKey, $localKey, 'hasOne');
    }

    public function hasMany($related, $foreignKey = null, $localKey = null)
    {
        $foreignKey = $foreignKey ?: $this->getForeignKey();
        $localKey = $localKey ?: $this->primaryKey;
        return $this->getRelationship($related, $foreignKey, $localKey, 'hasMany');
    }

    public function belongsTo($related, $foreignKey = null, $ownerKey = null)
    {
        $foreignKey = $foreignKey ?: $this->getForeignKey($related);
        $ownerKey = $ownerKey ?: (new $related)->primaryKey;
        return $this->getRelationship($related, $foreignKey, $ownerKey, 'belongsTo');
    }

    protected function getRelationship($related, $foreignKey, $localKey, $type)
    {
        $query = self::getQueryBuilder();
        $relatedModel = new $related;

        if ($type === 'belongsTo') {
            $query->table($relatedModel->table)
                  ->where($localKey, $this->getAttribute($foreignKey));
        } else {
            $query->table($relatedModel->table)
                  ->where($foreignKey, $this->getAttribute($localKey));
        }

        return new Relation($query, $this, $relatedModel, $foreignKey, $localKey, $type);
    }

    protected function getForeignKey($related = null)
    {
        if ($related) {
            return strtolower(basename(str_replace('\\', '/', $related))) . '_id';
        }
        return strtolower(basename(str_replace('\\', '/', get_class($this)))) . '_id';
    }

    protected function getRelationValue($key)
    {
        if (!isset($this->relations[$key])) {
            $this->relations[$key] = $this->$key()->getResults();
        }
        return $this->relations[$key];
    }

    protected static function getQueryBuilder()
    {
        if (!self::$queryBuilder) {
            $config = Container::getInstance()->get('config');
            self::$queryBuilder = new QueryBuilder(new Connection(
                $config['database']['host'],
                $config['database']['database'],
                $config['database']['username'],
                $config['database']['password']
            ));
        }
        return self::$queryBuilder;
    }
}
