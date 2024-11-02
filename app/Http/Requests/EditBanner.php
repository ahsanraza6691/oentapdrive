<?php

namespace App\Http\Requests;

use App\Models\BackendModels\Banner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditBanner extends FormRequest
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
        $banner_id = $request->input('banner_id');
        $banner = Banner::find($banner_id);
        return [
            //
            'id' =>'required,'.$banner->id,
            'banner_image'=>'max:3000',
            'page_id'=>'required',

        ];
    }
    public function messages()
    {
        return[
            'banner_image.required' => 'Banner Image  Field is required',
            'page_id.required'=> 'Page Name  Field is required',
        ];
    }
}
