<?php

namespace App\Models\BackendModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    // public function get_attr(){
    //     return $this->belongsTo(Variant::class,'variants_id');
    // }
    public function attribute_values(){
        return $this->hasMany(AttributeValue::class,'id');
    }

    
}
