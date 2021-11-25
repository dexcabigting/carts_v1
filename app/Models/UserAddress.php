<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'region',
        'province',
        'city',
        'barangay',
        'home_address',
        'is_main_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'region' => 'No address yet',
            'province' => 'No address yet',
            'city' => 'No address yet',
            'barangay' => 'No address yet',
            'home_address' => 'No address yet',
            'is_main_address' => 'No address yet',
        ]);
    }
}
