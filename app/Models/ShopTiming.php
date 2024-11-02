<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class ShopTiming extends Model
{
    use HasFactory;
    protected $fillable = ['opening_time','closing_time','day_of_week','user_id'];


}
