<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageContent extends FormRequest
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
            'description' => 'required',
            'image'=>'required|mimes:jpeg,jpg,png,gif|max:3000',
            'title'=>'required|unique:page_contents,title,max:50',
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
