<?php

namespace App\Models\BackendModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    public function get_parent_category(){
        return $this->belongsTo(ParentCategory::class,'parent_category_id');
    }
    public function get_main_category(){
        return $this->belongsTo(MainCategory::class,'main_category_id');
    }

    public function products(){
        return $this->belongsTo(Product::class, 'id','brand_id')->where('status',1)->withDefault();
    }

    // public function brands_products(){
    //     return $this->belongsTo(Product::class, 'id','brand_id')->where('status',1)->withDefault();
    // }

    // public function categories_products(){
    //     return $this->belongsTo(Product::class, 'id','brand_id')->where('status',1)->withDefault();
    // }
}
