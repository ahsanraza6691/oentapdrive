<?php

namespace App\Http\Requests;

use App\Models\BackendModels\PageContent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditPageContent extends FormRequest
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
        $page_content_id = $request->input('page_content_id');
        $page_content = PageContent::find($page_content_id);
        return [
            'id' => 'required,'.$page_content->id,
            'description' => 'required',
            'image'=>'mimes:jpeg,jpg,png,gif|max:3000',
            'title'=>'required|max:100|unique:page_contents,title,'.$page_content->id,
            'section_name' => 'required|max:50',
            'page_id' => 'required',

        ];
    }
    public function messages()
    {
        return[
            'description.required' => 'Description Field is required',
            'image.required'=> 'Image  Field is required',
            'title.required'=> 'Title Field is required',
            'section_name.required' => 'Section Name Field is required',
            'page_id.required'=> 'Page Name Field is required',
        ];
    }
}
