<?php

namespace App\Models\BackendModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_category_name'
    ];
    protected $attributes = [
        'status' => 1
    ];
    public function get_main_cat(){
        return $this->hasMany(MainCategory::class);
    }
    public function get_sub_cat(){
        return $this->hasMany(SubCategory::class);
    }
}
