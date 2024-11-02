<?php

namespace App\Http\Requests;

use App\Models\BackendModels\Logo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditLogo extends FormRequest
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
        $logo_id = $request->input('logo_id');
        $logo = Logo::find($logo_id);
        return [
            'id' => 'required,'.$logo->id,
            'logo_image'=>'mimes:jpeg,jpg,png,gif,webp|max:3000',
            'type'=>'required|max:20',

        ];
    }
    public function messages()
    {
        return[
            'logo_image.required' => 'Logo Image  Field is required',
            'type.required'=> 'Type Field is required',
        ];
    }
}
