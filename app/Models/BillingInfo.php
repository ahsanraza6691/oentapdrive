<?php

namespace App\Models;

use App\Models\Frontend\City;
use App\Models\Frontend\State;
use App\Models\ProductVariantion;
use App\Models\BackendModels\Product;
use Illuminate\Database\Eloquent\Model;
use App\Models\BackendModels\Cancellation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BillingInfo extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function variations()
    {
        return $this->hasOne(ProductVariantion::class, 'id', 'product_variantion_id');
    }

    public function get_reason()
    {
        return $this->belongsTo(Cancellation::class, 'cancellation_reason');
    }

    public function get_city(){
        return $this->belongsTo(City::class,'city');
    }
    public function get_state(){
        return $this->belongsTo(State::class,'state');
    }
}
