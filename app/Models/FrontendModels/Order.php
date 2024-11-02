<?php

namespace App\Models\FrontendModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BackendModels\Product;
use App\Models\BillingInfo;
use App\Models\FrontendModels\UserAddress;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    public function products(){
        return $this->hasMany(Product::class, 'id','product_id');
    }
    public function billing_address(){
        return $this->hasOne(UserAddress::class, 'id','billing_address_id');
    }
    public function shipping_address(){
        return $this->hasOne(UserAddress::class, 'id','shipping_address_id');
    }
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function carts(){
        return $this->hasMany(Cart::class, 'order_id');
    }

    public function purchased_items(){
        return $this->hasMany(BillingInfo::class, 'order_id');
    }

    public function purchased_items_billing(){
        return $this->hasMany(BillingInfo::class, 'order_id')->where('order_status','=',null);
    }

    public function variations(){
        return $this->hasOne(ProductVariantion::class,'id','product_id');
    }
    // public function full_name($id){
    //     $user = User::find($id);
    //     return ucfirst($user->name);
    // }


    public function reviews_items(){
        return $this->hasMany(Review::class,'order_id');
    }

}
