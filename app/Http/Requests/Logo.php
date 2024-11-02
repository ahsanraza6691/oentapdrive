<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Logo extends FormRequest
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
            'logo_image'=>'required|mimes:jpeg,jpg,png,gif,webp|max:3000',
            'type'=>'required|unique:logos,type|max:20',

        ];
    }
    public function messages()
    {
        return[
            'logo_image.required' => 'Logo Image  Field is required',
            'type.required'=> 'Type Field is required',
        ];
    }
}
