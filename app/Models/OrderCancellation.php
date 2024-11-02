<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BillingInfo;


class OrderCancellation extends Model
{
    use HasFactory;

    // update work 26
    public function purchased_items(){
        return $this->belongsTo(BillingInfo::class, 'billing_info_id');
    }
}
