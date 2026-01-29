<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\Order;
use App\Models\Orderdetails;
use App\Models\Inventory;
use App\Models\Product;
use Carbon\Carbon;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;
use App\Models\Customer;


class OrderController extends Controller
{
 //



        public function EcommercePayment() {

        if (Cart::instance('ecommerce')->count() === 0) {
        return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }


        $vatRate = config('cart.tax'); // e.g., 12
        $totalInclusive = (float) str_replace(',', '', Cart::instance('ecommerce')->subtotal());
        $totalVatable = round($totalInclusive / (1 + ($vatRate / 100)), 2);
        $totalVat = round($totalInclusive - $totalVatable, 2);


        // if authenticate 
        $Customer = Auth::guard('customer')->user();

        $Shipaddress = Address::where('customer_id', $Customer->id)->where('is_default', 1)->first();

        return view('Ecommerce.payment.checkout', compact('totalInclusive', 'totalVatable', 'totalVat','Shipaddress','Customer'));


        }



public function EcommerceCheckout(Request $request)
{
    try {
        // $request->validate([
        //     'shipping_address_id' => 'required',
        // ]);

        if ($request->pay < $request->total) {
            $notification = [
                'message' => 'The payment amount must be greater than or equal to the total due.',
                'alert-type' => 'error'
            ];
            return back()->with($notification);
        }


        


        $cartInstance = Cart::instance('ecommerce');
        $cartTotal = floatval(str_replace(',', '', $cartInstance->total()));
        $subTotal = floatval(str_replace(',', '', $cartInstance->subtotal()));
        $vat = floatval(str_replace(',', '', $cartInstance->tax()));
        $due = $request->pay - $cartTotal;

        if ($request->payment_method === 'paypal') {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $token = $provider->getAccessToken();
            $provider->setAccessToken($token);



            $paypalOrder = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route("paypal.success"),
                    "cancel_url" => route("paypal.cancel"),
                    "shipping_preference" => "NO_SHIPPING",
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "PHP",
                            "value" => number_format($cartTotal, 2, '.', ''),
                        ]
                    ]
                ]
            ]);



            foreach ($paypalOrder['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    session(['checkout_data' => $request->all()]);
                    return redirect()->away($link['href']);
                }
            }


            $notification = [
                'message' => 'Unable to initiate PayPal payment. Please try again.',
                'alert-type' => 'error'
            ];
            return back()->with($notification);
        }

        return $this->processOrder($request);

    } catch (\Throwable $th) {
        $notification = [
            'message' => 'Something went wrong: ' . $th->getMessage(),
            'alert-type' => 'error'
        ];
        return back()->with($notification);
    }
}





                /////////// ITO UNG KUKUHA NG URL
                public function paypalSuccess(Request $request)
                {
                $provider = new PayPalClient;
                $provider->setApiCredentials(config('paypal'));
                $token = $provider->getAccessToken();
                $provider->setAccessToken($token);

                $paypalOrderId = $request->get('token');
                $result = $provider->capturePaymentOrder($paypalOrderId);

                if (isset($result['status']) && $result['status'] === 'COMPLETED') {
                        // Retrieve original request data
                        $requestData = session('checkout_data');
                        $request = new Request($requestData);
                        $request->merge([
                        'payment_status' => 'paid',
                        'payment_method' => 'paypal',
                        ]);

                        return $this->processOrder($request);
                }

                return redirect()->route('cart.checkout')->with('error', 'Payment was not successful.');
                }






