<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\Mileage;
use App\Models\User;
use App\Models\BackendModels\Brand;

class CarWithDriver extends Model
{
    use HasFactory;
    

  
   public function get_mileage(){
        return $this->hasMany(Mileage::class,'product_id');
    }
    public function get_user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function get_images(){
        return $this->hasMany(ProductImage::class,'product_id');
    }
    
    public function get_brand_name(){
        return $this->belongsTo(Brand::class,'brand_id');
    }
}
