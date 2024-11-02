<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class Location extends FormRequest
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
                'image'=>'required|mimes:jpeg,jpg,png,gif|max:3000',
                'map_link' => 'required|max:100',
                'location_name' => 'required|max:50|unique:locations,location_name',

            ];

    }
    public function messages()
    {
        return[
            'image.required'=> 'Image Field is required',
            'map_link.required' => 'Map Link Field is required',
            'location_name.required'=> 'Location Name Field is required',
        ];
    }

}
