<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductAdditionalAttribute;
use App\Models\BackendModels\AttributeValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product_attributes(){
        return $this->hasMany(ProductAdditionalAttribute::class,'product_attribute_id','id');
    }


    public function child_attributes(){
        return $this->hasMany(AttributeValue::class,'variant_id','variant_id');
    }
    
    public function product_additional_attributes(){
        return $this->hasMany(ProductAdditionalAttribute::class,'product_attribute_id','id');
    }
    
    
     
}
