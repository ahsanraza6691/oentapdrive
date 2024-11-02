<?php

namespace App\Http\Requests;

use App\Models\BackendModels\TermsCondition;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditTermsConditions extends FormRequest
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
        $terms_id = $request->input('terms_id');
        $terms = TermsCondition::find($terms_id);
        return [
            'id' =>'required,'.$terms->id,
            'description'=>'required',
            'title'=>'required|max:50,'.$terms->id,
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
