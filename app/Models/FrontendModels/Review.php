<?php

namespace App\Models\FrontendModels;

use App\Models\BackendModels\Product;
use App\Models\ProductVariantion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\BillingInfo;
use App\Models\ProductAttribute;


class Review extends Model
{
    use HasFactory;

    public function get_user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function get_product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    // public function purchased_items(){
    //     return $this->hasMany(BillingInfo::class, 'order_id');
    // }

    // public function product_variants(){
    //     return $this->hasMany(ProductAttribute::class,'product_id');
    // }

    // public function variations(){
    //     return $this->hasOne(ProductVariantion::class,'id','product_id');
    // }


    public function purchased_items(){
        return $this->belongsTo(ProductVariantion::class, 'product_variantion_id');
    }

    public function product_variants(){
        return $this->hasMany(ProductAttribute::class,'product_id');
    }
   
    public function variations(){
        return $this->belongsTo(ProductVariantion::class,'product_variation_id');
    }

    public function reviews_items(){
        return $this->belongsTo(BillingInfo::class,'order_id','order_id');
    }


    

}
