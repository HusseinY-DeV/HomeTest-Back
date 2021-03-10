<?php

namespace App\Http\Requests\Patients;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPatientRequest extends FormRequest
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
            "first_name" => "bail|required|alpha",
            "last_name" => "bail|required|alpha",
            "phone_number" => "bail|required|alpha_num|min:8|max:8|unique:patients,phone_number",
            "username" => "bail|required|min:4|unique:patients,username",
            "password" => "bail|required|min:8"
        ];
    }

    public function messages()
    {
        return [
            "first_name.required" => "First name is required",
            "last_name.required" => "Last name is required",
            "first_name.alpha" => "Names can only contain alphabatical characters",
            "last_name.alpha" => "Names can only contain alphabatical characters",
            "username.required" => "Username is required",
            "username.min" => "Username most be at least 4 characters long",
            "username.unique" => "Username already exists",
            "password.required" => "Password is required ",
            "password.min" => "Password must be at least 8 characters",
            "phone_number.required" => "Phone number is required",
            "phone_number.min" => "Phone number is invalid",
            "phone_number.max" => "Phone number is invalid",
            "phone_number.unique" => "Phone number already exists",
            "phone_number.alpha_num" => "Phone number must be numbers only",
        ];
    }
}
