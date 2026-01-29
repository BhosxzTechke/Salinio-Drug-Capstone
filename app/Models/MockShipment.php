<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MockShipment extends Model
{
    use HasFactory;
    
    protected $table = 'mock_shipments';

    protected $fillable = [
        'order_id',
        'tracking_number',
        'delivery_status',
        'created_at',
        'updated_at'
    ];

    // Relationship: shipment belongs to an order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

}
