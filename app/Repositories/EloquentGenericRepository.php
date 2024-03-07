<?php

namespace App\Repositories;

use App\Repositories\Interfaces\GenericRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class EloquentGenericRepository implements GenericRepositoryInterface
{
    public function __construct(protected Model $model)
    {
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function find(string $id): ?Model
    {
        return $this->model->find($id);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(Model $model, array $data): Model
    {
        $model->update($data);

        return $model;
    }

    public function delete(Model $model): Model
    {
        $model->delete();

        return $model;
    }

    public function paginate(int $perPage, int $page): iterable
    {
        return Model::paginate($perPage, ['*'], 'page', $page);
    }
}
