<?php

namespace App\Http\Requests;

use App\Models\BackendModels\Location;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditLocation extends FormRequest
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
        $location_id = $request->input('location_id');
        $location = Location::find($location_id);
            return [
                'id' => 'required,'.$location->id,
                'image'=>'mimes:jpeg,jpg,png,gif|max:3000',
                'map_link' => 'required|max:100',
                'location_name' => 'required|max:50|unique:locations,location_name,'.$location->id,

            ];

    }
    public function messages()
    {
        // $user_id = $this->request->get('location_id');
        // $user = Location::find($user_id);

        return[
            'image.required'=> 'Image Field is required',
            'map_link.required' => 'Map Link Field is required',
            'location_name.required'=> 'Location Name Field is required',
        ];
    }
}
