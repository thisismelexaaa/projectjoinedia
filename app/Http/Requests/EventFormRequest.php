<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;


class EventFormRequest extends FormRequest
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
            'nama' => [
                'required', 'string', 'max:255'
            ],
            'start_date' => [
                'required', 'date',
            ],
            'end_date' => [
                'required', 'date',
            ],
            'type' => [
                'required', 'string', 'max:255',
            ],
            'organizer' => [
                'required', 'string', 'max:255',
            ],
            'status' => [
                'required', 'string', 'max:255',
            ],
            'description' => [
                'required', 'string',
            ],
            'location' => [
                'required', 'string', 'max:255',
            ],
            'kategori' => [
                'required', 'string', 'max:255',
            ],
            'user_id' => [
                'required', 'string', 'max:255',
            ],
            'price' => [
                'numeric',
            ],
            'image' => [
                'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048',
            ],
        ];
        return $rules;
    }

    // Custom Message
    public function messages()
    {
        return [
            // name
            'eventname.required' => 'Nama Event Perlu Diisi!',

            // Date
            'eventdate.required' => 'Tanggal Event Perlu Diisi!',

            // Type
            'eventtype.required' => 'Type Event Perlu Diisi!',

            // Organizer
            'eventorganzer.required' => 'Penyelenggara Event Perlu Diisi!',

            // Status
            'eventstatus.required' => 'Status Event Perlu Diisi!',
        ];
    }
}
