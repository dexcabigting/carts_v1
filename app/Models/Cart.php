<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $with = ['cart_items', 'product'];

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'subtotal'
    ];

    public function cart_items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
