<?php

namespace App\Models;
use BinaryCats\Sku\HasSku;
use BinaryCats\Sku\Concerns\SkuOptions;
use App\Models\BackendModels\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariantion extends Model
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

    protected $guarded = [];

    public function products(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
