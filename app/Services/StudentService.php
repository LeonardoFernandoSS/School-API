<?php

namespace App\Services;

use App\Models\Student;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StudentService
{
    const BASE_PHOTO_PATH = "upload/photos/student/";

    public function __construct(
        private StudentRepositoryInterface $studentRepository
    ) {
    }

    public function getPaginate($perPage, $page, array $search): LengthAwarePaginator
    {
        return $this->studentRepository->paginate($perPage, $page, $search);
    }

    public function createStudent(array $data, UploadedFile $photo = null): Student
    {
        if (!is_null($photo)) {

            $data['photo_path'] = $this->handlerPhoto($photo);
        }

        $data['remember_token'] = Str::random(10);

        return $this->studentRepository->create($data);
    }

    public function findStudent(string $id): ?Student
    {
        $student = $this->studentRepository->find($id);

        if (is_null($student)) throw new NotFoundHttpException('');

        return $student;
    }

    public function updateStudent(Student $student, array $data, UploadedFile $photo = null): Student
    {
        if (!is_null($photo)) {

            $data['photo_path'] = $this->handlerPhoto($photo);
        }

        return $this->studentRepository->update($student, $data);
    }

    public function deleteStudent(Student $student): Student
    {
        return $this->studentRepository->delete($student);
    }

    public function handlerPhoto(UploadedFile $photo, ?Student $student = null): string
    {
        $path = self::BASE_PHOTO_PATH . time() . '.webp';

        Storage::putFile($path, $photo);

        if (!empty($student) && !empty($student->user)) {

            $deletePath = $student->user->photo_path;

            if (is_string($deletePath) && Storage::exists($deletePath)) {

                Storage::delete($deletePath);
            }
        }

        return $path;
    }
}
