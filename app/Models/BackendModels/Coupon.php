<?php

namespace App\Models\BackendModels;

use App\Models\ProductVariantion;
use App\Models\BackendModels\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    public function coupons(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function attributes(){
        return $this->belongsTo(ProductVariantion::class,'id');
    }

    public function get_user_email(){
        return $this->belongsTo(User::class,'id');
    }

    public function cat(){
        return $this->hasMany(SubCategory::class,'id');
    }
    
}
