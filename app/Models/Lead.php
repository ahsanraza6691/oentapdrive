<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BackendModels\Product;
class Lead extends Model
{
    use HasFactory;


    public function get_user(){
        return $this->belongsTo(User::class,'user_id')->select(['id','name','email','phone_number','whatsapp_number']);
    }

    public function get_car(){
        return $this->belongsTo(Product::class,'product_id')->select('id','brand_id','model_name','make_year','slug');
    }
    public function get_vendor(){
        return $this->belongsTo(User::class,'user_id')->select(['id','name','email','company_name']);
    }

}
