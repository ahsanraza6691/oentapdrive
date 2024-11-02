<?php

namespace App\Http\Requests;

use App\Models\BackendModels\Social;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditSocial extends FormRequest
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
        $social_id = $request->input('social_id');
        $social = Social::find($social_id);
        return [
            'id' => 'required,'.$social->id,
            'instagram' => 'required|max:100',
            'twitter'=>'required|max:100',
            'facebook'=>'required|max:100',

        ];
    }
    public function messages()
    {
        return[
            'instagram.required' => 'Instgarm Field is required',
            'twitter.required' => 'Twitter Field is required',
            'facebook.required'=> 'Facebook Field is required',
        ];
    }
}
