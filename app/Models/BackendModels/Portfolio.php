<?php

namespace App\Models\BackendModels;

use App\Models\BackendModel\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected  $fillable =[
        'type',
        'image',
        'image_thumbnail',
        'status',
        'video'
    ];
    protected $attributes = [
        'status' => 1
    ];

    public function get_service(){

        return $this->belongsTo(Service::class,'type');
    }
}
