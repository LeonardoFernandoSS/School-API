<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('ability:student');
    }

    public function index()
    {
        $students = Student::all();

        return response()->json($students, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        if (!$this->authorize('create-student')) throw new UnauthorizedHttpException('');

        $student = Student::create($request->all());
        $route = route('api.student.show', ['student' => $student->id]);
        $headers = ["Location", $route];

        return response()->json('Successfully created', Response::HTTP_CREATED, $headers);
    }

    public function show(string $id)
    {
        if (!$this->authorize('detail-student')) throw new UnauthorizedHttpException('');

        $student = Student::find($id);

        if (is_null($student)) throw new NotFoundHttpException('');

        return response()->json($student, Response::HTTP_OK);
    }

    public function update(Request $request, string $id)
    {
        if (!$this->authorize('edit-student')) throw new UnauthorizedHttpException('');
    }

    public function destroy(string $id)
    {
        if (!$this->authorize('delete-student')) throw new UnauthorizedHttpException('');
    }
}
