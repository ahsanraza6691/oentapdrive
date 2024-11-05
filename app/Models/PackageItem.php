<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'item',
        'qty',
        'price',
        'currency',
        'status',
    ];

    // Relationships
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
