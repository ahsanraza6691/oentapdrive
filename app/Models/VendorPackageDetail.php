<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorPackageDetail extends Model
{
    use HasFactory;

    protected $table = 'vendor_package_details'; // Specify the table name if it's not the default plural

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'user_id',
        'package_id'
    ];

    // Define any relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(PackageItem::class);
    }
}
