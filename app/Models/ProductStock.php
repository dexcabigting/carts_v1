<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        '2XS',
        'XS',
        'S',
        'M',
        'L',
        'XL',
        '2XL',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getSizesAttribute()
    {
        return $this->makeHidden(['id', 'product_id', 'created_at', 'updated_at']);
    }

    public function getQuantityAttribute()
    {
        return $this->{'2XS'} + $this->XS + $this->S + $this->M + $this->L + $this->XL + $this->{'2XL'};
    }
}
