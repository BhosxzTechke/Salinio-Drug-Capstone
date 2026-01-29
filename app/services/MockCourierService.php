<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MockCourierService
{
    protected $statuses = ['ready_for_shipment', 'picked_up', 'out_for_delivery', 'delivered'];

    // Create shipment for order
        public function createShipmentWithTracking($order_id)
        {
            $tracking_number = 'jnt' . rand(1000000, 9999999);

            DB::table('mock_shipments')->insert([
                'order_id' => $order_id,
                'tracking_number' => $tracking_number,
                'delivery_status' => 'ready_for_shipment',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return $tracking_number;
        }



    // Auto-update shipment status
        public function autoUpdateShipments()
        {
            $shipments = DB::table('mock_shipments')
                ->whereIn('delivery_status', [
                    'picked_up',
                    'out_for_delivery'
                ])
                ->get();

                //// IIGNORE SI  ready_for_shipment

            foreach ($shipments as $shipment) {
                $currentIndex = array_search($shipment->delivery_status, $this->statuses);
                $nextStatus = $this->statuses[$currentIndex + 1] ?? null;

                if ($nextStatus) {
                    DB::table('mock_shipments')
                        ->where('id', $shipment->id)
                        ->update([
                            'delivery_status' => $nextStatus,
                            'updated_at' => Carbon::now(),
                        ]);
                }
            }
        }




    // Get shipment info
    public function getShipment($tracking_number)
    {
        return DB::table('mock_shipments')
            ->where('tracking_number', $tracking_number)
            ->first();
    }
}
