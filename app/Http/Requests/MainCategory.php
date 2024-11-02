<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategory extends FormRequest
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
            'parent_category_id'=>'required',
            'model_name' => 'required|max:50|unique:main_categories,main_category_name',
        ];
    }

    public function messages()
    {
            return[
                'parent_category_id.required' => 'Parent Category Field is required',
                'model_name.required' => 'Main Category Field is required',
            ];
    }
}
