<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\UploadRequest;
use App\Services\StudentPhotoService;
use App\Services\StudentService;
use Illuminate\Http\Response;

class StudentPhotoController extends Controller
{
    public function __construct(private StudentService $studentService, private StudentPhotoService $studentPhotoService)
    {
        $this->middleware('abilities:student,student-manage');
    }

    public function upload(UploadRequest $request, int $student_id)
    {
        $photo = $request->file('photo');

        $student = $this->studentService->findStudent($student_id);

        $student = $this->studentPhotoService->uploadStudentPhoto($student, $photo);

        $headers = ["Location" => $student->user->photo_url];

        return response()->json('Successfully uploaded', Response::HTTP_OK, $headers);
    }

    public function delete(string $id)
    {
        $student = $this->studentService->findStudent($id);

        $this->studentPhotoService->deleteStudentPhoto($student);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}