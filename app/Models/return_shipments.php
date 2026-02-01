<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class return_shipments extends Model
{
    use HasFactory;

        protected $fillable = [
        'return_request_id',
        'tracking_number',
        'shipment_status',
        'shipped_at',
        'delivered_at',
    ];

    
        protected $table = 'return_shipments'; // only needed if your table name doesn't follow conventions



    public function returnRequest()
    {
        return $this->belongsTo(ReturnRequest::class);
    }


}
