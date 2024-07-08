<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [

            'subject_id'    => 'required|max:255',
            'description'   => 'required|min:4|max:1000',
            'attach_file'   => ['nullable','image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'video_link'    => ['nullable','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'ticket_status' => 'required|max:255',
        ];

        return $rules;
    }
}
