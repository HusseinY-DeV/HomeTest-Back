<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class AddPostRequest extends FormRequest
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
            "title" => "bail|required",
            "description" => "bail|required|min:5",
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "A title is required for the blog",
            "description.required" => "A description is required for the blog",
            "description.min" => "A description should be at least of 5 characters",
        ];
    }
}
