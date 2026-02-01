<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\return_requests;
use App\Models\ReturnRequest;
use App\Services\MockReturnService;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnShipmentController extends Controller
{



public function CustomerReturnRequest(Request $request)
{
    $validated = $request->validate([
        'order_id' => 'nullable|exists:orders,id',
        'reason' => 'required|string|max:255',
        'description' => 'required|string|min:10',
        'quantity' => 'required|integer|min:1',

        'images'   => 'nullable|array|max:5',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:20480',
    ]);

    // Prevent duplicate returns per order
        if (!empty($validated['order_id'])) {
            $exists = ReturnRequest::where('order_id', $validated['order_id'])->exists();
            if ($exists) {
                return back()->with([
                    'message' => 'Return request already submitted for this order.',
                    'alert-type' => 'error',
                ]);
            }
        }

    DB::beginTransaction();

    try {
        $imageUrls = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageUrls[] = Cloudinary::upload(
                    $image->getRealPath(),
                    [
                        'folder' => 'customerProofRequest',
                        'transformation' => [
                            'width' => 300,
                            'height' => 300,
                            'crop' => 'fill',
                        ],
                    ]
                )->getSecurePath();
            }
        }

        ReturnRequest::create([
            'order_id' => $validated['order_id'] ?? null,
            'reason' => $validated['reason'],
            'description' => $validated['description'],
            'quantity' => $validated['quantity'],
            'photos' => $imageUrls, // auto-casted
            'status' => 'pending'
        ]);

        DB::commit();

        return redirect()
            ->route('customer.profile')
            ->with([
                'message' => 'Successfully requested return.',
                'alert-type' => 'success',
            ]);

    } catch (\Exception $e) {
        DB::rollBack();

        return back()->with([
            'message' => 'Something went wrong. Please try again.',
            'alert-type' => 'error',
        ]);

        dd($e);
    }

}



// public function HandToCourier($return_requestID)
// {
//     dd("Hit controller! ID => ", $return_requestID);
// }

                public function HandToCourier($return_requestID, MockReturnService $courier)
                {


                    $return_request = ReturnRequest::findOrFail($return_requestID);

                    $return_request->status = 'in_transit';
                    $return_request->save();        

                    // Create mock return shipment
                    $courier->updateReturnShipment($return_request->id);



                        return redirect()
                                ->route('customer.profile')
                                ->with([
                                    'message' => 'Successfully customer return.',
                                    'alert-type' => 'success',
                                ]);
                }

}


