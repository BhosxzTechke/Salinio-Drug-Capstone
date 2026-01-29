<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Orderdetails;
use App\Models\Product;
use App\Models\Rider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiderController extends Controller
{
    //



    public function ForRiderTable()
    {
        $rider = Rider::where('user_id', auth()->id())->firstOrFail();

            $riderOrders = Order::where('rider_id', $rider->id)
                ->where('delivery_status', 'assigned')
                ->latest()
                ->get();

        return view('rider.RiderTable.AllRiderOrder', compact('rider', 'riderOrders'));
    }




    public function PickupItemDetails($Order_id) {


        $rider = Rider::where('user_id', auth()->id())->firstOrFail();


        $Orders = Order::where('rider_id', $rider->id)->get();


    $OrderDetails = Orderdetails::where('Order_id', $Order_id)->get();

    return view('rider.RiderTable.PickUpItemDetails', compact('OrderDetails','Orders'));

    }




            
    public function ajaxPickupItem(Request $request)

        {
            $order = Order::findOrFail($request->id);
            $order->order_status = 'shipped';
            $order->delivery_status = 'picked_up';
            $order->save();
            return response()->json(['success' => true, 'message' => 'Order marked as shipped.']);
            }




            ////////////////////////////// PickUp Orders /////////////////////////////
            


        public function ForPickUpTable()
        {
            $rider = Rider::where('user_id', auth()->id())->firstOrFail();

                $riderOrders = Order::where('rider_id', $rider->id)
                    ->where('delivery_status', 'picked_up')
                    ->latest()
                    ->get();

            return view('rider.RiderTable.AllPickupOrder', compact('rider', 'riderOrders'));


        }



        
            public function ajaxDeliveredtem(Request $request)

                {
                    $order = Order::findOrFail($request->id);
                    $order->delivery_status = 'out_for_delivery';
                    $order->save();
                    return response()->json(['success' => true, 'message' => 'Order marked as Delivering.']);
                    
            }




            ////////////////////////////// Delivered Orders /////////////////////////////

            public function ForStartDeliveryTable()
            {
                $rider = Rider::where('user_id', auth()->id())->firstOrFail();

                    $riderOrders = Order::where('rider_id', $rider->id)
                        ->where('delivery_status', 'out_for_delivery')
                        ->latest()
                        ->get();

                return view('rider.RiderTable.AllStartDelivery', compact('rider', 'riderOrders'));
            }



            public function ajaxCompleteDelivered(Request $request)

                {
                    $order = Order::findOrFail($request->id);
                    $order->delivery_status = 'delivered';


                    $order->payment_status = $order->payment_method == 'cod' ? 'paid' : 'awaiting_confirm';

                    $order->save();


                    return response()->json(['success' => true, 'message' => 'Order marked as Delivered.']);
                    
            }
            
}



