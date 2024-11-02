<?php

namespace App\Models\BackendModels;

use App\Models\BackendModels\Variant;
use Illuminate\Database\Eloquent\Model;
use App\Models\BackendModels\AttributeValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends Model
{
    use HasFactory;

    // protected $fillable = ['product_id','attribute','attribute_value','stock'];

    public function get_ids(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function get_attr(){
        return $this->belongsTo(AttributeValue::class,'id');
    }
    
    public function variants(){
        return $this->hasMany(AttributeValue::class,'variant_id','variant_id');
    }
    
    

    // public function get_attr(){
    //     return $this->hasMany(AttributeValue::class,'variants_id');
    // }

}
