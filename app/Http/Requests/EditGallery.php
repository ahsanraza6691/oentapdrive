<?php

namespace App\Http\Requests;

use App\Models\BackendModels\Gallery;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditGallery extends FormRequest
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
        $gallery_id = $request->input('gallery_id');
        $gallery = Gallery::find($gallery_id);
        return [
            'id' => 'required,'.$gallery->id,
            'image_name' => 'mimes:jpeg,jpg,png,gif|max:3000',
            'image_title'=>'required|max:100',
        ];
    }

    public function messages()
    {
            return[
                'image_name.required' => 'Image Field is required',
                'image_title.required' => 'Title Field is required',
            ];
    }
}
