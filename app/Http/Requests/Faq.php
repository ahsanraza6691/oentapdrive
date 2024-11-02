<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Faq extends FormRequest
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
            'answer'=>'required',
            'questions'=>'required',
        ];
    }

    public function messages()
    {
            return[
                'answer.required' => 'Answer field is required',
                'questions.required' => 'Question field is required',
            ];
    }
}
