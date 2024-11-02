<?php

namespace App\Http\Requests;

use App\Models\BackendModels\MainCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditMainCategory extends FormRequest
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
        $main_id = $request->input('main_id');
        $main = MainCategory::find($main_id);
        return [
            'id' => 'required,'.$main->id,
            'parent_category_id'=>'required',
            'model_name' => 'required|max:50|unique:main_categories,main_category_name,'.$main->id,
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
