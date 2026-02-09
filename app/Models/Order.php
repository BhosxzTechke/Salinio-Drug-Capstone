<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Orderdetails;
use App\Models\Address;
/**
 * @mixin IdeHelperOrder
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'shipping_address_id',
        'order_source',
        'order_date',
        'order_status',
        'total_products',
        'change_amount',
        'sub_total',
        'vat',
        'invoice_no',
        'total',
        'payment_status',
        'pay',
        'due',
        'created_by',
        'payment_method',
        'transaction_id',
        'discount',
        'created_at',
        'updated_at',
        'cancelled_at',
        'cancelled_by',
        'cancel_reason', 
        'cancelled_by_role',
        'vat_status',
        'shipped_at',
        'shipped_by',
        'completed_at', 
        'order_type',
        'reference_number',
        'delivery_status',
        'rider_id',
        'assigned_at',
        'delivered_at',
        'courier',
        'tracking_number',
        'paypal_order_id',
        'paypal_capture_id'
            

    ];

        protected $casts = [
        'completed_at' => 'datetime',
    ];



    /// FOR RETURN

        public function items()
    {
        return $this->hasMany(Orderdetails::class, 'order_id'); // adjust class & foreign key if needed
    }




                //// HAD RELATIONSHIP WITH ADDRESS TABLE
        public function shippingAddress()
        {
            return $this->belongsTo(Address::class, 'shipping_address_id');
        }



            // Relationship: order has many shipments
        public function shipments()
        {
            return $this->hasMany(MockShipment::class, 'order_id', 'id');
        }





            public function canBeReturned(): bool
            {
               /// so kapag completed di niya eexecute na return false pero kung pending or else rereturn false niya 
                if ($this->order_status !== 'completed') {
                    return false;
                }

                if (!$this->completed_at) {
                    return false;
                }

                return now()->lessThan($this->completed_at->addDays(7));
            }





    public function customer() {
    return $this->belongsTo(Customer::class, 'customer_id', 'id');
}


    public function product()
        {
            return $this->belongsTo(Product::class);
        }



    public function orderDetails()
        {
            return $this->hasMany(Orderdetails::class, 'order_id');
        }





    public function cancelledBy()
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }


    
    public function ShippedBy()
    {
        return $this->belongsTo(User::class, 'shipped_by');
    }


}