private function processOrder(Request $request)
{
    DB::beginTransaction();

    try {

        $cartInstance = Cart::instance('ecommerce');

        if ($cartInstance->count() === 0) {
            throw new \Exception('Cart is empty.');
        }


                // PAYMENT LOGIC (MUST BE BEFORE CREATE)
        if ($request->payment_method === 'cod') {
            $paymentMethod = 'cod';
            $paymentStatus = 'unpaid';
        } else {
            $paymentMethod = 'paypal';
            $paymentStatus = 'paid';
        }
        

        $cartTotal = (float) str_replace(',', '', $cartInstance->total());
        $subTotal  = (float) str_replace(',', '', $cartInstance->subtotal());
        $vat       = (float) str_replace(',', '', $cartInstance->tax());

        //  KEEP REQUEST-BASED DATA (PAYPAL DEPENDS ON THIS)
        $order = Order::create([
            'customer_id'     => $request->customer_id ?? '',
            'order_source'    => 'ECOM',
            'order_type'      => 'Delivery',

            // KEEP THESE (IMPORTANT)
            'order_date'      => Carbon::parse($request->order_date ?? ''),
            'order_status'    => 'pending',
            'total_products'  => $request->total_products ?? '',

            // DELIVERY STATUS LOGIC
            'delivery_status' => 'pending',


            // COURIER JNT OR OWN RIDER // mas good code fallback if wala sa dalawang yan then 'own rider'
            'courier' => $request->shipping_method == 'own_rider' ? 'own_rider' : 'jnt',


            'shipping_address_id' => $request->shipping_address_id ?? '',



            'sub_total'       => $subTotal ?? '',
            'vat'             => $vat ?? '',
            'invoice_no'      => 'Salinio' . mt_rand(10000000, 99999999),
            'total'           => $cartTotal ?? '',

            // KEEP PAYPAL VALUES
            'payment_method' => $paymentMethod,
            'payment_status' => $paymentStatus,



            'pay'             => $cartTotal ?? '',
            'due'             => 0,

            'created_at'      => now(),
        ]);

        // SAVE ORDER DETAILS ONLY (NO INVENTORY DEDUCTION)
        foreach ($cartInstance->content() as $item) {
            Orderdetails::create([
                'order_id'   => $order->id ?? '',
                'product_id' => $item->options->product_id ?? '',
                'quantity'   => $item->qty ?? '',
                'price'      => $item->price ?? '',
                // 'status'     => 'pending',
            ]);
        }

        //  CLEAR CART
        $cartInstance->destroy();

        DB::commit();

        return redirect()
            ->route('success.order', $order->id)
            ->with('success', 'Payment successful. Your order is now pending.');

    } catch (\Exception $e) {

        DB::rollBack();

        //  THIS WILL NOW ONLY HAPPEN IF THERE IS A REAL ERROR
        return back()->with('error', $e->getMessage());
    }
}







        public function successPaypal($id)
        {
        $order = Order::with('orderDetails.product')->findOrFail($id);
        $total = $order->total; // Access total directly from the order model
        $OrderNumber = $order->id;

        return view('Ecommerce.payment.success', compact('order', 'total', 'OrderNumber'));
        }





        //// Cash success payment
        public function SuccesfullyOrder($id)
        {

        $order = Order::with('orderDetails.product')->findOrFail($id);     
        $total = $order->total; // Access total directly from the order model
        $OrderNumber = $order->id;

        return view('Ecommerce.payment.success', compact('order', 'total', 'OrderNumber'));


        }





        public function CancelOrder() {
        return view('Ecommerce.payment.cancel');
        }



        //////////// CHANGE ADRESS ///////////////
        public function updateAddress(Request $request)
        {
        $customer = Auth::guard('customer')->user();

        // Case 1: Selected an existing saved address

        /// if pumindot ka sa combobox 
        if ($request->filled('saved_address')) {
        $address = Address::where('customer_id', $customer->id)
        ->find($request->saved_address);

        if ($address) {

        session([
        'shipping_address_id' => $address->id,
        'shipping_address_temp' => null // clear temporary if existed na
        ]);
        }
        }




        // Case 2: Entered a new address manually
        elseif ($request->filled('new_address')) {
        if ($request->save_to_profile) {
        // Save permanently to DB
        $newAddress = Address::create([
        'customer_id' => $customer->id,
        'full_address' => $request->new_address,
        'is_default' => false,
        ]);

        session(['shipping_address_id' => $newAddress->id,
        'shipping_address_temp' => null, // clear temp
        ]);



        } else {
        // Store TEMPORARY address in session only
        session(['shipping_address_temp' => [
        'full_address' => $request->new_address,
        'customer_id' => $customer->id
        ]]);
        }
        }

        return redirect()->back()->with([
        'message' => 'Shipping address updated',
        'alert-type' => 'success'
        ]);
}


///////////// AJAX CANCEL ORDER IN HISTORY /////////////




        public function ajaxMarkAsCancelled(Request $request)
        {
                // if (!$request->ajax()) {
                //         return response()->json(['error' => 'Invalid request'], 400);
                // }

                // $user = auth('customer')->user();

                // if (!$user) {
                //         return response()->json(['error' => 'Unauthorized'], 401);
                // }

                $order = Order::findOrFail($request->id);

                // Prevent cancelling if already shipped or cancelled
                if ($order->order_status === 'shipped') {
                        return response()->json(['error' => 'Order has already been shipped and cannot be cancelled'], 400);
                }
                
                if ($order->order_status === 'cancelled') {
                        return response()->json(['error' => 'Order is already cancelled'], 400);
                }

                // Only allow cancelling if status is 'pending' or 'processing'
                if (!in_array($order->order_status, ['pending', 'processing'])) {
                        return response()->json(['error' => 'Only pending or processing orders can be cancelled'], 400);
                }

                $order->order_status = 'cancelled';
                $order->save();

                return response()->json(['success' => true, 'message' => 'Order cancelled.']);
        }
}