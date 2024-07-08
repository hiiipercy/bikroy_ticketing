<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name'      => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email,'.request()->update_id,
            'phone_no'  => 'required|regex:/^01[3-9]\d{8}$/|unique:users,phone_no,'.request()->update_id,
            'role_type' => ['required','in:Admin,User'],
            'password'  => 'nullable','min:6',
            'status'    => ['required','in:1,2'],
            'image'     => ['nullable','image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
        return $rules;
    }
}