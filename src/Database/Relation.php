<?php

namespace phpStack\Database;

abstract class Relation
{
    protected Model $parent;
    protected string $relatedClass;
    protected string $foreignKey;
    protected string $localKey;

    public function __construct(Model $parent, string $relatedClass, string $foreignKey, string $localKey)
    {
        $this->parent = $parent;
        $this->relatedClass = $relatedClass;
        $this->foreignKey = $foreignKey;
        $this->localKey = $localKey;
    }

    abstract public function getResults();

    protected function getRelatedQuery(): QueryBuilder
    {
        return $this->relatedClass::query();
    }
}