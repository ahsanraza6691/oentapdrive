<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Gallery extends FormRequest
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
            'image_name' => 'required|mimes:jpeg,jpg,png,gif|max:3000',
            'image_title'=>'required|unique:galleries,image_title|max:100',
        ];
    }

    public function messages()
    {
            return[
                'image_name.required' => 'Image Field is required',
                'image_title.required' => 'Title Field is required',
            ];
    }
}
