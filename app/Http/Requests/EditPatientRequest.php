<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPatientRequest extends FormRequest
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
            "password" => "required|string|min:8"
        ];
    }

    public function messages()
    {
        return [
            "password.required" => "Password is required",
            "password.min" => "Password should be at least 8 characters"
        ];
    }
}
