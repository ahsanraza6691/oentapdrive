<?php

namespace App\Http\Requests;

use App\Models\BackendModels\PrivacyPolicy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditPrivacyPolicy extends FormRequest
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
        $privacy_id = $request->input('privacy_id');
        $privacy = PrivacyPolicy::find($privacy_id);
        return [
            'id' =>'required,'.$privacy->id,
            'description'=>'required',
            'title'=>'required|max:50,'.$privacy->id,
        ];
    }

    public function messages()
    {
            return[
                'description.required' => 'Description field is required',
                'title.required' => 'Title field is required',
            ];
    }
}
