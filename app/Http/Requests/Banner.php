<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Banner extends FormRequest
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
            'banner_image'=>'required|max:3000',
            'page_id'=>'required',

        ];
    }
    public function messages()
    {
        return[
            'banner_image.required' => 'Banner Image  Field is required',
            'page_id.required'=> 'Page Name  Field is required',
        ];
    }
}
