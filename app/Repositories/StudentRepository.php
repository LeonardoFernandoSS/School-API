<?php

namespace App\Repositories;

use App\Enums\StatusEnum;
use App\Models\Student;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function delete(Model $student): Student
    {
        $student->status = StatusEnum::DELETE;
        $student->save();

        return $student;
    }

    private function handlerSearch(Builder $builder, string $keyword = null): Builder
    {
        if (!is_null($keyword)) {

            return $builder->where('name', 'like', "%$keyword%");
        }

        return $builder;        
    }
}
