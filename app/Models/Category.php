<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'ctgr_name',
        'ctgr_description',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
