<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory;
use Illuminate\Notifications\Notifiable;

/**
 * @mixin IdeHelperSupplier
 */
class Supplier extends Model
{
    use HasFactory;
    use Notifiable;


    protected $guarded = [];
    
    

    
        public function inventories()
        {
            return $this->hasMany(Inventory::class);
        }

        public function items()
            {
                return $this->hasMany(PurchaseOrderItem::class);
            }

}
