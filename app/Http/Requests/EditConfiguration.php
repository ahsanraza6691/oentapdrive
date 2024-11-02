<?php

namespace App\Http\Requests;

use App\Models\BackendModels\Configuration;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditConfiguration extends FormRequest
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
    public function rules(Request $request)
    {
        $configuration_id = $request->input('configuration_id');
        $configuration = Configuration::find($configuration_id);
        return [
            'id' => 'required'.$configuration->id,
            // 'shipping_fee' => 'required|max:100',
            'short_description' => 'required|max:150',
            'map_link' => 'required|max:100',
            'address' => 'required|max:100',
            'email' => 'required',
            'contact'=>'required',
            'copy_right'=>'required|max:100',

        ];
    }
    public function messages()
    {
        return[
            'short_description' => 'Short Description Field is required',
            // 'shipping_fee' => 'Shipping Field is required',
            'map_link' => 'Map Link Field is required',
            'address' => 'Address Field is required',
            'email.required' => 'Email Field is required',
            'contact.required' => 'Contact Field is required',
            'copy_right.required'=> 'Copyright Field is required',
        ];
    }
}
