<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnRequest extends Model
{
    use HasFactory;

        protected $fillable = [
        'order_id',
        'reason',
        'description',
        'quantity',
        'status',
        'photos',
    ];

    protected $casts = [
        'photos' => 'array',
    ];


        protected $table = 'return_requests'; // only needed if your table name doesn't follow conventions



public function shipment()
{
    return $this->hasOne(return_shipments::class, 'return_request_id', 'id');


    }


    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
        // belongsTo(TargetModel, foreign_key_on_this_table, owner_key_on_other_table)
    }

}
