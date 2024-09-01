<?php

namespace phpStack\Database\Relations;

use phpStack\Database\Relation;

class HasMany extends Relation
{
    public function getResults()
    {
        return $this->getRelatedQuery()
            ->where($this->foreignKey, '=', $this->parent->{$this->localKey})
            ->get();
    }

    public function create(array $attributes)
    {
        $attributes[$this->foreignKey] = $this->parent->{$this->localKey};
        return $this->relatedClass::create($attributes);
    }
}