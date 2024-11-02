<?php

namespace App\Models\BackendModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $fillable = [
        'copy_right',
        'contact',
        'email',
        'address',
        'map_link',
        'shipping_fee',
        'status',
        'short_description',
    ];

}
