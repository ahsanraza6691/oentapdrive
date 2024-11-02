<?php

namespace App\Models\BackendModels;

use App\Models\Frontend\City;
use Illuminate\Database\Eloquent\Model;
use App\Models\BackendModels\ShippingMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipping extends Model
{
    use HasFactory;

    public function get_city(){
        return $this->belongsTo(City::class,'city_id');
    }
    public function get_method(){
        return $this->belongsTo(ShippingMethod::class,'shipping_method_id');
    }

    public function cities(){
        return $this->hasMany(MultipleCity::class,'shipping_id');
    }
    
    public function shipping_city(){
        return $this->hasOne(MultipleCity::class,'shipping_id','id');
    }
}
