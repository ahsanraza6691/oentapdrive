<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BackendModels\AttributeValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DefineProductVariant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function variants(){
        return $this->hasMany(AttributeValue::class,'variant_id','variant_id');
    }
}
