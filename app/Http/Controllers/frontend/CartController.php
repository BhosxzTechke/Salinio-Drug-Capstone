<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Product;
use PDO;

class CartController extends Controller
{
    //






public function EcommerceAddCart(Request $request)
{
    // $request->validate([
    //     'id'  => 'required|integer',
    //     'qty' => 'required|integer|min:1'
    // ]);

    $productId = $request->id;

    // Total available stock (FIFO-safe check)
    $totalAvailable = Inventory::where('product_id', $productId)
        ->where('quantity', '>', 0)
        ->sum('quantity');



    if ($totalAvailable < $request->qty) {
        return back()->with([
            'message' => 'Product out of stock or insufficient quantity.',
            'alert-type' => 'error'
        ]);
    }

    // Get product once
    $product = Product::findOrFail($productId);

    Cart::instance('ecommerce')->add([
        'id'    => $product->id, // PRODUCT ID (important)
        'name'  => $product->product_name,
        'qty'   => $request->qty,
        'price' => $product->selling_price,
        'weight'=> 0,
        'options' => [
            'product_id' => $product->id,
            'image'      => $product->product_image,
        ]
    ]);

    return back()->with([
        'message' => 'Product added to cart successfully.',
        'alert-type' => 'success'
    ]);
}





        public function EcommerceChangeQty(Request $request, $rowId)
        {
            $request->validate([
                'qty' => 'required|integer|min:1'
            ]);

            $cart = Cart::instance('ecommerce');
            $cartItem = $cart->get($rowId);

            if (!$cartItem) {
                return back()->with([
                    'message' => 'Cart item not found.',
                    'alert-type' => 'error'
                ]);
            }

            $productId = $cartItem->options->product_id;

            // Total FIFO stock (all valid batches)
            $totalAvailable = Inventory::where('product_id', $productId)
                ->where('quantity', '>', 0)
                ->sum('quantity');

            if ($request->qty > $totalAvailable) {
                return back()->with([
                    'message' => "Only {$totalAvailable} item(s) available in stock.",
                    'alert-type' => 'error'
                ]);
            }

            // Update quantity
            $cart->update($rowId, $request->qty);

            return back()->with([
                'message' => 'Cart updated successfully.',
                'alert-type' => 'success'
            ]);
        }




    /// for testing
   public function CartContent(Request $Request)
        {

              // ID FOR CUSTOMER AND ALL CONTENT IN THE CART
           $customer_id = $Request->customer_id;
           $Customer = Customer::where('id', $customer_id)->first();
           $products = Cart::instance('ecommerce')->content();  // Customer's cart

            $notification = array(
                'message' => 'Cart Content Retrieved Successfully',
                'alert-type' => 'success'
            );

            return view('Ecommerce.EcommercePage.carting', compact('products','Customer'))->with($notification);
        }





     public function RemoveEcommProduct($rowId)
        {
            Cart::instance('ecommerce')->remove($rowId);

            $notification = array(
                'message' => 'Product Removed Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
                





}