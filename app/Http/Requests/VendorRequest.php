<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'name' => 'required|max:100',
            'company_name' => 'required|max:40',
            'email'=>'required|unique:users,email|max:50',
            'fleet_size'=>'required|max:50',
            'contact'=>'required|max:50',
            'country'=>'required|max:50',
            'city'=>'required|max:50',

        ];
    }
    public function messages()
    {
        return[
            'password.required' => 'Password Field is required',
            'address.required' => 'Address Field is required',
            'contact.required' => 'Contact Field is required',
            'email.required' => 'Email Field is required',
            'last_name.required'=> 'Last Name Field is required',
            'first_name.required'=> 'First Name Field is required',
        ];
    }
}
