<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Package extends FormRequest
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
            'price'=>'required',
            'title'=>'required|max:50',

        ];
    }
    public function messages()
    {
        return[
            'description.required' => 'Description Field is required',
            'price.required' => 'Price Field is required',
            'title.required'=> 'Title Field is required',
        ];
    }
}
