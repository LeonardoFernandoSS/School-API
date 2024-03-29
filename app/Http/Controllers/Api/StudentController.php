<?php

namespace App\Http\Controllers\Api;

use App\Enums\AbilityEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Student\SearchRequest;
use App\Http\Requests\Student\StoreRequest;
use App\Http\Requests\Student\UpdateRequest;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\StudentDetailResource;
use App\Http\Resources\StudentResource;
use App\Services\StudentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    public function __construct(private StudentService $studentService)
    {
        $this->middleware('ability:' . AbilityEnum::STUDENT);
        $this->middleware('ability:' . AbilityEnum::STUDENT_MANAGE)->except(['index', 'show']);
        $this->middleware('ability:' . AbilityEnum::STUDENT_DETAIL)->only('show');
        $this->middleware('manage.student')->only('update', 'destroy');
    }

    public function index(SearchRequest $request): JsonResponse
    {
        $perPage    = $request->query('per_page', 10);
        $page       = $request->query('page', 1);
        $search     = $request->validated();

        $students = $this->studentService->getPaginate($perPage, $page, $search);

        $resource = new PaginateResource($students, StudentResource::class);

        return response()->json($resource, Response::HTTP_OK);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $student = $this->studentService->createStudent($data);

        $route = route('student.show', ['student' => $student->id]);
        $headers = ["Location" => $route];

        return response()->json('Successfully created', Response::HTTP_CREATED, $headers);
    }

    public function show(string $id): JsonResponse
    {
        $student = $this->studentService->findStudent($id);

        $resource = new StudentDetailResource($student);

        return response()->json($resource, Response::HTTP_OK);
    }

    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $student = $this->studentService->findStudent($id);

        $data = $request->validated();

        $this->studentService->updateStudent($student, $data);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }

    public function destroy(string $id): JsonResponse
    {
        $student = $this->studentService->findStudent($id);

        $this->studentService->deleteStudent($student);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
