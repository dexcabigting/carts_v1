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
        return $this->makeHidden(['id', 'product_id', 'created_at', 'updated_at']);
    }

    public function getQuantityAttribute()
    {
        return $this->{'2XS'} + $this->XS + $this->S + $this->M + $this->L + $this->XL + $this->{'2XL'};
    }

    public function getXxsmallAttribute()
    {
        if($this->{'2XS'} == 0) {
            return "";
        }

        return $this->{'2XS'};
    }

    public function getXsmallAttribute()
    {
        if($this->XS == 0) {
            return "";
        }

        return $this->XS;
    }

    public function getSmallAttribute()
    {
        if($this->S == 0) {
            return "";
        }

        return $this->S;
    }

    public function getMediumAttribute()
    {
        if($this->M == 0) {
            return "";
        }

        return $this->M;
    }

    public function getLargeAttribute()
    {
        if($this->L == 0) {
            return "";
        }

        return $this->L;
    }

    public function getXlargeAttribute()
    {
        if($this->XL == 0) {
            return "";
        }

        return $this->XL;
    }

    public function getXxlargeAttribute()
    {
        if($this->{'2XL'} == 0) {
            return "";
        }

        return $this->{'2XL'};
    }
}
