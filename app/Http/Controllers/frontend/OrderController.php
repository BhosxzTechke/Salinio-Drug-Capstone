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
use App\Services\InventoryDeductionService;
use Illuminate\Support\Facades\Log;

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


               // shipping calculation
            $cityFee = $Shipaddress->city->shipping_fee ?? 0;
            $barangayFee = $Shipaddress->barangay->extra_fee ?? 0;

            $shippingFee = $cityFee + $barangayFee;


            // ----- ALL TOTAL / SHIPPING + CART TOTAL
            $grandTotal = $totalInclusive + $shippingFee;




        return view('Ecommerce.payment.checkout', compact('totalInclusive', 'totalVatable', 'totalVat','Shipaddress','Customer','grandTotal','shippingFee'));


        }






public function EcommerceCheckout(Request $request)
{
    try {
        $request->validate([
            'shipping_address_id' => 'required',
        ]);


            // Validate minimum payment
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


            // --- PAYPAL PAYMENT ---
            
            if ($request->payment_method === 'paypal') {
                $cartInstance = Cart::instance('ecommerce');
                $cartTotal = (float) str_replace(',', '', $cartInstance->total());

                // 1️ Create order first
                $order = Order::create([
                    'customer_id'         => $request->customer_id,
                    'shipping_address_id' => $request->shipping_address_id,
                    'courier'             => $request->shipping_method ?? 'own_rider',
                    'order_status'        => 'pending',
                    'payment_status'      => 'pending',
                    'payment_method'      => 'paypal',
                    'total_products'      => $cartInstance->count(),
                    'sub_total'           => (float) $cartInstance->subtotal(),
                    'vat'                 => (float) $cartInstance->tax(),
                    'total'               => $cartTotal,
                    'pay'                 => $cartTotal,
                    'due'                 => 0,
                    'order_date'          => now(),
                    'invoice_no'          => 'Salinio' . mt_rand(10000000, 99999999),
                ]);


                // --- Store checkout data in session BEFORE redirect ---
                session([
                    'checkout_data' => [
                        'customer_id'         => $request->customer_id,
                        'shipping_address_id' => $request->shipping_address_id,
                        'shipping_method'     => $request->shipping_method ?? 'own_rider',
                        'order_date'          => now(),
                        'total_products'      => Cart::instance('ecommerce')->count(),
                        'payment_method'      => $request->payment_method,
                        'pay_amount'          => $request->pay,
                    ]
                ]);

                $provider = new PayPalClient;
                $provider->setApiCredentials(config('paypal'));
                $provider->setAccessToken($provider->getAccessToken());

                $paypalOrder = $provider->createOrder([
                    "intent" => "CAPTURE",
                    "application_context" => [
                        "return_url" => route('paypal.success'),
                        "cancel_url" => route('paypal.cancel'),
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



                // 2️ Save PayPal order ID in your database
                $order->update(['paypal_order_id' => $paypalOrder['id']]);

                $approveLink = collect($paypalOrder['links'])->firstWhere('rel', 'approve');
                if ($approveLink) {
                    return redirect()->away($approveLink['href']);
                }

                

                return back()->with([
                    'message' => 'Unable to initiate PayPal payment. Please try again.',
                    'alert-type' => 'error'
                ]);
            }



            // --- CASH OR OTHER PAYMENT METHODS ---
            return $this->processOrder($request);




                } catch (\Throwable $th) {
                    
                    $notification = [
                        'message' => 'Something went wrong: ' . $th->getMessage(),
                        'alert-type' => 'error'
                    ];
                    return back()->with($notification);
                }
}



                                // if paypal success
public function paypalSuccess(Request $request)
{
    $paypalOrderId = $request->query('token');

    if (!$paypalOrderId) {
        return redirect()->route('cart.checkout')
            ->with('error', 'Missing PayPal token.');
    }

    $order = Order::where('paypal_order_id', $paypalOrderId)->first();

    if (!$order) {
        return redirect()->route('cart.checkout')
            ->with('error', 'Order not found.');
    }

    if ($order->payment_status === 'paid') {
        return view('Ecommerce.payment.success', [
            'order' => $order->load('orderDetails.product'),
            'total' => $order->total,
            'OrderNumber' => $order->id,
        ]);
    }

    // capture paypal
    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $provider->setAccessToken($provider->getAccessToken());

    $result = $provider->capturePaymentOrder($paypalOrderId);

    $captureId = $result['purchase_units'][0]['payments']['captures'][0]['id'] ?? null;

    if (!$captureId) {
        return redirect()->route('cart.checkout')
            ->with('error', 'Unable to capture PayPal payment.');
    }

    $checkout = session('checkout_data');
    if (!$checkout) {
        return redirect()->route('cart.checkout')
            ->with('error', 'Checkout session expired.');
    }

    $cart = Cart::instance('ecommerce');
    $inventoryService = app(InventoryDeductionService::class);



    try {

        DB::transaction(function () use ($order, $checkout, $cart, $captureId, $inventoryService) {

            //  FIFO STOCK DEDUCT FIRST
            foreach ($cart->content() as $item) {

                $deduct = $inventoryService->deductFIFO(
                    $item->options->product_id,
                    $item->qty,
                    $item->price
                );

            ///////////////// AFTER DEDUCTING SA SERVICES THEN BACK ON     
            foreach ($deduct['layers'] as $layer) {


                            Orderdetails::create([
                                'order_id'     => $order->id,
                                'product_id'   => $item->options->product_id,
                                'inventory_id' => $layer['inventory_id'],  // 
                                'batch_number' => $layer['batch_number'],
                                'expiry_date'  => $layer['expiry_date'],
                                'quantity'     => $layer['quantity'],
                                'price'        => $item->price,
                                'unitcost'     => $layer['unit_cost'],
                                'profit'       => ($item->price - $layer['unit_cost']) * $layer['quantity'],
                            ]);

                        }

                
            }




// ----------------- CALCULATION OF SHIPPING FEE BASED ON ADDRESS ---------- //
                                ///// SHIPPING ADDRESS
            $address = $checkout['shipping_address_id'];


        $address = Address::with(['city', 'barangay'])
        ->findOrFail($checkout['shipping_address_id']);


        // shipping calculation
            $cityFee = $address->city->shipping_fee ?? 0;
            $barangayFee = $address->barangay->extra_fee ?? 0;

            $shippingFee = $cityFee + $barangayFee;


            // ----- ALL TOTAL / SHIPPING + CART TOTAL
            $grandTotal = $cart->total() + $shippingFee;




            // update order after stock secured
            $order->update([
                'customer_id' => $checkout['customer_id'],
                'order_source' => 'ECOM',
                'order_type' => 'Delivery',
                'order_date' => $checkout['order_date'] ?? now(),
                'order_status' => 'pending',
                'delivery_status' => 'pending',
                'courier' => $checkout['shipping_method'],
                'shipping_address_id' => $checkout['shipping_address_id'],
                'payment_method' => 'paypal',
                'payment_status' => 'paid',
                'sub_total' => $cart->subtotal(),
                'vat' => $cart->tax(),
                'total' => $grandTotal,
                'pay' => $grandTotal,
                'due' => 0,
                'paypal_capture_id' => $captureId,
                'shipping_fee' => $shippingFee,

            ]);





            $cart->destroy();
            session()->forget('checkout_data');
        });

    } catch (\Exception $e) {



        return back()->with('error', $e->getMessage());

                
            // mark order failed
            $order->update([
                'order_status' => 'cancelled',
                'payment_status' => 'refunded'
            ]);
            
    }

    return view('Ecommerce.payment.success', [
        'order' => $order->load('orderDetails.product'),
        'total' => $order->total,
        'OrderNumber' => $order->id,
    ]);
}





        //// Cash success payment
        public function SuccesfullyOrder($id)
        {

        $order = Order::with('orderDetails.product')->findOrFail($id);     
        $total = $order->total; // Access total directly from the order model
        $OrderNumber = $order->id;

        return view('Ecommerce.payment.success', compact('order', 'total', 'OrderNumber'));


        }




//////////////////////// ----------------- IF CASH OR COD --------------

private function processOrder(Request $request)
{
    $cart = Cart::instance('ecommerce');
    

    if ($cart->count() === 0) {
        
        $cart->destroy();
        return redirect()->route('cart.show');
    }



    $inventoryService = app(InventoryDeductionService::class);

    try {

        $order = DB::transaction(function () use ($request, $cart, $inventoryService) {
        


        $cartTotal = (float) str_replace(',', '', $cart->total());
        $subTotal  = (float) str_replace(',', '', $cart->subtotal());
        $vat       = (float) str_replace(',', '', $cart->tax());


    
                    ///// SHIPPING ADDRESS
        $address = Address::with(['city', 'barangay'])
            ->findOrFail($request->shipping_address_id);



        // shipping calculation
            $cityFee = $address->city->shipping_fee ?? 0;
            $barangayFee = $address->barangay->extra_fee ?? 0;

            $shippingFee = $cityFee + $barangayFee;


            // ----- ALL TOTAL / SHIPPING + CART TOTAL
            $grandTotal = $cartTotal + $shippingFee;



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
                'total'           => $grandTotal ?? '',

                // KEEP PAYPAL VALUES
                'payment_method' => 'cod',
                'payment_status' => 'unpaid',
                'shipping_fee' => $shippingFee,


                'pay'             => $grandTotal ?? '',
                'due'             => 0,

                'created_at'      => now(),
            ]);



        


            foreach ($cart->content() as $item) {

                $deduct = $inventoryService->deductFIFO(
                    $item->options->product_id,
                    $item->qty,
                    $item->price
                );

                Orderdetails::create([
                    'order_id' => $order->id,
                    'product_id' => $item->options->product_id,
                    'quantity' => $item->qty,
                    'price' => $item->price,
                    'unitcost' => $deduct['unit_cost'] / $item->qty,
                    'profit' => $deduct['profit'],
                ]);
            }


            $cart->destroy();
            return $order; //


        });



        return redirect()->route('success.order', $order->id);

    } catch (\Exception $e) {
            Log::error('Order failed', [
                'message' => $e->getMessage(),
                'cart' => $cart->content()->toArray(),
                'checkout' => session('checkout_data'),
            ]);
        // return back()->with('error', $e->getMessage());

                $cart->destroy();
        return redirect()->route('cart.show')->with('error', $e->getMessage());
    }
}





        public function PaypalCancel() {
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