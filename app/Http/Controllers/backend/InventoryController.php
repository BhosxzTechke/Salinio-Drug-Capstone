<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{




    /// FOR AI API DATA KNOWLEDGE ABOUT INVENTORY ITEM
    public function index()
    {
        // Load inventory items with related product info
        $inventory = Inventory::with('product')->get();

        // Transform or filter data if needed
        $data = $inventory->map(function ($item) {
            return [
                'id' => $item->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product ? $item->product->product_name : null,
                'batch_number' => $item->batch_number,
                'expiry_date' => $item->expiry_date,
                'received_date' => $item->received_date,
                'quantity' => $item->quantity,
                'status' => $item->status,
                'cost_price' => $item->cost_price,
                'selling_price' => $item->selling_price,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });


        return response()->json($data);
    }




    //
public function Inventory(Request $request)
{

    $today = now()->toDateString();
    $status = $request->get('status', 'active'); // default to active

    $query = Inventory::with('product');

    // 🔍 Filter by status
    if ($status == 'expired') {
        $query->where('expiry_date', '<=', $today);
    } elseif ($status == 'out_of_stock') {
        $query->where('quantity', '<=', 0);
    } elseif ($status == 'active') {
        $query->where('quantity', '>', 0)
                ->where(function ($q) use ($today) {
                    $q->whereNull('expiry_date')
                        ->orWhere('expiry_date', '>', $today);
                });
    }

    // Filter by product name
    if ($request->filled('product')) {
        $query->whereHas('product', function ($q) use ($request) {
            $q->where('product_name', 'like', '%'.$request->product.'%');
        });
    }


    $inventory = $query->orderBy('created_at', 'desc')->get();

    return view('Inventory.stocks', compact('inventory'));
}   


    public function updateStatus()
        {
            $today = now();

            $expiredCount = Inventory::where('expiry_date', '<', $today)
                ->where('status', '!=', 'expired')
                ->update(['status' => 'expired']);

            $outOfStockCount = Inventory::where('quantity', '<=', 0)
                ->where('status', '!=', 'out_of_stock')
                ->update(['status' => 'out_of_stock']);

            // his sends data to your toaster or alert system
            return back()->with('success', "Updated $expiredCount expired and $outOfStockCount out-of-stock batches.");
        }



}
