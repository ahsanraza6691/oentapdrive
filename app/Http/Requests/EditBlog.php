<?php

namespace App\Http\Requests;

use App\Models\BackendModels\Blog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditBlog extends FormRequest
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
        $blog_id = $request->input('blog_id');
        $blog = Blog::find($blog_id);
        return [
            'id' => 'required,'.$blog->id,
            'description' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:3000',
            'date'=>'required',
            'title'=>'required|max:100',
        ];
    }

    public function messages()
    {
            return[
                'description.required' => 'Description Field is required',
                'image.required' => 'Image Field is required',
                'date.required' => 'Date Field is required',
                'title.required' => 'Title Field is required',
            ];
    }
}
