<?php

namespace App\Http\Requests\Tests;

use Illuminate\Foundation\Http\FormRequest;

class EditTestRequest extends FormRequest
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
            "name" => "bail|required|string|min:2",
            "price" => "bail|required|integer",
            "quantity" => "bail|required|integer"
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "The test name is required",
            "name.min" => "The test should be a minimum of 2 characters",
            "price.required" => "The price is required",
            "price.integer" => "The price should be numbers only",
            "quantity.required" => "The quantity is required",
            "quantity.integer" => "The quantity should be numbers only",
        ];
    }
}
