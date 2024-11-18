<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserConsumePackageItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_item_id',
        'qty',
    ];

    // Relationships
    public function packageItem()
    {
        return $this->belongsTo(PackageItem::class);
    }
}
