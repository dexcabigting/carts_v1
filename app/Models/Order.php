<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['order_variants'];

    protected $fillable = [
        'user_id',
        'user_address_id',
        'invoice_number',
        'payment_method',
        'payment_proof',
        'transaction_fee',
        'discount',
        'status',
        'date_of_arrival'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_address()
    {
        return $this->belongsTo(UserAddress::class);
    }

    public function order_variants()
    {
        return $this->hasMany(OrderVariant::class);
    }

    public function order_items()
    {
        return $this->hasManyThrough(OrderItem::class, OrderVariant::class);
    }
}
