<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Mail\ReturnStatusMail;
use App\Models\Inventory;
use App\Models\return_requests;
use App\Models\return_shipments;
use App\Models\ReturnRequest;
use App\Services\MockReturnService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

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




        public function AdminConfirmReturned($id){

            $requestData = ReturnRequest::findorfail($id);

            return view('Return.ReturnProcess.ReturnConfirmedItem', compact('requestData'));

        }



        public function ReturnMarkReceived(Request $request, $id)
        {
            $returnRequest = ReturnRequest::findOrFail($id);

            // Only update if current status is not refunded/rejected
            if(!in_array($returnRequest->status, ['refunded', 'rejected', 'received'])){
                $returnRequest->status = 'received';
                $returnRequest->save();
            }

                $notification = array(
                'message' => 'Return Order Received',
                'alert-type' => 'success',
            );


            
                return redirect()->back()->with($notification);



        }





        public function ReturnhandleAction(Request $request, $id)
        {


            $return = ReturnRequest::with('order')->findOrFail($id);
            $order  = $return->order;



            



            //// Customer
            $customer = $order->customer;

        // Prevent double refund



        if ($return->status === 'refunded') {
            return back()->with('error', 'This return has already been refunded.');
        }

    /////////////// [ IF ADMIN SELECTED REJECT ] ///////////////////////////

        // Reject flow
        if ($request->action === 'reject') {
            $return->update([
                'status'      => 'rejected',
                'description' => $request->reject_reason,
            ]);

                Mail::to($customer->email)->send(new ReturnStatusMail($return, 'rejected'));

                    
            $notification = [
                'message' => 'Successfully Rejected',
                'alert-type' => 'success',
            ];

            return redirect()->route('customer.returning.item')->with($notification);



    }


    /////////////// [ IF ADMIN SELECTED REFUND ] ///////////////////////////

    // Refund flow
if ($request->action === 'refund') {

    $request->validate([
        'refund_amount' => 'nullable|numeric|min:1',
    ]);

    // Safety checks
    if ($return->status !== 'received') {
        return back()->with('error', 'Item must be received before refund.');
    }

    if ($order->payment_status !== 'paid') {
        return back()->with('error', 'Order is not paid.');
    }

    // Check if it's a COD order
    $isCOD = !$order->paypal_capture_id; // true if COD

    if (!$isCOD) {
        // PayPal Refund
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $invoiceId = $request->invoice_id ?? '';
        $note      = $request->note ?? 'Refund processed by admin';
        $refundAmount = $request->refund_amount ?? $order->total;

        $response = $provider->refundCapturedPayment(
            $order->paypal_capture_id,
            $invoiceId,
            floatval($refundAmount),
            $note
        );
    } else {
        // COD: just set refund amount
        $refundAmount = $request->refund_amount ?? $order->total;
        $response = ['id' => null]; // no PayPal refund ID
    }

    // Update DB in transaction
    try {
        DB::transaction(function () use ($return, $order, $response, $refundAmount) {
            $return->update([
                'status'       => 'refunded',
                'refund_amount'=> $refundAmount,
                'refund_id'    => $response['id'] ?? null,
                'refunded_at'  => now(),
            ]);

            $order->update([
                'payment_status' => 'refunded',
            ]);

            // Restock items
            foreach ($order->items as $item) {

                if ($item->product->prescription_required) continue;

                if ($return->quantity > 0) {

                    $expiryDate = Inventory::where('product_id', $item->product_id)
                                        ->orderBy('expiry_date', 'asc')
                                        ->value('expiry_date');


                    Inventory::create([
                        'product_id'    => $item->product_id,
                        'supplier_id'   => null,
                        'batch_number'  => null,
                        'expiry_date'   => $expiryDate,
                        'received_date' => now(),
                        'quantity'      => $return->quantity,
                        'cost_price'    => optional($item->product->PurchaseOrderItems)->cost_price ?? 0,
                        'selling_price' => $item->product->selling_price ?? 0,
                        'source'        => 'return',
                    ]);
                }
            }
        });
    } catch (\Exception $e) {
        \Log::error('Return refund transaction failed: '.$e->getMessage());
        return back()->with('error', 'Something went wrong: '.$e->getMessage());
    }




        Mail::to($customer->email)->send(new ReturnStatusMail($return, 'refunded'));

        

                $notification = [
                    'message' => 'Successfully Refund',
                    'alert-type' => 'success',
                ];

                return redirect()->route('customer.returning.item')->with($notification);

            }

                return back()->with('error', 'Invalid action.');
            }




}
