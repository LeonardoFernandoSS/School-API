<?php

namespace App\Http\Middleware;

use App\Services\StudentService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ManageStudentMiddleware
{
    public function __construct(private StudentService $studentService) {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $student_id = $request->route('student');

        $student = $this->studentService->findStudent($student_id);

        Gate::authorize('manageStudent', $student);

        return $next($request);
    }
}
