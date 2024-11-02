<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Social extends FormRequest
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
            'linkedin' => 'required|max:100',
            'instagram' => 'required|max:100',
            'twitter'=>'required|max:100',
            'facebook'=>'required|max:100',

        ];
    }
    public function messages()
    {
        return[
            'linkedin.required' => 'Linkedin Field is required',
            'instagram.required' => 'Instgarm Field is required',
            'twitter.required' => 'Twitter Field is required',
            'facebook.required'=> 'Facebook Field is required',
        ];
    }
}
