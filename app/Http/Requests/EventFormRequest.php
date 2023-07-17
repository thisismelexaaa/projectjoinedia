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
            'eventname' => [
                'required', 'string', 'max:255'
            ],
            'eventdate' => [
                'required', 'string', 'max:255',
            ],
            'eventtype' => [
                'required', 'string', 'max:255',
            ],
            'eventorganizer' => [
                'required', 'string', 'max:255',
            ],
            'eventstatus' => [
                'required', 'string', 'max:255',
            ],
            'eventdescription' => [
                'required', 'string',
            ],
            'eventlocation' => [
                'required', 'string', 'max:255',
            ],
            'eventkategori' => [
                'required', 'string', 'max:255',
            ],
            'user_id' => [
                'required', 'string', 'max:255',
            ],
            'eventprice' => 'numeric',
        ];

        // Create Event
        // if ($this->getMethod() == "POST") {
        //     $rules += [
        //         'eventname' => [
        //             'required', 'string', 'max:255'
        //         ],
        //         'eventdate' => [
        //             'required', 'string', 'max:255',
        //         ],
        //         'eventtype' => [
        //             'required', 'string', 'max:255',
        //         ],
        //         'eventorganizer' => [
        //             'required', 'string', 'max:255',
        //         ],
        //         'eventstatus' => [
        //             'required', 'string', 'max:255',
        //         ],
        //         'eventimage' => [
        //             'image',
        //         ],
        //         'eventkategori' => [
        //             'required', 'string', 'max:255',
        //         ],
        //         'eventlocation' => [
        //             'required', 'string', 'max:255',
        //         ],
        //         'eventdescription' => [
        //             'required', 'string',
        //         ],
        //         'user_id' => [
        //             'required', 'string', 'max:255',
        //         ],
        //         'eventprice' => 'numeric'
        //     ];
        // }

        // Edit Event
        // if ($this->getMethod() == "PUT") {
        //     $rules += [
        //         'eventname' => [
        //             'required', 'string', 'max:255'
        //         ],
        //         'eventdate' => [
        //             'required', 'string', 'max:255',
        //         ],
        //         'eventtype' => [
        //             'required', 'string', 'max:255',
        //         ],
        //         'eventorganizer' => [
        //             'required', 'string', 'max:255',
        //         ],
        //         'eventstatus' => [
        //             'required', 'string', 'max:255',
        //         ],
        //         'eventimage' => [
        //             'image',
        //         ],
        //         'eventdescription' => [
        //             'required', 'string', 'max:255',
        //         ],
        //         'eventlocation' => [
        //             'required', 'string', 'max:255',
        //         ],
        //         'eventkategori' => [
        //             'required', 'string',
        //         ],
        //         'user_id' => [
        //             'required', 'string', 'max:255',
        //         ],
        //         'eventprice' => 'numeric'
        //     ];
        // }
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
