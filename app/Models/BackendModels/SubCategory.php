<?php

namespace App\Models\BackendModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public function get_parent_category(){
        return $this->belongsTo(ParentCategory::class,'parent_category_id');
    }
    public function get_main_category(){
        return $this->belongsTo(MainCategory::class,'main_category_id');
    }
    
    public function products(){
        return $this->belongsTo(Product::class, 'id','sub_category_id')->where('status',1);
    }
    
    public function filter_products(){
        return $this->belongsTo(Product::class, 'id','sub_category_id')->where('status',1);
    }
    public function get_sub_cat(){
        return $this->hasMany(SubCategory::class);
    }
}
