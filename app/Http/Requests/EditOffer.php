<?php

namespace App\Http\Requests;

use App\Models\BackendModels\Offer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditOffer extends FormRequest
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
        $offer_id = $request->input('offer_id');
        $offer = Offer::find($offer_id);
        return [
            //
            'id' =>'required,'.$offer->id,
            'imag1'=>'mimes:jpeg,jpg,png,gif,webp|max:3000',
            'image2'=>'mimes:jpeg,jpg,png,gif,webp|max:3000',

        ];
    }
    public function messages()
    {
        return[
            'image1.required' => 'Background Image  Field is required',
            'image2.required'=> 'Image  Field is required',
        ];
    }
}
