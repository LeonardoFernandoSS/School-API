<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class RoleRepository extends EloquentGenericRepository implements RoleRepositoryInterface
{
    public function __construct(protected Role $role)
    {
        parent::__construct($role);
    }

    public function paginate(int $perPage, int $page, array $search = []): LengthAwarePaginator
    {
        $query = Role::query();

        $query = $this->handlerSearch($query, ...$search);

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    private function handlerSearch(Builder $builder, string $keyword = null): Builder
    {
        if (!is_null($keyword)) {

            $builder->where('name', 'like', "%$keyword%");
        }

        return $builder;
    }
}
