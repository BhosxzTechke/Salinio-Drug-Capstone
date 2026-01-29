<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistController extends Controller
{


public function EcommerceAddWishlist(Request $request)
{
    // Find inventory (same as cart, but NO quantity check needed)
    $inventoryItem = Inventory::where('product_id', $request->id)
        ->orderBy('created_at') // FIFO
        ->first();

    if (!$inventoryItem) {
        return redirect()->back()->with([
            'message' => 'Product not found',
            'alert-type' => 'error'
        ]);
    }

    // Prevent duplicate wishlist item
    $alreadyInWishlist = Cart::instance('wishlist')
        ->search(function ($cartItem) use ($inventoryItem) {
            return $cartItem->options->product_id == $inventoryItem->product_id;
        });

    if ($alreadyInWishlist->isNotEmpty()) {
        return redirect()->back()->with([
            'message' => 'Already in wishlist',
            'alert-type' => 'info'
        ]);
    }

    
    // Add to wishlist
    Cart::instance('wishlist')->add([
        'id' => $inventoryItem->id, // inventory row ID (same pattern)
        'name' => $inventoryItem->product->product_name ?? 'Unnamed Product',
        'qty' => 1,
        'price' => $inventoryItem->product->selling_price ?? 0,
        'weight' => 0,
        'options' => [
            'image' => $request->product_image,
            'product_id' => $inventoryItem->product_id,
        ]
    ]);

    return redirect()->back()->with([
        'message' => 'Added to Wishlist ❤️',
        'alert-type' => 'success'
    ]);
}



            /// for testing
        public function wishlistTest(Request $Request)
                {

                    // ID FOR CUSTOMER AND ALL CONTENT IN THE CART
                $customer_id = $Request->customer_id;
                $Customer = Customer::where('id', $customer_id)->first();
                $products = Cart::instance('wishlist')->content();  // Customer's cart

            $notification = array(
                'message' => 'Cart Content Retrieved Successfully',
                'alert-type' => 'success'
            );

            return view('Ecommerce.EcommercePage.wishlist-test', compact('products','Customer'))->with($notification);
        }


        

            
        public function RemoveEcommWish($rowId)
            {
                Cart::instance('wishlist')->remove($rowId);

                $notification = array(
                    'message' => 'Wishlist Removed Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);
            }
                




}
