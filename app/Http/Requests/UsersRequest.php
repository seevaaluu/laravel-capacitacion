<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'name' => 'required|string|max:255|regex:/^[A-Za-z0-9]+$/',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del cliente es obligatorio.',
            'name.max' => 'El nombre del cliente debe tener mas de 255 caracteres.',
            'email.unique:users' => 'El correo electrónico ya está en uso.',
            'name.regex' => 'El nombre del cliente solo debe contener letras y números.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre del cliente',
            'email' => 'correo electrónico'
        ];
    }
}
