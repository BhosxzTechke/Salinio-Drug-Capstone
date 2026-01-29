@extends('Ecommerce.Layout.ecommerce')

@section('content')







<div class="max-w-7xl mx-auto px-4 py-8">
  <h2 class="text-2xl font-bold mb-6">My Wishlist</h2>





  <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">





@php
  $WishlistCart = Cart::instance('wishlist')->content();
@endphp

@foreach($WishlistCart as $item)

<div class="card bg-white shadow-lg rounded-lg overflow-hidden flex flex-col">

  <!-- Product Image -->
  <img
    src="{{ asset($item->options->image) }}"
    alt="{{ $item->name }}"
    class="w-full h-48 object-cover"
  >

  <!-- Product Info -->
  <div class="p-4 flex flex-col flex-1">

    <h3 class="text-lg font-semibold mb-1">
      {{ $item->name }}
    </h3>

    <!-- Price & Stock -->
    <div class="flex items-center space-x-2 mb-2">
      <span class="text-violet-600 font-bold">
        ₱{{ number_format($item->price, 2) }}
      </span>
      <span class="badge badge-success ml-auto">In Stock</span>
    </div>

    <!-- Rating (UI only) -->
    <div class="flex items-center space-x-2 mb-3">
      <div class="rating rating-sm">
        <input type="radio" class="mask mask-star-2 bg-yellow-400" checked />
        <input type="radio" class="mask mask-star-2 bg-yellow-400" />
        <input type="radio" class="mask mask-star-2 bg-yellow-400" />
        <input type="radio" class="mask mask-star-2 bg-yellow-400" />
        <input type="radio" class="mask mask-star-2 bg-yellow-400" />
      </div>
      <span class="text-gray-500 text-sm">(58)</span>
    </div>

    <!-- Buttons -->
    <div class="mt-auto flex space-x-2">

      <!-- PRODUCT DETAILS (LINK ONLY) -->
      <a
        href="{{ route('product.show', $item->options->product_id) }}"
        class="btn btn-sm flex-1 bg-violet-600 text-white hover:bg-violet-700 text-center"
      >
        Product Details
      </a>

      <!-- REMOVE FROM WISHLIST (FORM ONLY) -->
      <form
        method="POST"
        action="{{ route('removeWishlist', $item->rowId) }}"
      >
        @csrf
        @method('DELETE')

        <button
          type="submit"
          class="btn btn-sm btn-outline btn-error"
        >
          <svg xmlns="http://www.w3.org/2000/svg"
               class="h-5 w-5"
               fill="none"
               viewBox="0 0 24 24"
               stroke="currentColor">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </form>

    </div>
  </div>
</div>

@endforeach



    <!-- End Repeat -->

  </div>


</div>


@endsection