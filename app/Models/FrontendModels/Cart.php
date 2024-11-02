<?php

namespace App\Models\FrontendModels;

use App\Models\ProductVariantion;
use App\Models\BackendModels\Product;
use App\Models\BackendModels\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    
    public function get_product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function attributes(){
        return $this->hasMany(Attribute::class,'product_id','product_id');
    }

    public function attrs(){
        return $this->hasMany(ProductVariantion::class,'product_id','product_id');
    }

    public function get_products_variants(){
        return $this->hasMany(ProductVariantion::class,'product_id','product_id');
    }


    public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }
    
    public function variations(){
        return $this->hasOne(ProductVariantion::class,'id','product_variantion_id');
    }
    
}
