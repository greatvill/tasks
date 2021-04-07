<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractEloquentRepository implements RepositoryInterface
{
    abstract public function getModel():Model;

    public function all()
    {
        $this->getModel()::all();
    }

    public function find(array $condition)
    {

    }

    public function findById($id)
    {
        return $this->getModel()::find($id);
    }

    public function save(array $attributes)
    {
        return $this->getModel()::create($attributes);
    }

    public function update($id, array $attributes)
    {
        $entity = $this->getModel()::findOrFail($id);
        $entity->fill($attributes);
        if (! $entity->save()) {
            throw new \Exception(__('repository.entity_not_updated'));
        }
        return $entity;
    }
}
