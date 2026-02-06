<?php

namespace App\Services;

use App\Models\Inventory;
use Exception;

class InventoryDeductionService
{
    public function deductFIFO($productId, $qtyNeeded, $sellingPrice)
    {
        $totalCost = 0;
        $totalProfit = 0;

        $batches = Inventory::where('product_id', $productId)
            ->where('quantity', '>', 0)
            ->orderBy('received_date', 'asc')
            ->lockForUpdate()
            ->get();


          ///Kinukuha lahat ng same product that is greater than > 0 and kung
          /// arrange it by received date sino unang pumasok siya ang uunang kukunin  

          // lets say 3 item 
        foreach ($batches as $batch) {

            if ($qtyNeeded <= 0) break;

            $deduct = min($batch->quantity, $qtyNeeded);

            $batch->decrement('quantity', $deduct);

            /// bawasan ung unang item sa row

            $batchCost = $batch->cost_price * $deduct;
            /// cost price niya was 10 pesos * sa need na qty na ibabawas 20 = 200

            $batchProfit = ($sellingPrice * $deduct) - $batchCost;
             /// cost price niya was 12 pesos * sa need na qty na ibabawas 20 = 220

             // 220 - 200 = 20 pesos yung 1 item row profit

            $totalCost += $batchCost; ///// total cost ilalagay lahat bawat item row cost lets say 200 + 240 etc
            $totalProfit += $batchProfit; /// same den 20 + 24 etc

            $qtyNeeded -= $deduct; /// lets say 20 - stock10  hanggang sa maubbos ung qty needed
        }

        if ($qtyNeeded > 0) {
            throw new Exception("Insufficient stock for product $productId");
        }

        return [
            'unit_cost' => $totalCost,
            'profit' => $totalProfit
        ];
    }
}
