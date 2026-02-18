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
use App\Models\Barangay;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Orderdetails;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Models\Brand;
use App\Models\City;
use App\Models\Province;
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


            $today = now()->toDateString();

            $inventory = Inventory::where('quantity', '>', 10)

                ->whereHas('product', function ($query) {
                    $query->where('is_ecommerce', true);
                })

                    ->where(function ($query) use ($today) {
                        $query->whereNull('expiry_date')
                            ->orWhere('expiry_date', '>', $today);
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








            // -------------------------- CUSTOMER ADDRESS
            

                // Show customer addresses
    public function CustomerAddress()
    {
        $customer_id = auth()->id();

        // Get the customer's addresses with their location relationships
        $addresses = Address::with(['province', 'city', 'barangay'])
                            ->where('customer_id', $customer_id)
                            ->orderByDesc('is_default')
                            ->orderBy('id', 'asc')
                            ->limit(3)
                            ->get();

        // All active provinces (for both add and edit forms)
        $provinces = Province::where('is_active', 1)->get();



        // Initialize empty collections for cities and barangays
        $cities = collect();
        $barangays = collect();

        // If editing an address, we want to prefill its cities and barangays
        // Here we just check the first address as an example
        if ($addresses->first()) {
            $firstAddress = $addresses->first();

            if ($firstAddress->province_id) {
                $cities = City::where('province_id', $firstAddress->province_id)
                            ->where('is_active', 1)
                            ->get();
            }

            if ($firstAddress->city_id) {
                $barangays = Barangay::where('city_id', $firstAddress->city_id)
                                    ->where('is_active', 1)
                                    ->get();
            }
        }

        return view('Ecommerce.ProfilePage.CustomerAddress', compact(
            'addresses',
            'provinces',
            'cities',
            'barangays'
        ));
    }


    




            public function CustomerAddressEdit(Address $addr)
                {
                    $provinces = Province::where('is_active', 1)->get();

                    // Get cities of the selected province
                    $cities = City::where('province_id', $addr->province_id)->where('is_active', 1)->get();

                    // Get barangays of the selected city
                    $barangays = Barangay::where('city_id', $addr->city_id)->where('is_active', 1)->get();

                    return view('Ecommerce.ProfilePage.CustomerAddress', compact('provinces', 'cities', 'barangays', 'addr'));
                }




                

        ////////// CRUD CUSTOMER ADDRESS

            // Store new address
            public function CustomerAddressStore(Request $request)
            {
                $request->validate([
                    'full_name'   => 'required|string|max:255',
                    'phone'       => 'required|string|max:20',
                    'street'      => 'required|string|max:255',
                    'province_id' => 'required|exists:provinces,id',
                    'city_id'     => 'required|exists:cities,id',
                    'barangay_id' => 'required|exists:barangays,id',
                    'is_default'  => 'nullable|boolean',
                ]);

                $customerId = auth()->id();

                // Unset previous default if needed
                if ($request->is_default) {
                    Address::where('customer_id', $customerId)
                        ->update(['is_default' => false]);
                }

                Address::create([
                    'customer_id' => $customerId,
                    'full_name'   => $request->full_name,
                    'phone'       => $request->phone,
                    'street'      => $request->street,
                    'province_id' => $request->province_id,
                    'city_id'     => $request->city_id,
                    'barangay_id' => $request->barangay_id,
                    'is_default'  => $request->is_default ?? false,
                ]);

                return back()->with('success', 'Address saved successfully');
            }




            

                // Get cities based on selected province
                public function getCities(Request $request)
                {
                    $provinceId = $request->query('province_id');

                    if (!$provinceId) {
                        return response()->json([]);
                    }

                    $cities = City::where('province_id', $provinceId)->orderBy('name')->get();

                    return response()->json($cities);
                }

                // Get barangays based on selected city
                public function getBarangays(Request $request)
                {
                    $cityId = $request->query('city_id');

                    if (!$cityId) {
                        return response()->json([]);
                    }

                    $barangays = Barangay::where('city_id', $cityId)->orderBy('name')->get();

                    return response()->json($barangays);
                }
    









            // Update existing address
            public function UpdateCustomerAddress(Request $request)
            {
                $request->validate([
                    'address_id'  => 'required|exists:addresses,id',
                    'full_name'   => 'required|string|max:255',
                    'phone'       => 'required|string|max:20',
                    'street'      => 'required|string|max:255',
                    'province_id' => 'required|exists:provinces,id',
                    'city_id'     => 'required|exists:cities,id',
                    'barangay_id' => 'required|exists:barangays,id',
                    'is_default'  => 'nullable|boolean',
                ]);

                    $customerId = auth()->id();
                    $address = Address::where('id', $request->address_id)
                                    ->where('customer_id', $customerId)
                                    ->firstOrFail();

                    if ($request->is_default) {
                        Address::where('customer_id', $customerId)
                            ->update(['is_default' => false]);
                    }

                    $address->update([
                        'full_name'   => $request->full_name,
                        'phone'       => $request->phone,
                        'street'      => $request->street,
                        'province_id' => $request->province_id,
                        'city_id'     => $request->city_id,
                        'barangay_id' => $request->barangay_id,
                        'is_default'  => $request->is_default ?? false,
                    ]);

                    return back()->with('success', 'Address updated successfully');
                }




                


                // Delete address
                public function deleteCustomerAddress($id)
                {
                    $customerId = auth()->id();
                    $address = Address::where('id', $id)
                                    ->where('customer_id', $customerId)
                                    ->firstOrFail();
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
                    
                    $allErrors = implode('<br>', $validator->errors()->all());

                    // Send to session so toaster can display
                    return back()
                        ->withInput()
                        ->with('message', $allErrors)
                        ->with('alert-type', 'error');
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

                } catch (\Throwable $th) {
                    
                    $notification = [
                        'message' => 'Something went wrong: ' . $th->getMessage(),
                        'alert-type' => 'error'
                    ];
                    return back()->with($notification);


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
