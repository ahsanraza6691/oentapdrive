<?php

namespace App\Http\Requests;

use App\Models\BackendModels\ParentCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditParentCategory extends FormRequest
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
        $parent_id = $request->input('parent_id');
        $parent = ParentCategory::find($parent_id);
        return [
            'id' => 'required,'.$parent->id,
            'parent_category_name'=>'required|max:50|unique:parent_categories,parent_category_name,'.$parent->id,
        ];
    }

    public function messages()
    {
            return[
                'parent_category_name.required' => 'Parent Category Field is required',
            ];
    }
}
