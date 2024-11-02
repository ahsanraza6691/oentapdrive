<?php

namespace App\Http\Requests;

use App\Models\BackendModels\Package;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditPackage extends FormRequest
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
        $package_id = $request->input('package_id');
        $package = Package::find($package_id);
        return [
            'id' => 'required,'.$package->id,
            'description' => 'required',
            'price'=>'required',
            'title'=>'required|max:50,'.$package->id,

        ];
    }
    public function messages()
    {
        return[
            'description.required' => 'Description Field is required',
            'price.required' => 'Price Field is required',
            'title.required'=> 'Title Field is required',
        ];
    }
}
