<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Wishlist;
use App\Models\ShopTiming;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class,'user_id');
    }

    public function shop_timings(){
        return $this->hasMany(ShopTiming::class,'user_id');
    }

    // User.php

    // public function leads()
    // {
    //     return $this->hasMany(Lead::class, 'vendor_id');
    // }
    public function leads()
    {
        return $this->hasMany(Lead::class, 'vendor_id');
    }

    public function carBookings()
    {
        return $this->hasMany(CarBooking::class, 'vendor_id');
    }

    public function userLeads()
    {
        return $this->hasMany(Lead::class, 'user_id')->whereNotNull('user_id');
    }
    

    public function userCarBookings()
    {
        return $this->hasMany(CarBooking::class, 'user_id')->whereNotNull('user_id');
    }
    
}
