<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoice_number',
        'transaction_fee',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_variants()
    {
        return $this->hasMany(OrderVariant::class);
    }

    public function order_items()
    {
        return $this->hasManyThrough(OrderVariant::class, OrderItem::class);
    }
}
