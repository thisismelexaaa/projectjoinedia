<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SponsorFormRequest extends FormRequest
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
        $rules = [
            'name' => [
                'required', 'string', 'max:255',
            ],
            'description' => [
                'required', 'string', 'max:255',
            ],
            'start_date' => [
                'required', 'date',
            ],
            'end_date' => [
                'required', 'date',
            ],
        ];
        return $rules;
    }
}
