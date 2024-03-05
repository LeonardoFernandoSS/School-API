<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $this->authorize('create-student', Student::class);

        $student = Student::create($request->all());
        $route = route('student.show', ['student' => $student->id]);
        $headers = ["Location", $route];

        return response()->json('Successfully created', Response::HTTP_CREATED, $headers);
    }

    public function show(string $id)
    {
        $student = Student::find($id);

        if (is_null($student)) throw new NotFoundHttpException('');

        $this->authorize('detail-student', $student);

        return response()->json($student, Response::HTTP_OK);
    }

    public function update(Request $request, string $id)
    {
        $student = Student::find($id);

        if (is_null($student)) throw new NotFoundHttpException('');

        $this->authorize('edit-student', $student);

        $student->update($request->all());

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }

    public function destroy(string $id)
    {
        $student = Student::find($id);

        if (is_null($student)) throw new NotFoundHttpException('');

        $this->authorize('delete-student', $student);

        $student->status = StatusEnum::DELETE;
        $student->save();

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
