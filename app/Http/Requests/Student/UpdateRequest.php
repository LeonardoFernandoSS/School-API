<?php

namespace App\Http\Requests\Student;

use App\Services\StudentService;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function __construct(private StudentService $studentService)
    {
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('student');

        $student = $this->studentService->findStudent($id);
        
        return [
            'name' => 'required|string|max:60|min:5|unique:users,name,' . $student->user_id . ',id',
            'email' => 'required|email|max:60|min:5|unique:users,email,' . $student->user_id . ',id',
        ];
    }
}
