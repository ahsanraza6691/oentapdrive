<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingMethod extends FormRequest
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
            'shipping_title'=>'required|unique:shipping_methods,shipping_title|max:50',
        ];
    }

    public function messages()
    {
            return[
                'shipping_title.required' => 'Shipping Title field is required',
            ];
    }
}
