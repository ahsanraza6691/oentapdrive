<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeValue extends FormRequest
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
            'attribute_value'=>'required|unique:attribute_values,attribute_value|max:50',
        ];
    }

    public function messages()
    {
            return[
                'attribute_value.required' => 'Attribute Value field is required',
            ];
    }
}
