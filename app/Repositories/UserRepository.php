<?php

namespace App\Repositories;

use App\Enums\StatusEnum;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends EloquentGenericRepository implements UserRepositoryInterface
{
    public function __construct(protected User $student)
    {
        parent::__construct($student);
    }

    public function paginate(int $perPage, int $page, array $search = []): LengthAwarePaginator
    {
        $query = User::query();

        $query = $this->handlerSearch($query, ...$search);

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    public function delete(Model $student): User
    {
        $student->user->status = StatusEnum::DELETE;
        $student->user->save();

        return $student;
    }

    private function handlerSearch(Builder $builder, string $keyword = null): Builder
    {
        if (!is_null($keyword)) {

            $builder->where('name', 'like', "%$keyword%");
        }

        return $builder;
    }
}
