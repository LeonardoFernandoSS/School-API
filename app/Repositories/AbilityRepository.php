<?php

namespace App\Repositories;

use App\Models\Ability;
use App\Repositories\Interfaces\AbilityRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class AbilityRepository extends EloquentGenericRepository implements AbilityRepositoryInterface
{
    public function __construct(protected Ability $ability)
    {
        parent::__construct($ability);
    }

    public function paginate(int $perPage, int $page, array $search = []): LengthAwarePaginator
    {
        $query = Ability::query();

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
