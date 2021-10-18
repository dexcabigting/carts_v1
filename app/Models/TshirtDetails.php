<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TshirtDetails extends Model
{
    use HasFactory;

    protected $table = 'tshirt_details';

    protected $fillable = [
        'tshirt_id',
        'customer_name',
        'tshirt_front',
        'tshirt_back',
        'tshirt_measurements',
        'tshirt_fabric',
        'tshirt_type',
        'tshirt_color',
        'tshirt_pdf',
        'created_date',
        'updated_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $casts = [
        'customer_name' => 'string',
        'tshirt_front' => 'string',
        'tshirt_back' => 'string',
        'tshirt_measurements' => 'string',
        'tshirt_fabric' => 'string',
        'tshirt_type' => 'string',
        'tshirt_type' => 'string',
        'tshirt_pdf' => 'string',
        'created_date' => 'date',
        'updated_date' => 'date',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
}
