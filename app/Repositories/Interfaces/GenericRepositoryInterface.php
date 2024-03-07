<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface GenericRepositoryInterface
{
    public function getAll(): Collection;
    public function find(string $id): ?Model;
    public function create(array $data): Model;
    public function update(Model $model, array $data): Model;
    public function delete(Model $model): Model;
    public function paginate(int $perPage, int $page): iterable;
}
