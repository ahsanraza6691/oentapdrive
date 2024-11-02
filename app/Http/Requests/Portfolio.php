<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Portfolio extends FormRequest
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
            'type'  => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:3000',
            'image_thumbnail'=> 'required|mimes:jpeg,jpg,png,gif|max:3000',
        ];
    }

    public function message()
    {
        return[
            'type.required'=>'Type Field is required',
            'image.required' =>'Image is required',
            'image_thumbnail.required' =>'Image Thumbnail is required',
        ];
    }
}
