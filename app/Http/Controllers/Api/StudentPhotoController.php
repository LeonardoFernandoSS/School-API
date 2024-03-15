<?php

namespace App\Http\Controllers\Api;

use App\Enums\AbilityEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Photo\UploadRequest;
use App\Services\UserPhotoService;
use App\Services\StudentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class StudentPhotoController extends Controller
{
    public function __construct(private StudentService $studentService, private UserPhotoService $userPhotoService)
    {
        $this->middleware('ability:' . AbilityEnum::STUDENT_MANAGE);
        $this->middleware('manage.student');
    }

    public function upload(UploadRequest $request, int $student_id): JsonResponse
    {
        $photo = $request->file('photo');

        $student = $this->studentService->findStudent($student_id);

        $user = $this->userPhotoService->uploadUserPhoto($student->user, $photo);

        $headers = ["Location" => $user->photo_url];

        return response()->json('Successfully uploaded', Response::HTTP_OK, $headers);
    }

    public function delete(string $id): JsonResponse
    {
        $student = $this->studentService->findStudent($id);

        $this->userPhotoService->deleteUserPhoto($student->user);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
