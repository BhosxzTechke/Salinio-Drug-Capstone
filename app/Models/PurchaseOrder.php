<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;

class PurchaseOrder extends Model
{
    use HasFactory;

        protected $fillable = [
            'po_number',
            'supplier_id',
            'expected_delivery_date',
            'status',
            'supplier_confirmation_token',
            'supplier_confirmed_at',
            'expiration_date'
        ];


    /////////////////// SUB CATEGORY RELATION /////////////////
    public function supplier() {

    return $this->belongsTo(Supplier::class, 'supplier_id', 'id');

    }


    public function items()
{
    return $this->hasMany(PurchaseOrderItem::class, 'purchase_order_id');
}

    

    


}
