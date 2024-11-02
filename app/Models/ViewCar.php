<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BackendModels\Product;
use App\Models\Mileage;
use App\Models\User;
use App\Models\ProductImage;
use App\Models\BackendModels\Brand;



class ViewCar extends Model
{
    use HasFactory;

    public function get_comapny(){
        return $this->belongsTo(User::class,'company_id');
    }
    public function get_mileage(){
        return $this->hasMany(Mileage::class,'product_id');
    }
    public function get_images(){
        return $this->hasMany(ProductImage::class,'product_id');
    }
    public function get_product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function get_brand_name(){
        return $this->belongsTo(Brand::class,'brand_id');
    }
}
