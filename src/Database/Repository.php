<?php

namespace phpStack\Database;

abstract class Repository
{
    protected Model $model;

    public function __construct()
    {
        $this->model = $this->getModelClass();
    }

    abstract protected function getModelClass(): Model;

    public function all(): array
    {
        return $this->model::all();
    }

    public function find($id)
    {
        return $this->model::find($id);
    }

    public function create(array $attributes)
    {
        return $this->model::create($attributes);
    }

    public function update($id, array $attributes)
    {
        $model = $this->find($id);
        if ($model) {
            $model->fill($attributes);
            $model->save();
        }
        return $model;
    }

    public function delete($id): bool
    {
        $model = $this->find($id);
        return $model ? $model->delete() : false;
    }
}