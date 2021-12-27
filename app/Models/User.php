<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class User extends Authenticatable 
{
    use HasFactory, Notifiable, SoftDeletes, CascadeSoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';

    protected $cascadeDeletes = ['userAddresses', 'carts', 'likes', 'orders'];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'otp',
        'password',
        'role_id',
        'email_verified_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
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

    public function userAddresses()
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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function product_variant_comments()
    {
        return $this->hasMany(ProductVariantComment::class);
    }
}
