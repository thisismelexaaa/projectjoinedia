<?php

namespace App\Http\Requests;

<<<<<<< HEAD
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
=======
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
>>>>>>> 8019b8b (70% Progress)

class PendaftaranFormRequest extends FormRequest
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
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 8019b8b (70% Progress)
        // Rules
        $rules = [
            'event_id' => [
                'required', 'string', 'max:255'
            ],
<<<<<<< HEAD
=======
        $rules = [
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
>>>>>>> 8019b8b (70% Progress)
            'nama' => [
                'required', 'string', 'max:255'
            ],
            'email' => [
<<<<<<< HEAD
<<<<<<< HEAD
                'required', 'string', 'max:255'
            ],
            'username' => [
                'required', 'string', 'max:255'
=======
                'required', 'string', 'max:255',
            ],
            'username' => [
                'required', 'string', 'max:255',
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
                'required', 'string', 'max:255'
            ],
            'username' => [
                'required', 'string', 'max:255'
>>>>>>> 8019b8b (70% Progress)
            ],
            'type' => [
                'required', 'string', 'max:255',
            ],
<<<<<<< HEAD
<<<<<<< HEAD
        ];
=======
            'event_id' => [
                'required', 'string', 'max:255',
            ],
            'user_id' => [
                'required', 'string', 'max:255',
            ],
            'nomertiket' => [
                'nullable', 'numeric'
            ],
            'price' => [
                'nullable', 'numeric'
            ],
            'status' => [
                'nullable', 'enum:paid,unpaid', 'default:unpaid'
            ],
        ];

>>>>>>> f89a811 (First Commit : Progress 80%)
=======
        ];
>>>>>>> 8019b8b (70% Progress)
        return $rules;
    }
}
