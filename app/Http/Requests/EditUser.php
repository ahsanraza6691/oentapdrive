<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditUser extends FormRequest
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
        $user_id = $request->input('user_id');
        $user = User::find($user_id);
        return [
            'id' => 'required,'.$user->id,
            // 'password' => 'same:confirm_password',
            'confirm_password' => 'same:password',
            // 'password' =>
            //     'min:8',
            //     'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            'address' => 'required|max:100',
            'contact' => 'required|max:40',
            'email'=>'required|unique:users,email,'.$user->id,
            'last_name'=>'required|max:50',
            'first_name'=>'required|max:50',

        ];
    }
    public function messages()
    {
        return[
            // 'password.required' => 'Password Field is required',
            'address.required' => 'Address Field is required',
            'contact.required' => 'Contact Field is required',
            'email.required' => 'Email Field is required',
            'last_name.required'=> 'Last Name Field is required',
            'first_name.required'=> 'First Name Field is required',
        ];
    }
}
