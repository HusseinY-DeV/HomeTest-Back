<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAdminRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'bail|required|min:4|string|unique:users,username,except,id',
            'password' => 'bail|required|min:8|string',
        ];
    }

    public function messages()
    {
        return [
            "username.min" => "Make sure your username is greater than 4 characters",
            "username.required" => "The username field is required",
            "username.unique" => "Username already exists",
            "password.min" => "Make sure your password is greater than 8 characters",
            "password.required" => "The password field is required",
        ];
    }
}
