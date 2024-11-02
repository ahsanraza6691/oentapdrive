<?php

namespace App\Http\Requests;

use App\Models\BackendModels\Faq;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditFaq extends FormRequest
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
        $faq_id = $request->input('faq_id');
        $faq = Faq::find($faq_id);
        return [
            'id' => 'required,'.$faq->id,
            'answer'=>'required',
            'questions'=>'required|max:150,'.$faq->id,
        ];
    }

    public function messages()
    {
            return[
                'answer.required' => 'Answer field is required',
                'questions.required' => 'Question field is required',
            ];
    }
}
