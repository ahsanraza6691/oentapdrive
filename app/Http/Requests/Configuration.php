<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Configuration extends FormRequest
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
            'short_description' => 'required|max:150',
            'map_link' => 'required|max:150',
            'address' => 'required|max:100',
            'email' => 'required|max:50',
            'contact'=>'required',
            'copy_right'=>'required|max:100',

        ];
    }
    public function messages()
    {
        return[
            'short_description.required' => 'Short Description Field is required',
            'map_link.required' => 'Map Link Field is required',
            'address.required' => 'Address Field is required',
            'email.required' => 'Email Field is required',
            'contact.required' => 'Contact Field is required',
            'copy_right.required'=> 'Copyright Field is required',
        ];
    }
}
