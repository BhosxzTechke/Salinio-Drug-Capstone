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
            $layers = [];

            $batches = Inventory::where('product_id', $productId)
                ->where('quantity', '>', 0)
                ->orderBy('received_date', 'asc')
                ->lockForUpdate()
                ->get();

            foreach ($batches as $batch) {

                if ($qtyNeeded <= 0) break;

                $deduct = min($batch->quantity, $qtyNeeded);

                $batch->decrement('quantity', $deduct);

                $batchCost = $batch->cost_price * $deduct;
                $batchProfit = ($sellingPrice * $deduct) - $batchCost;

                $totalCost += $batchCost;
                $totalProfit += $batchProfit;


                
                $layers[] = [
                    'inventory_id' => $batch->id,
                    'batch_number' => $batch->batch_number,
                    'expiry_date'  => $batch->expiry_date,
                    'quantity'     => $deduct,
                    'unit_cost'    => $batch->cost_price,
                ];

                $qtyNeeded -= $deduct;
            }

            if ($qtyNeeded > 0) {
                throw new Exception("Insufficient stock for product $productId");
            }

            return [
                'total_cost' => $totalCost,
                'total_profit' => $totalProfit,
                'layers' => $layers
            ];
        }

}
