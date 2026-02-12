<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    
        protected $fillable = [
        'province_id',
        'name',
        'shipping_fee',
        'delivery_days',
        'is_active',
    ];

    // Relationships
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function barangays()
    {
        return $this->hasMany(Barangay::class);
    }
}
