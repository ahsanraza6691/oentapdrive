<?php

namespace App\Http\Requests;

use App\Models\BackendModels\SubCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditSubCategory extends FormRequest
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
        $sub_id = $request->input('sub_id');
        $sub_category = SubCategory::find($sub_id);
        return [
            'id' => 'required,'.$sub_category->id,
            'parent_category_id'=>'required',
            'sub_category_name' => 'required|max:50|unique:sub_categories,sub_category_name,'.$sub_category->id,
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
