<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\HeroSlider;    
use App\Models\Order;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Orderdetails;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Models\Brand;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller



{

        public function index()
        {
            $categori = Category::latest()->take(5)->get();

            $HeroSlider = HeroSlider::where('is_active', 1)->get();
            $brand = Brand::all();




            // //// /FIFO TRACKING
            // $inventory = Inventory::select(
            //         'product_id',
            //         DB::raw('SUM(quantity) as total_quantity'),
            //         DB::raw('MAX(created_at) as latest_date'),
            //         'selling_price'
            //     )
            //     ->where('quantity', '>', 10)
            //     ->groupBy('product_id', 'selling_price')
            //     ->orderByDesc('latest_date')
            //     ->inRandomOrder()
            //     ->take(8)
            //     ->get();

    $today = now()->toDateString();


            $inventory = Inventory::where('quantity', '>', 10)
                ->where(function ($query) use ($today) {
                    $query->whereNull('expiry_date') // allow items without expiry
                        ->orWhere('expiry_date', '>', $today); // only include not-expired
                })
                ->select(
                    'product_id',
                    'selling_price',
                    DB::raw('SUM(quantity) as total_quantity'),
                    DB::raw('MAX(created_at) as latest_created')
                )
                ->groupBy('product_id', 'selling_price')
                ->orderByDesc('latest_created')
                ->get();






            $bestSellers = $inventory
                ->groupBy('product_id')
                ->map(function ($group) {
                    // Sum sold_count from all inventory rows under the same product_id
                    $totalSold = $group->sum(function ($item) {
                        return $item->Orderdetails->sum('quantity');
                    });

                    // Pick the first inventory item for display (e.g., price)
                    $first = $group->first();
                    $first->sold_count = $totalSold;

                    return $first;
                })
                ->sortByDesc('sold_count')
                ->take(4)
                ->values();



            
            $newArrivals = Inventory::latest()->take(6)->get();



            // If logged in as customer → show customer dashboard
            if (Auth::guard('customer')->check()) {
                return view('Ecommerce.CustomerDashboard', compact('categori', 'newArrivals', 'bestSellers', 'HeroSlider', 'inventory', 'brand'));
            }

            // If not logged in → fallback to home
            return view('Ecommerce.home', compact('categori', 'newArrivals', 'bestSellers', 'HeroSlider','inventory', 'brand'));
        }


    


        public function ProductDetails($product_id)
        {
            $today = Carbon::today();

                $inventories = Inventory::with('product')
                    ->where('product_id', $product_id)
                    ->where('quantity', '>', 0)
                    ->orderBy('created_at', 'asc') // FIFO
                    ->get();

                $product = $inventories->first()->product;
                $totalQuantity = $inventories->sum('quantity');

                return view('Ecommerce.product_detail', compact(
                    'product',
                    'inventories',
                    'totalQuantity'
                ));


        }






    public function VatEcomm(){
        
    }





    public function CartShow()
    {

       $vatRate = config('cart.tax'); // e.g., 12
        $subtotal = (float) str_replace(',', '', Cart::instance('ecommerce')->subtotal());
        $totalVatable = round($subtotal / (1 + ($vatRate / 100)), 2);
        $totalVat = round($subtotal - $totalVatable, 2);


        // if authenticate 
         $Customer = Auth::guard('customer')->user();


        return view('Ecommerce.EcommercePage.cart', compact('subtotal', 'totalVatable', 'totalVat','Customer'));
    }


    public function WishlistShow()
    {

        return view('Ecommerce.EcommercePage.wishlist');
    }
    



    public function ProfileShow()
    {

        
        $customer = Auth::guard('customer')->user();

        $orders = Order::with(['customer','orderDetails'])
            ->where('customer_id', $customer->id)
            ->whereIn('order_status', ['pending', 'completed', 'return', 'shipped']) 
            ->orderBy('created_at', 'desc')
            ->latest()
            ->paginate(4);

        $orderCancel = Order::with(['customer','orderDetails'])
            ->where('customer_id', $customer->id)
            ->whereIn('order_status', ['cancelled']) 
            ->orderBy('created_at', 'desc')
            ->get();


        return view('Ecommerce.ProfilePage.profile', compact('orders','customer','orderCancel'));
    }




        public function ProfileEdit()
        {

            return view('Ecommerce.ProfilePage.EditProfile');
        }



        public function ChatAdmin()
        {

            $Customer = Auth::guard('customer')->user();

            return view('Ecommerce.ProfilePage.ChatAdmin', compact('Customer'));
        }


        

        public function CustomerAddress()
        {

            $customer_id = auth()->id();

            $address = Address::where('customer_id', $customer_id)
                            ->orderByDesc('is_default') // default address first
                            ->orderBy('id', 'asc')       // then by id
                            ->limit(3)
                            ->get();


            return view('Ecommerce.ProfilePage.CustomerAddress', compact('address'));

        }



        ////////// CRUD CUSTOMER ADDRESS

            public function CustomerAddressStore(Request $request)
            {
                $request->validate([
                    'full_name' => 'required|string',
                    'phone' => 'required|string',
                    'street' => 'required|string',
                    'barangay' => 'required|string',
                    'city' => 'required|string',
                    'is_default' => 'nullable|boolean',
                ]);

                $customerId = auth()->id(); // or customer_id

                // If this address is set as default
                if ($request->is_default) {
                    Address::where('customer_id', $customerId)
                        ->update(['is_default' => false]);
                }

                Address::create([
                    'customer_id' => $customerId,
                    'full_name' => $request->full_name,
                    'phone' => $request->phone,
                    'street' => $request->street,
                    'barangay' => $request->barangay,
                    'city' => $request->city,
                    'is_default' => $request->is_default ?? false,
                ]);

                return back()->with('success', 'Address saved successfully');
            }



            public function UpdateCustomerAddress(Request $request)
            {
                $request->validate([
                    'address_id' => 'required|exists:addresses,id',
                    'full_name' => 'required|string',
                    'phone' => 'required|string',
                    'street' => 'required|string',
                    'barangay' => 'required|string',
                    'city' => 'required|string',
                    'is_default' => 'nullable|boolean',
                ]);

                $addressID = $request->address_id;
                $customerId = auth()->id();

                // If this address is set as default, unset other default addresses for this customer
                if ($request->is_default) {
                    Address::where('customer_id', $customerId)->update(['is_default' => false]);
                }

                // Find the address and update it
                $address = Address::where('id', $addressID)->where('customer_id', $customerId)->firstOrFail();

                $address->update([
                    'full_name' => $request->full_name,
                    'phone' => $request->phone,
                    'street' => $request->street,
                    'barangay' => $request->barangay,
                    'city' => $request->city,
                    'is_default' => $request->is_default ?? false,
                ]);

                return back()->with('success', 'Address updated successfully');
            }


            public function deleteCustomerAddress($id)
            {
                $customerId = auth()->id();
                $address = Address::where('id', $id)->where('customer_id', $customerId)->firstOrFail();
                $address->delete();

                return back()->with('success', 'Address deleted successfully');
            }







        


        public function ProfileUpdate(Request $request)
        {
            $customerId = $request->input('id');

            try {
                // Validation
                $validator = Validator::make($request->all(), [
                    'name'  => 'required|string|max:255',
                    'email' => 'required|email|unique:customers,email,' . $customerId,
                    'tel'   => 'required|unique:customers,phone,' . $customerId,
                    'image' => 'nullable|image|max:10240', // 10 MB
                ]);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }


                $uploadedFileUrl = null;

                // Handle image upload to Cloudinary
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
    
                    $uploadedFileUrl = Cloudinary::upload($image->getRealPath(), 
                    ['folder' => 'customer_images'
                    ])->getSecurePath();

                    // $data['image'] = $uploadedFileUrl;

                }

                $data = [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('tel'),
                    'image' => $uploadedFileUrl,
                    'added_by_staff' => '0',
                    'updated_at' => Carbon::now(),
                ];




                // Update customer
                Customer::findOrFail($customerId)->update($data);

                $notification = [
                    'message' => 'Customer Updated Successfully',
                    'alert-type' => 'success'
                ];


                return redirect()->route('customer.profile')->with($notification);

            } catch (\Exception $e) {
                return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
            }
        }








        public function ViewItem($id) {
            $customer = Auth::guard('customer')->user();

            $order = Order::where('id', $id)
                        ->where('customer_id', $customer->id)
                        ->firstOrFail();

            return view('Ecommerce.ProfilePage.ViewOrderItem', compact('order'));
        }


        public function ReturnItem($id) {
            $customer = Auth::guard('customer')->user();

            $order = Order::where('id', $id)
                        ->where('customer_id', $customer->id)
                        ->firstOrFail();

            return view('Ecommerce.ProfilePage.TrackOrder.ReturnItem', compact('order'));
        }




        
        

        public function TrackItem($id) {
            $customer = Auth::guard('customer')->user();

            $order = Order::where('id', $id)
                        ->where('customer_id', $customer->id)
                        ->firstOrFail();

            return view('Ecommerce.ProfilePage.TrackOrder.TrackingOrder', compact('order'));
        }








        //////////////////////////// CONFIDENTIAL PAGE IN FRONTEND //////////////////// 


            public function PrivacyPolicy(){


                return view('Ecommerce.EcommercePage.ConfidentialPage.PrivacyPolicy');


            }


            public function TermsAndServices(){

                    return view('Ecommerce.EcommercePage.ConfidentialPage.TermsAndService');

            
            }




        

}
