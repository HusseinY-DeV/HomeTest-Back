<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
            "username" => "bail|required|unique:users,username|min:4",
            "password" => "min:8",
        ];
    }

    public function messages()
    {
        return [
            "username.required" => "The username field is required",
            "username.min" => "The username field should be at least 4 characters",
            "username.unique" => "Username already exists",
            "password.min" => "The password field should be at least 8 characters",
        ];
    }

}
