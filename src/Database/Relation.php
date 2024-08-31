<?php

namespace phpStack\Database;

class Relation
{
    protected $query;
    protected $parent;
    protected $related;
    protected $foreignKey;
    protected $localKey;
    protected $type;

    public function __construct($query, $parent, $related, $foreignKey, $localKey, $type)
    {
        $this->query = $query;
        $this->parent = $parent;
        $this->related = $related;
        $this->foreignKey = $foreignKey;
        $this->localKey = $localKey;
        $this->type = $type;
    }

    public function getResults()
    {
        $results = $this->query->get();

        if ($this->type === 'hasOne') {
            return !empty($results) ? new $this->related($results[0]) : null;
        }

        return array_map(function ($result) {
            return new $this->related($result);
        }, $results);
    }
}