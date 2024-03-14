<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
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
        $id = $this->route('user');
        
        return [
            'name' => 'required|string|max:60|min:5|unique:users,name,' . $id . ',id',
            'email' => 'required|email|max:60|min:5|unique:users,email,' . $id . ',id',
        ];
    }
}
