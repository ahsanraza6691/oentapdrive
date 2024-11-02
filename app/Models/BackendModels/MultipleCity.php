<?php

namespace App\Models\BackendModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipleCity extends Model
{
    use HasFactory;

    protected $fillable = ['city_id','city_name','shipping_id'];

    public function get_shipping_city(){
        return $this->belongsTo(Shipping::class,'shipping_id');
    }
    
    public function user_shipping(){
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }
        
}
