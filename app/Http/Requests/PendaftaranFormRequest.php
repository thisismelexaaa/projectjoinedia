<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

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
        // Rules
        $rules = [
            'event_id' => [
                'required', 'string', 'max:255'
            ],
            'nama' => [
                'required', 'string', 'max:255'
            ],
            'email' => [
                'required', 'string', 'max:255'
            ],
            'username' => [
                'required', 'string', 'max:255'
            ],
            'type' => [
                'required', 'string', 'max:255',
            ],
        ];
        return $rules;
    }
}
