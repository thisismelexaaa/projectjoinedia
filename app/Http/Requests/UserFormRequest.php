<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // Rules
        $rules = [
            'name' => [
                'required', 'string', 'max:255'
            ],
            'password' => [
                'required', 'string', 'min:6', 'max:255',
            ],
            'role' => [
                'required', 'string', 'max:255',
            ],
            'userimage' => [
                'nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048',
            ],
            'jurusan' => [
                'nullable', 'string', 'max:255',
            ],
            'bio' => [
                'nullable', 'string', 'max:255',
            ],
        ];

        // Create User
        if ($this->getMethod() == "POST") {
            $rules += [
                'username' => [
                    'required', 'string', 'max:255', 'unique:users,username'
                ],
                'email' => [
                    'required', 'email', 'max:255', 'unique:users,email'
                ],
            ];
        }

        // Edit User
        if ($this->getMethod() == "PUT") {
            $rules += [
                'username' => [
                    'required', 'string', 'max:255',
                    Rule::unique('users', 'username')->ignore($this->user)
                ],
                'email' => [
                    'required', 'email', 'max:255',
                    Rule::unique('users', 'email')->ignore($this->user)
                ],
            ];
        }
        return $rules;
    }

    // Custom Message
    public function messages()
    {
        return [
            // name
            'name.required' => 'Nama Perlu Diisi!',

            // Username
            'username.required' => 'Username Perlu Diisi!',
            'username.unique' => 'Username Sudah Ada!',

            // Email
            'email.required' => 'Email Perlu Diisi!',
            'email.email' => 'Masukkan Email Dengan Benar!',
            'email.unique' => 'Email Sudah Ada!',

            // password
            'password.required' => 'Password Perlu Diisi!',
            'password.min' => 'Password Minimal 6 Karakter!',

            // role
            'role.required' => 'Role Perlu Diisi!',
        ];
    }
}
