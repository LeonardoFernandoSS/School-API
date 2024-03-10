<?php

namespace App\Services;

use App\Models\Student;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StudentPhotoService
{
    const BASE_PHOTO_PATH = "upload/photos/student";

    public function __construct(
        private StudentRepositoryInterface $studentRepository
    ) {
    }

    public function uploadStudentPhoto(Student $student, UploadedFile $photo): Student
    {
        $data['photo_path'] = $this->handlerUploadPhoto($photo, $student);

        return $this->studentRepository->update($student, $data);
    }

    public function deleteStudentPhoto(Student $student): Student
    {
        $this->handlerDeletePhoto($student);

        $data['photo_path'] = null;

        return $this->studentRepository->update($student, $data);
    }

    private function handlerUploadPhoto(UploadedFile $photo, Student $student): string|false
    {
        $name = time() . '.webp';

        $path = Storage::putFileAs(self::BASE_PHOTO_PATH, $photo, $name);

        if (!empty($student->user)) {

            $deletePath = $student->user->photo_path;

            if (is_string($deletePath) && Storage::exists($deletePath)) {

                Storage::delete($deletePath);
            }
        }

        return $path;
    }

    private function handlerDeletePhoto(Student $student): void
    {
        if (!empty($student) && !empty($student->user)) {

            $deletePath = $student->user->photo_path;

            if (is_string($deletePath) && Storage::exists($deletePath)) {

                Storage::delete($deletePath);
            }
        }
    }
}
