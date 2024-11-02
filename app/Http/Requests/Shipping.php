<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Shipping extends FormRequest
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
            'city'=>'required|max:50',
            'zone_name'=>'required|unique:shippings,zone_name|max:50',
        ];
    }

    public function messages()
    {
            return[
                'city.required' => 'City field is required',
                'zone_name.required' => 'Zone Name field is required',
            ];
    }
}
