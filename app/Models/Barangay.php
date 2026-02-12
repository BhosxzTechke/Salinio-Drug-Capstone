<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;


        protected $fillable = [
        'city_id',
        'name',
        'extra_fee',
        'is_active',
    ];

    // Relationships
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    
}
