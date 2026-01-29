<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use Illuminate\Http\Request;

class SupplierConfirmationController extends Controller
{
    //

        // public function show($token)
        // {
        //     $purchase = PurchaseOrder::where('supplier_confirmation_token', $token)
        //         ->whereNull('supplier_confirmed_at')
        //         ->firstOrFail();

        //     return view('supplier.confirm', compact('purchase'));

            
        // }

        public function show($token)
            {
                $purchase = PurchaseOrder::with(['items.product', 'supplier'])
                    ->where('supplier_confirmation_token', $token)
                    ->whereNull('supplier_confirmed_at')
                    ->firstOrFail();

                return view('supplier.confirm', compact('purchase'));
            }




            public function store(Request $request, $token)
            {
                $purchase = PurchaseOrder::where('supplier_confirmation_token', $token)
                    ->whereNull('supplier_confirmed_at')
                    ->firstOrFail();

                foreach ($request->items as $item) {
                    PurchaseOrderItem::where('id', $item['purchase_order_item_id'])
                        ->where('purchase_order_id', $purchase->id)
                        ->update([
                            'expiration_date' => $item['expiration_date'] ?? null
                        ]);
                }


                // Update purchase order (NO expiration_date here anymore)
                $purchase->update([
                    'expected_delivery_date' => $request->expected_delivery_date,
                    'supplier_confirmed_at' => now(),
                    'supplier_confirmation_token' => null,
                    'status' => 'confirmed',
                ]);

                return view('supplier.confirm-success');
            }





}




