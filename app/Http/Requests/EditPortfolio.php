<?php

namespace App\Http\Requests;

use App\Models\BackendModels\Portfolio;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditPortfolio extends FormRequest
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
        $portfolio_id = $request->input('portfolio_id');
        $portfolio = Portfolio::find($portfolio_id);
        return [
            'id' => 'required,'. $portfolio->id,
            'type'  => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:3000',
            'image_thumbnail'=> 'mimes:jpeg,jpg,png,gif|max:3000',
        ];
    }

    public function message()
    {
        return[
            'type.required'=>'Type Field is required',
            'image.required' =>'Image is required',
            'image_thumbnail.required' =>'Image Thumbnail is required',
        ];
    }
}
