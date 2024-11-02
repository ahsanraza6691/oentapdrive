<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBooking extends Model
{
    use HasFactory;
    
    public function get_product(){
        return $this->belongsTo(CarWithDriver::class,'car_id');
    }
    
    public function car_product(){
        return $this->belongsTo(CarWithDriver::class,'car_id');
    }
}
