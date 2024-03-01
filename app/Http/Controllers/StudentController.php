<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\error;

class StudentController extends Controller
{
    public function __construct() {
        
        $this->middleware('abilities:student-index');
    }

    public function index()
    {
        // $user = auth()->user;

        // if (!$user->tokenCan('student-index')) {

        //     return response('Unauthorized', 403);
        // }

        $students = Student::all();

        return response($students, 200);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
