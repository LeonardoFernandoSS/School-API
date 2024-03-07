<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\SearchRequest;
use App\Http\Requests\Student\StoreRequest;
use App\Http\Requests\Student\UpdateRequest;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\StudentDetailResource;
use App\Http\Resources\StudentResource;
use App\Services\StudentService;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    public function __construct(private StudentService $studentService)
    {
        $this->middleware('ability:student');
        $this->middleware('ability:student-manage')->except(['index', 'show']);
        $this->middleware('ability:student-detail')->only('show');
    }

    public function index(SearchRequest $request)
    {
        $perPage    = $request->query('per_page', 10);
        $page       = $request->query('page', 1);
        $search     = $request->validated();

        $students = $this->studentService->getPaginate($perPage, $page, $search);

        $resource = new PaginateResource($students, StudentResource::class);

        return response()->json($resource, Response::HTTP_OK);
    }

    public function store(StoreRequest $request)
    {
        $student = $this->studentService->createStudent($request->validated());

        $route = route('student.show', ['student' => $student->id]);
        $headers = ["Location", $route];

        return response()->json('Successfully created', Response::HTTP_CREATED, $headers);
    }

    public function show(string $id)
    {
        $student = $this->studentService->findStudent($id);

        $resource = new StudentDetailResource($student);

        return response()->json($resource, Response::HTTP_OK);
    }

    public function update(UpdateRequest $request, string $id)
    {
        $student = $this->studentService->findStudent($id);

        $this->studentService->updateStudent($student, $request->validated());

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }

    public function destroy(string $id)
    {
        $student = $this->studentService->findStudent($id);

        $this->studentService->deleteStudent($student);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
