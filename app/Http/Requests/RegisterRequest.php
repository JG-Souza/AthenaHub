<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Torna student um campo default, caso não seja enviado
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'role' => $this->input('role', 'student'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'string'],
            'role' => ['in:student,teacher,admin'],
            'cpf' => ['required', 'string', 'size:11', 'unique:users,cpf'],
        ];
    }
}
