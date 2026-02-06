@php use App\Models\Address; @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Pharmacy Shop')</title>

        <!-- Scripts -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <!-- Page-specific CSS -->

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

    </head>



    <body bgcolor="white" >





        <nav class="bg-white dark:bg-gray-50 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-100">
        






    <div class="max-w-screen-xl flex flex-wrap items-center justify-center mx-auto p-4">

                <h2 class="flex flex-wrap mr-10 text-gray-800 font-medium"> Secure Check</h2>
        <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Salino Drug</span>
        </a>




        </div>
        </nav>





            @php $ProductsCart = Cart::instance('ecommerce')->content(); @endphp

       

<div class="flex flex-col md:flex-row py-16 max-w-6xl w-full px-6 mx-auto">
    <div class="flex-1 max-w-4xl">

        <br>
        {{-- {{$Shipaddress->full_name}} --}}

        <div class="grid grid-cols-[2fr_1fr_1fr] text-gray-100 text-base font-medium pb-3">
            <p class="text-left text-gray-700">Product Details</p>
            <p class="text-center text-gray-700">Subtotal</p>
        </div>




        

        @foreach($ProductsCart as $item)

        <!-- Example Product Rows (Repeat for each product) -->
        <div class="grid grid-cols-[2fr_1fr_1fr] text-gray-700 items-center text-sm md:text-base font-medium pt-3">
            <div class="flex items-center md:gap-6 gap-3">
                <div class="cursor-pointer w-24 h-24 flex items-center justify-center border border-gray-100 rounded overflow-hidden">
                    <img class="max-w-full h-full object-cover" src="{{ asset($item->options->image)}}" alt="Item not found" />
                </div>

                <div>
                    <p class="hidden md:block font-semibold">{{ $item->name}}</p>
                    <div class="font-normal text-gray-500/70">
                        <p>Category: <span>walapa</span></p>
                        <div class="flex items-center">
                            <p>Qty:</p>
                            <select class="outline-none">
                                <option value="1">{{ $item->qty}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-center">₱{{ $item->subtotal}}</p>

        </div>
        <!-- Repeat above block for each product -->

        @endforeach

    </div>




    <div class="max-w-[360px] w-full bg-lime-100/40 p-5 max-md:mt-16 border border-gray-300/70">
        <h2 class="text-xl md:text-xl font-medium">Order Summary</h2>
        <span class="text-sm text-indigo-500">{{ $ProductsCart->count() }} Items</span>
      
        <hr class="border-gray-300 my-5" />




    <div class="mb-6">
    <form id="myForm" method="POST" action="{{ route('cart.checkout') }}" class="space-y-3">
    @csrf
    
    
            {{-- @php
                $customer = Auth::guard('customer')->user();

            @endphp --}}


        {{-- Safe hidden fields --}}
                            <input type="hidden" name="customer_id" value="{{ $Customer->id}}">
                            <input type="hidden" name="order_date" value="{{ now() }}">
                            <input type="hidden" name="order_status" value="pending">
                            <input type="hidden" name="total_products" value="{{ Cart::instance('ecommerce')->count() }}">
                            <input type="hidden" name="pay" value="{{ $totalInclusive }}" required="">

                            {{-- For shipping Address ID --}}

                            <input type="hidden" name="shipping_address_id" value="{{ $Shipaddress->id ?? '' }}">


            <p class="text-sm font-medium uppercase mt-6">Payment Method</p>
            <select name="payment_method" class="w-full border border-gray-300 bg-white px-3 py-2 mt-2 outline-none">
                <option value="cod">Cash on Delivery</option>
                <option value="paypal">Paypal</option>
            </select>
        </div>


                    <p class="text-sm font-medium uppercase mt-6">Shipping Method</p>

            <div class="form-group mt-2 space-y-2">


                <label class="flex items-center gap-2"> 
                    <input type="radio" name="shipping_method" value="jnt" checked required>
                    <span>J&T Express (1–3 Days)</span>
                    <span class="ml-auto text-sm text-gray-600">₱120</span>
                </label>
            </div>

            <input type="hidden" name="shipping_fee" id="shipping_fee" value="50">

            <br>



            

@if ($Shipaddress)
<div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 shadow-sm">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 20l-5.447-2.724A2 2 0 013 15.382V5a2 2 0 012-2h14a2 2 0 012 2v10.382a2 2 0 01-.553 1.894L15 20l-3-1.5L9 20z" />
            </svg>
            <h3 class="font-semibold text-green-700">Default Delivery Address</h3>
        </div>

        <span class="text-xs bg-green-200 text-green-800 px-3 py-1 rounded-full font-medium">
            Active
        </span>
    </div>

    <div class="mt-3 text-sm text-gray-700 leading-relaxed">
        <p class="font-medium">{{ $Shipaddress->full_name }}</p>
        <p>{{ $Shipaddress->street }}, {{ $Shipaddress->barangay }}</p>
        <p>{{ $Shipaddress->city }}</p>
        <p class="mt-1 text-gray-600">📞 {{ $Shipaddress->phone }}</p>
    </div>

    {{-- <div class="mt-4 flex gap-3">
        <button
            onclick="document.getElementById('addressModal').classList.remove('hidden')"
            class="text-sm px-4 py-2 rounded-lg border border-green-300 text-green-700 hover:bg-green-100 transition">
            Change Address
        </button>

        <a href=""
            class="text-sm px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 transition">
            Manage Addresses
        </a>
    </div> --}}
</div>
@endif


@if (!$Shipaddress)
<div class="mb-6 rounded-xl border border-yellow-200 bg-yellow-50 p-4 shadow-sm">
    <div class="flex items-center gap-2">
        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />
        </svg>
        <h3 class="font-semibold text-yellow-700">
            No Default Address Set
        </h3>
    </div>

    <p class="mt-2 text-sm text-gray-700">
        Please set a default delivery address to continue with checkout.
    </p>

    <div class="mt-4">
        <a href="{{ route('customer.adress')}}"
            class="inline-flex items-center gap-2 text-sm px-4 py-2 rounded-lg bg-yellow-600 text-white hover:bg-yellow-700 transition">
            + Add Default Address
        </a>
    </div>
</div>
@endif








        <hr class="border-gray-300" />

        <div class="text-gray-500 mt-4 space-y-2">


            <p class="flex justify-between">
                <span>Subtotal</span><span>₱{{ $totalInclusive }}</span>
            </p>
            <p class="flex justify-between">
                <span>Shipping Fee</span><span class="text-green-600">Free</span>
            </p>
            <p class="flex justify-between">
                <span>VAT - Inclusive (12%)</span><span>({{ config('cart.tax') }}%):</strong> ₱{{ number_format($totalVat, 2) }} </span>
            </p>


             <p class="flex justify-between">
                   <span>Vatable Sales:</span> <span> ₱{{ number_format($totalVatable, 2) }}</span>
                </p>

            <p class="flex justify-between text-lg font-medium mt-3">
                    <span>Total </span> ₱{{ number_format($totalInclusive, 2) }}
            </p>



                <button
                type="submit"
                onclick="this.disabled=true; this.innerText='Ordering...'; this.form.submit();"
                class="w-full py-3 mt-6 flex items-center justify-center gap-2 cursor-pointer bg-indigo-500 text-white font-medium hover:bg-indigo-600 transition rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c-1.105 0-2 .895-2 2v3a2 2 0 104 0v-3c0-1.105-.895-2-2-2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 11V7a5 5 0 10-10 0v4h10z" />
                </svg>
                Place Order
                </button>



            <a href="{{ route(('cart.show'))}}"
            type="submit"
            class="w-full py-3 mt-6 flex items-center justify-center gap-2 cursor-pointer bg-gradient-to-r from-[#303034] via-[#353a41] to-[#292d31] text-white font-medium hover:bg-indigo-600 transition rounded-lg"
            >
            <!-- Lock Icon (Heroicons or Lucide) -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c-1.105 0-2 .895-2 2v3a2 2 0 104 0v-3c0-1.105-.895-2-2-2z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 11V7a5 5 0 10-10 0v4h10z" />
            </svg>
            Back to cart
        </a>


    </form>

    </div>
</div>






<!-- Address Modal -->
{{-- <div id="addressModal"

     class="fixed inset-0 hidden z-50 flex items-center justify-center">
  
  <!-- Backdrop -->
  <div class="absolute inset-0 bg-black/50"
       onclick="document.getElementById('addressModal').classList.add('hidden')"></div>

  <!-- Modal panel -->
  <div class="relative bg-white rounded-lg shadow-lg max-w-md w-full p-6 z-10">
    <h3 class="text-lg font-semibold mb-4">Change Shipping Address</h3>

    <!-- Form -->




    <form method="POST" action="{{ route('cart.updateAddress') }}" class="space-y-3">
    @csrf

            <!-- Select from saved addresses -->
            <label class="block text-sm font-medium">Choose saved address</label>
            <select name="saved_address" class="w-full border rounded p-2">
                <option value="">-- Select --</option>




                    @foreach($Shipaddress as $address)
                        <option value="{{ $address->id }}">{{ $address->full_address }}</option>
                    @endforeach
                
            </select>

    <div class="text-center text-gray-500">OR</div>

    <!-- Enter new address -->
    <label class="block text-sm font-medium">New Address</label>
    <textarea name="new_address" class="w-full border rounded p-2" rows="3"></textarea>

    <!-- Checkbox: save permanently -->
    <div class="flex items-center space-x-2">
        <input type="checkbox" name="save_to_profile" id="save_to_profile" value="1">
        <label for="save_to_profile" class="text-sm">Save this address to my profile</label>
    </div>

    <div class="flex justify-end space-x-2">
        <button type="button" onclick="document.getElementById('addressModal').classList.add('hidden')"
                class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">
            Cancel
        </button>
        <button type="submit" class="px-3 py-1 rounded bg-violet-600 text-white hover:bg-violet-700">
           Submit
        </button>
    </div>
</form>


  </div>




</div> --}}





    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>






@if(Session::has('message'))
<div id="toast"
    class="fixed top-5 right-2 max-w-md w-[90%] sm:w-auto bg-white text-gray-900 rounded-2xl shadow-2xl 
           border border-gray-200 p-4 flex items-center gap-3 animate-toast-in"  style="z-index: 9999;">


    <!-- Icon -->
    @if(Session::get('alert-type') === 'success')
        <div class="flex-shrink-0 bg-green-100 p-2 rounded-full">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>
    @elseif(Session::get('alert-type') === 'error')
        <div class="flex-shrink-0 bg-red-100 p-2 rounded-full">
            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
    @elseif(Session::get('alert-type') === 'warning')
        <div class="flex-shrink-0 bg-yellow-100 p-2 rounded-full">
            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M5.07 19h13.86L12 5 5.07 19z" />
            </svg>
        </div>
    @else
        <div class="flex-shrink-0 bg-blue-100 p-2 rounded-full">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20h.01" />
            </svg>
        </div>
    @endif

    
    <!-- Message -->
    <p class="text-sm sm:text-base font-medium flex-1">
        {{ Session::get('message') }}
    </p>

    <!-- Close button -->
    <button onclick="hideToast()" class="text-gray-400 hover:text-gray-600">
        ✕
    </button>




<script>
    setTimeout(() => {
        document.getElementById('toast').classList.add('hidden');
    }, 3000);
</script>

<style>
    @keyframes slide-in {
        0% { transform: translateX(100%); opacity: 0; }
        100% { transform: translateX(0); opacity: 1; }
    }
    .animate-slide-in {
        animation: slide-in 0.3s ease-out;
    }
</style>
@endif






<script>
            @if(Session::has('message'))
            var type = "{{ Session::get('alert-type','info') }}"
            switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
            }
            @endif
            </script>


            <script>
                const form = document.querySelector('myForm');
                const btn = document.getElementById('placeOrderBtn');

                form.addEventListener('submit', function () {
                    btn.disabled = true;
                    btn.innerText = 'Ordering...';
                });
                </script>


                
            </body>
</html>



