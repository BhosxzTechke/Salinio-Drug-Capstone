<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Str;

class MockReturnService
{


/// global to get function from mock return service

    protected string $prefix;

    /**
     * Constructor
     *
     * @param string $prefix Optional prefix for tracking numbers
     */
    public function __construct(string $prefix = 'RET-JNT')
    {
        $this->prefix = $prefix;
    }

    /**
     * Generate a mock tracking number
     *
     * @return string
     */
    public function generateTrackingNumber(): string
    {
        return $this->prefix . '-' . strtoupper(Str::random(10));
    }



    protected $statuses = ['ready_for_pickup', 'picked_up', 'in_transit', 'delivered'];

    // Create shipment for order
        public function updateReturnShipment($return_request_id)
        {
            return DB::table('return_shipments')
                ->where('return_request_id', $return_request_id)
                ->update([
                    'shipment_status' => 'picked_up',
                    'shipped_at' => now(),
                    'updated_at' => now(),
                ]);
        }



    // Auto-update shipment status
        public function autoUpdateReturnShipments()
        {
            $shipments = DB::table('return_shipments')
                ->whereIn('shipment_status', [
                    'picked_up',
                    'in_transit'
                ])
                ->get();

                //// IIGNORE SI  ready_for_status

            foreach ($shipments as $shipment) {
                $currentIndex = array_search($shipment->shipment_status, $this->statuses);
                $nextStatus = $this->statuses[$currentIndex + 1] ?? null;

                if ($nextStatus) {
                    DB::table('return_shipments')
                        ->where('id', $shipment->id)
                        ->update([
                            'shipment_status' => $nextStatus,
                            // 'shipped_at' => Carbon::now(),
                            // 'updated_at' => Carbon::now(),
                        ]);
                }
            }
        }




    // // Get shipment info
    // public function getShipment($tracking_number)
    // {
    //     return DB::table('mock_shipments')
    //         ->where('tracking_number', $tracking_number)
    //         ->first();
    // }
}
