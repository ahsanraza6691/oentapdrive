<?php

namespace App\Models\FrontendModels;

use App\Models\ProductVariantion;
use App\Models\BackendModels\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;

    public function get_product_name(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function product_variations(){
        return $this->hasMany(ProductVariantion::class,'product_id','product_id');
    }

    public function get_ratings(){
        return $this->hasMany(Review::class,'product_id','product_id');
    }
}
