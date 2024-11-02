<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategory extends FormRequest
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
            'sub_category_name' => 'required|max:50|unique:sub_categories,sub_category_name',
            'main_category_id'=>'required',
        ];
    }

    public function messages()
    {
            return[
                'parent_category_id.required' => 'Parent Category Field is required',
                'sub_category_name.required' => 'Sub Category Field is required',
                'main_category_id.required' => 'Main Category Field is required',
            ];
    }
}
