<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Services\TwilioService;
use Codemonkey76\ClickSend\ClickSendFacade;
use Illuminate\Support\Facades\Log;
use Codemonkey76\ClickSend\Facades\ClickSend;
use Codemonkey76\ClickSend\SmsMessage;



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
        // public function autoUpdateShipments()
        // {
        //     $shipments = DB::table('mock_shipments')
        //         ->whereIn('delivery_status', [
        //             'picked_up',
        //             'out_for_delivery'
        //         ])
        //         ->get();

        //         //// IIGNORE SI  ready_for_shipment

        //     foreach ($shipments as $shipment) {
        //         $currentIndex = array_search($shipment->delivery_status, $this->statuses);
        //         $nextStatus = $this->statuses[$currentIndex + 1] ?? null;

        //         if ($nextStatus) {
        //             DB::table('mock_shipments')
        //                 ->where('id', $shipment->id)
        //                 ->update([
        //                     'delivery_status' => $nextStatus,
        //                     'updated_at' => Carbon::now(),
        //                 ]);
        //         }
        //     }
        // }






public function autoUpdateShipments()
{
    $shipments = DB::table('mock_shipments')
        ->whereIn('delivery_status', [
            'picked_up',
            'out_for_delivery'
        ])
        ->get();

    foreach ($shipments as $shipment) {

        // Determine next status
        $currentIndex = array_search($shipment->delivery_status, $this->statuses);
        $nextStatus = $this->statuses[$currentIndex + 1] ?? null;

        if (!$nextStatus) {
            continue;
        }

        if ($nextStatus === 'out_for_delivery' && is_null($shipment->sms_sent_at)) {

            // Get order + customer info
            $order = DB::table('orders')
                ->join('customers', 'customers.id', '=', 'orders.customer_id')
                ->where('orders.id', $shipment->order_id)
                ->select(
                    'orders.id',
                    'customers.name as customer_name',
                    'customers.phone as customer_phone'
                )
                ->first();


            if ($order && $order->customer_phone) {

                $message = "Hi {$order->customer_name}! 🚚
                    Your order #{$order->id} is now OUT FOR DELIVERY.";


                try {
                    // ClickSend SMS
                    $sms = new SmsMessage(
                        $order->customer_phone,          // To
                        config('services.clicksend.sms_from'), // From (can be blank for PH)
                        $message                        // Message
                    );

                    $response = ClickSendFacade::SendMessage($sms);

                    Log::info("ClickSend SMS sent", [
                        'to' => $order->customer_phone,
                        'response' => (array)$response,
                        'message' => $message
                    ]);

                    // Update SMS sent timestamp
                    DB::table('mock_shipments')
                        ->where('id', $shipment->id)
                        ->update(['sms_sent_at' => now()]);

                } catch (\Exception $e) {
                    Log::error("ClickSend SMS failed", [
                        'to' => $order->customer_phone,
                        'error' => $e->getMessage()
                    ]);
                }
            }
        }

        // Update shipment status
        DB::table('mock_shipments')
            ->where('id', $shipment->id)
            ->update([
                'delivery_status' => $nextStatus,
                'updated_at' => Carbon::now(),
            ]);
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
