<?php

namespace App\Models\BackendModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BackendModels\Brand;

class MainCategory extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function get_parent_category(){
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function sub_category(){
        return $this->hasOne(SubCategory::class,'main_category_id');
    }

    public function get_sub_cat(){
        return $this->hasMany(SubCategory::class);
    }

    public function sub_categories(){
        return $this->hasMany(SubCategory::class, 'id');
    }

    public function get_sub_cat_nav(){
        return $this->hasMany(SubCategory::class,'main_category_id');
    }

}
