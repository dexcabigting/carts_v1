<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_variant_id',
        '2XS',
        'XS',
        'S',
        'M',
        'L',
        'XL',
        '2XL',
    ];

    public function product_variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function getSizesAttribute()
    {
        return $this->makeHidden(['id', 'product_variant_id', 'created_at', 'updated_at']);
    }

    public function getQuantityAttribute()
    {
        return $this->{'2XS'} + $this->XS + $this->S + $this->M + $this->L + $this->XL + $this->{'2XL'};
    }
}
