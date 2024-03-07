<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaginateResource;
use App\Http\Resources\StudentDetailResource;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    public function __construct(private StudentService $studentService)
    {
        $this->middleware('ability:student');
    }

    public function index(Request $request)
    {
        $perPage    = $request->query('per_page', 10);
        $page       = $request->query('page', 1);
        $search     = $request->only(['keyword']);

        $students = $this->studentService->getPaginate($perPage, $page, $search);

        $resource = new PaginateResource($students, StudentResource::class);

        return response()->json($resource, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $this->authorize('create-student', Student::class);

        $student = $this->studentService->createStudent($request->all());

        $route = route('student.show', ['student' => $student->id]);
        $headers = ["Location", $route];

        return response()->json('Successfully created', Response::HTTP_CREATED, $headers);
    }

    public function show(string $id)
    {
        $student = $this->studentService->findStudent($id);

        $this->authorize('detail-student', $student);

        $resource = new StudentDetailResource($student);

        return response()->json($resource, Response::HTTP_OK);
    }

    public function update(Request $request, string $id)
    {
        $student = $this->studentService->findStudent($id);

        $this->authorize('edit-student', $student);

        $this->studentService->updateStudent($student, $request->all());

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }

    public function destroy(string $id)
    {
        $student = $this->studentService->findStudent($id);

        $this->authorize('delete-student', $student);

        $this->studentService->deleteStudent($student);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
