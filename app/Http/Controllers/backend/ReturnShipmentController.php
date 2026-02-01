<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\return_requests;
use App\Models\return_shipments;
use App\Models\ReturnRequest;
use App\Services\MockReturnService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnShipmentController extends Controller
{
        


    protected MockReturnService $mockReturnService;

        // Inject the service via constructor
        public function __construct(MockReturnService $mockReturnService)
        {
            $this->mockReturnService = $mockReturnService;
        }



        public function CustomerRequestPending() {

            $ReturnData = ReturnRequest::where('status','pending')->get();

            return view('Return.ReturnRequestPending', compact('ReturnData'));
        }


        public function CustomerReturningItem() {

            $ReturnData = return_shipments::whereIn('shipment_status', ['ready_for_pickup','picked_up','in_transit','delivered'])->get();

            return view('Return.ReturningItem', compact('ReturnData'));
        }


                public function getReturnShipmentStatus($shipmentId)
                {
                    $returnShipment = return_shipments::find($shipmentId);
\Log::info("Fetching status for shipmentId: " . $shipmentId);
                    return response()->json([
                        'shipment_status' => $returnShipment?->shipment_status ?? 'unknown'
                    ]);
                }

            // ----------------------------
    // MarkAsConfirmOrder
    // ----------------------------
    
public function MarkAsReturnApproved($id)
{

        $trackingNumber = $this->mockReturnService->generateTrackingNumber();


    // Find the return request or fail
    $return = ReturnRequest::findOrFail($id);

    // Check if already approved
    if ($return->status === 'approved') {
        return response()->json([
            'success' => false,
            'message' => 'This return request has already been approved.'
        ]);
    }

    // Update return status
    $return->status = 'approved';
    $return->save();

    // Insert into return_shipments only if not exists
    $existingShipment = DB::table('return_shipments')
        ->where('return_request_id', $id)
        ->first();

    if (!$existingShipment) {
        DB::table('return_shipments')->insert([
            'return_request_id' => $id,
            'tracking_number' => $trackingNumber,
            'shipment_status' => 'ready_for_pickup',
            'shipped_at' => null,
            'delivered_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Return JSON
    return response()->json([
        'success' => true,
        'message' => 'Customer return approved successfully!'
    ]);
}




}
