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
        'province_id',   // ✅ must be here
        'city_id',       // ✅ must be here
        'barangay_id',   // ✅ must be here
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





        ///// for shipping address fee dynamic

        public function province()
            {
                    return $this->belongsTo(Province::class);
            }

                public function city()
                {
                    return $this->belongsTo(City::class);
                }

                public function barangay()
                {
                    return $this->belongsTo(Barangay::class);
                }



}                                                                                                                                                       
