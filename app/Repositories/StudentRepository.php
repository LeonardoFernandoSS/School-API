<?php

namespace App\Repositories;

use App\Enums\StatusEnum;
use App\Models\Student;
use App\Models\User;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class StudentRepository extends EloquentGenericRepository implements StudentRepositoryInterface
{
    public function __construct(protected Student $student)
    {
        parent::__construct($student);
    }

    public function paginate(int $perPage, int $page, array $search = []): LengthAwarePaginator
    {
        $query = Student::query();

        $query = $this->handlerSearch($query, ...$search);

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    public function create(array $data): Model
    {
        return DB::transaction(function () use ($data) {

            $user = User::create(Arr::only($data, ['name', 'email', 'password', 'remember_token', 'token']));

            $data['user_id'] = $user->id;

            return $user->student()->create(Arr::only($data, ['user_id']));
        });
    }

    public function update(Model $student, array $data): Model
    {
        return DB::transaction(function () use ($student, $data) {

            $student->user->update(Arr::only($data, ['name', 'email']));

            return $student;
        });
    }

    public function delete(Model $student): Student
    {
        $student->user->status = StatusEnum::DELETE;
        $student->user->save();

        return $student;
    }

    private function handlerSearch(Builder $builder, string $keyword = null): Builder
    {
        if (!is_null($keyword)) {

            $builder->whereHas(User::class, fn ($query) => $query->where('name', 'like', "%$keyword%"));
        }

        return $builder;
    }
}
