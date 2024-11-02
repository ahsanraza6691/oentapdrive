<?php

namespace App\Models\FrontendModels;

use App\Models\BackendModels\MultipleCity;
use App\Models\User;
use App\Models\Frontend\City;
use App\Models\Frontend\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PhpParser\Parser\Multiple;

class UserAddress extends Model
{
    use HasFactory;

    public function get_city(){
        return $this->belongsTo(City::class,'city');
    }
    public function get_state(){
        return $this->belongsTo(State::class,'state');
    }
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    public function user_shipping_city(){
        return $this->hasOne(MultipleCity::class, 'id', 'city');
    }
}
