<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> f89a811 (First Commit : Progress 80%)
=======

>>>>>>> 8019b8b (70% Progress)
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
<<<<<<< HEAD
<<<<<<< HEAD
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
=======
            'eventname' => [
=======
            'nama' => [
>>>>>>> 8019b8b (70% Progress)
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
<<<<<<< HEAD
            'eventkategori' => [
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
            'kategori' => [
>>>>>>> 8019b8b (70% Progress)
                'required', 'string', 'max:255',
            ],
            'user_id' => [
                'required', 'string', 'max:255',
            ],
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 8019b8b (70% Progress)
            'price' => [
                'numeric',
            ],
            'image' => [
                'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048',
            ],
<<<<<<< HEAD
            'kuota' => [
                'numeric', 'required',
            ],
            'level' => [
                'required', 'string', 'max:255',
            ],
        ];
=======
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
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
        ];
>>>>>>> 8019b8b (70% Progress)
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
