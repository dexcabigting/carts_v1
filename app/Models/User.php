<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable 
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'otp',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function userCarts($ids)
    {
        return $this->hasMany(Cart::class)->whereIn('id', $ids);
        // if(is_array($ids)) {
            
        // } else {
        //     return $this->hasMany(Cart::class)->where('id', $ids);
        // }
    }

    public function cartItems()
    {
        return $this->hasManyThrough(CartItem::class, Cart::class);
    }

    public function userCartItems($ids)
    {
        return $this->hasManyThrough(CartItem::class, Cart::class)->whereIn('cart_id', $ids)->pluck('size');
    }

    public function likes()
    {
        return $this->hasMany(ProductLike::class);
    }
}
