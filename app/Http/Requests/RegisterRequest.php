<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required'],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'password' => ['required', Password::min(8)]
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'No se ha introducido el nombre del usuario',
            'email.required' => 'No se ha introducido un correo',
            'email.email' => 'El correo no es válido',
            'email.unique' => 'Ya existe un usuario con ese correo electrónico',
            'password.required' => 'No se ha introducido una contraseña',
            'password.min' => 'La contraseña ha de tener una longitud mínima de 8 caracteres',
            'password.confirmed' => 'La contraseña de validación no es idéntica',
        ];
    }
}
