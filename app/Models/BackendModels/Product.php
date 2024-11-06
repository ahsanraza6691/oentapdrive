<?php

namespace App\Models\BackendModels;
use BinaryCats\Sku\HasSku;
use BinaryCats\Sku\Concerns\SkuOptions;
use App\Models\ProductAttribute;
use App\Models\ProductVariantion;
use App\Models\FrontendModels\Order;
use App\Models\FrontendModels\Review;
use App\Models\BackendModels\Shipping;
use App\Models\Mileage;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    // use HasSku;
    use HasFactory;

    public function skuOptions() : SkuOptions
    {
        return SkuOptions::make()
            ->from(['label', 'another_field'])
            ->target('sku')
            ->using('Lotti-')
            ->forceUnique(false)
            ->generateOnCreate(true)
            ->refreshOnUpdate(false);
    }


    public function get_parent_category(){
        return $this->belongsTo(ParentCategory::class,'parent_category_id');
    }
    public function get_main_category(){
        return $this->belongsTo(MainCategory::class,'main_category_id');
    }
    public function get_sub_category(){
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }
    public function get_brand_name(){
        return $this->belongsTo(Brand::class,'brand_id')->select(['id','brand_name','brand_image']);
    }
    public function order(){
        return $this->hasOne(Order::class,'product_id')->withDefault();
    }

    public function attributes(){
        return $this->hasMany(Attribute::class,'product_id')->orderBy('product_id','asc');
    }

    public function get_ratings(){
        return $this->hasMany(Review::class,'product_id');
    }


    public function product_variants(){
        return $this->hasMany(ProductAttribute::class,'product_id');
    }


    public function product_attributes(){
        return $this->hasMany(ProductAttribute::class,'product_id');
    }

    public function product_variations(){
        return $this->hasMany(ProductVariantion::class,'product_id');
    }


    // where not null variable product
    public function product_variable(){
        return $this->hasMany(ProductAttribute::class,'product_id')->where('used_for_variation', '!=', null);
    }


    public function product_variations_filter(){
        return $this->hasMany(ProductVariantion::class,'product_id');
    }


    public function product_shipping(){
        return $this->belongsTo(Shipping::class,'shipping');
    }

    public function get_mileage(){
        return $this->hasMany(Mileage::class,'product_id');
    }
    public function get_user(){
        return $this->belongsTo(User::class,'user_id')->select('id','name','slug','company_name','contact','city','company_logo');
    }
    
     public function get_vendor(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function get_images(){
        return $this->hasMany(ProductImage::class,'product_id');
    }

    public function wishlist_product(){
        return $this->belongsTo(Wishlist::class, 'id','product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Adjust the foreign key if necessary
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


}
