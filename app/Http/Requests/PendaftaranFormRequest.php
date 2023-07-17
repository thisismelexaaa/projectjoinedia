<?php

namespace App\Http\Requests;

<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
=======
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
>>>>>>> f89a811 (First Commit : Progress 80%)

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
        // Rules
        $rules = [
            'event_id' => [
                'required', 'string', 'max:255'
            ],
=======
        $rules = [
>>>>>>> f89a811 (First Commit : Progress 80%)
            'nama' => [
                'required', 'string', 'max:255'
            ],
            'email' => [
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
            ],
            'type' => [
                'required', 'string', 'max:255',
            ],
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
        return $rules;
    }
}
