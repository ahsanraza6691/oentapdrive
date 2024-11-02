<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Blog extends FormRequest
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
            //
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:3000',
            'date'=>'required',
            'title'=>'required|unique:blogs,title|max:100',
        ];
    }

    public function messages()
    {
            return[
                'description.required' => 'Description Field is required',
                'image.required' => 'Image Field is required',
                'date.required' => 'Date Field is required',
                'title.required' => 'Title Field is required',
            ];
    }
}
