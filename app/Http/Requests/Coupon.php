<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Coupon extends FormRequest
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
            'description'=>'required',
            'coupon_amount' => 'required',
            'discount_type'=>'required',
            'coupon_code'=>'required|unique:coupons,coupon_code,max:50',

        ];
    }
    public function messages()
    {
        return[

            'description.required' => 'Coupon Description Field is required',
            'coupon_amount' => 'Coupon Amount Name Field id required',
            'discount_type.required' => 'Discount Type Field is required',
            'coupon_code.required'=> 'Coupon Code Name Field is required',
        ];
    }
}
