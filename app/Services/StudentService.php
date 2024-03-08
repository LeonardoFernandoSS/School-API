<?php

namespace App\Services;

use App\Models\Student;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StudentService
{
    public function __construct(
        private StudentRepositoryInterface $studentRepository
    ) {
    }

    public function getPaginate($perPage, $page, array $search): LengthAwarePaginator
    {
        return $this->studentRepository->paginate($perPage, $page, $search);
    }

    public function createStudent(array $data): Student
    {
        $data['remember_token'] = Str::random(10);

        return $this->studentRepository->create($data);
    }

    public function findStudent(string $id): ?Student
    {
        $student = $this->studentRepository->find($id);

        if (is_null($student)) throw new NotFoundHttpException('');

        return $student;
    }

    public function updateStudent(Student $student, array $data): Student
    {
        return $this->studentRepository->update($student, $data);
    }

    public function deleteStudent(Student $student): Student
    {
        return $this->studentRepository->delete($student);
    }
}
