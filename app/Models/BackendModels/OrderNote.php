<?php

namespace App\Models\BackendModels;

use App\Models\BillingInfo;
use App\Models\ProductVariantion;
use App\Models\FrontendModels\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderNote extends Model
{
    use HasFactory;

    public function ordernotes(){
        return $this->hasMany(Order::class,'id','order_id');
    }

    public function purchased_items(){
        return $this->hasMany(BillingInfo::class, 'id','order_id');
    }
    public function variations(){
        return $this->hasOne(ProductVariantion::class,'id','product_id');
    }
    
}
