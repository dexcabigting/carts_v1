<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'xxsmall',
        'xsmall',
        'small',
        'medium',
        'large',
        'xlarge',
        'xxlarge',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getSizesAttribute()
    {
        return $this->makeHidden(['id', 'product_id', 'created_at', 'updated_at']);
    }
}
