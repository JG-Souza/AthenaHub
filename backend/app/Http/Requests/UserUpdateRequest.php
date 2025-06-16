<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = auth()->user();

        /**
         * ao atualizar, permite que o usuário mantenha seu próprio e-mail e CPF
         * sem disparar erro de "já existe". A regra 'unique' ignora o ID que vem na rota.
         */

        $rules = [
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $this->route('id'),
            'password' => 'sometimes|string|min:8',
            'phone' => 'sometimes|string',
            'cpf' => 'sometimes|string|size:11|unique:users,cpf,' . $this->route('id'),
        ];

        if ($user && $user->role === 'admin') {
            $rules['role'] = 'sometimes|string|in:student,teacher,admin';
        }

        return $rules;
    }
}
