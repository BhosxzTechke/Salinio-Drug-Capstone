<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Address extends Model
{
    use HasFactory;


    protected $fillable = [
        'customer_id',
        'full_name',
        'phone',
        'street',
        'barangay',
        'city',
        'is_default',
    ];



    // In Address.php
    protected $casts = [
        'is_default' => 'boolean',
    ];

    protected $table = 'addresses';



        public function customer()
        {
            return $this->belongsTo(Customer::class, 'customer_id');
        }
}                                                                                                                                                       
