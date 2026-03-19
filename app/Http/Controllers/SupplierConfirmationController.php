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

                return view('Supplier.confirm', compact('purchase'));
            }




public function store(Request $request, $token)
{
    $purchase = PurchaseOrder::with('items')->where('supplier_confirmation_token', $token)
        ->whereNull('supplier_confirmed_at')
        ->firstOrFail();

    if ($request->has('cancel_order')) {
        // Cancel the entire order
        $purchase->update([
            'status' => 'cancelled',
            'supplier_confirmed_at' => now(),
            'supplier_confirmation_token' => null,
        ]);

        return view('Supplier.cancel-success', ['purchase' => $purchase]);
    }

    foreach ($request->items as $itemData) {
        $item = PurchaseOrderItem::where('id', $itemData['purchase_order_item_id'])
            ->where('purchase_order_id', $purchase->id)
            ->first();

        if (!$item) continue;

        if (!empty($itemData['cancel'])) {
            $item->update([
                'status' => 'cancelled'
            ]);
            continue;
        }

        // Update expiration date if not cancelled
        $item->update([
            'expiration_date' => $itemData['expiration_date'] ?? null
        ]);
    }

    // Update purchase order status if all items are cancelled
    if ($purchase->items()->where('status', '!=', 'cancelled')->count() === 0) {
        $purchase->update([
            'status' => 'cancelled',
        ]);
    } else {
        $purchase->update([
            'expected_delivery_date' => $request->expected_delivery_date,
            'supplier_confirmed_at' => now(),
            'supplier_confirmation_token' => null,
            'status' => 'confirmed',
        ]);
    }

    return view('Supplier.confirm-success', ['purchase' => $purchase]);
}




}




