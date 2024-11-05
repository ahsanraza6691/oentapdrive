<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrderHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_items_id',
        'company_account_no',
        'receipt',
        'status',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function packageItem()
    {
        return $this->belongsTo(PackageItem::class, 'package_items_id');
    }

    public function package()
    {
        return $this->packageItem()->with('package');
    }
}
