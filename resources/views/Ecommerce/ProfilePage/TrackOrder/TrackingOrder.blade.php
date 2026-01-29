@extends('Ecommerce.Layout.ecommerce')

@section('content')


@php
    $steps = [
        'ready_for_shipment',
        'picked_up',
        'out_for_delivery',
        'delivered'
    ];

    $shipment = $order->shipments->first();
    $currentIndex = $shipment
        ? array_search($shipment->delivery_status, $steps)
        : null;
@endphp



{{-- 
        // $shipment = $data->shipments->first(); // get first shipment if exists
        // $tracking_number = $shipment->tracking_number ?? null;
        // $delivery_status = $shipment->delivery_status ?? $data->delivery_status;



    /// hahanpin niya yung mga name nato sa database  like ready for shipment then gagawin niyang array sa logic nato   

            /// ready_for_shipment → 0

            /// picked_up → 1

            /// out_for_delivery → 2

            /// delivered → 3 --}}

<div class="min-h-screen bg-gray-100 py-6 px-3">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6">

        <h2 class="text-lg font-semibold mb-4">Order Tracking</h2>

        <div class="relative">
            <div class="absolute left-4 top-0 h-full w-0.5 bg-gray-300"></div>


            {{-- Ready for Shipment --}}
            

            {{-- so bali ung galing sa DB and from the hardcode array if db 0 > 2 hardcode -- then ung current muna}}
            
            {{-- so 0,1,2,3,4  value -- ready for shipment ... --}}
            @foreach($steps as $i => $step)
                <div class="flex items-start mb-8">
                    <div class="relative z-10">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center
                            {{ $currentIndex > $i
                                ? 'bg-green-500 text-white'
                                : ($currentIndex === $i    
                                    ? 'bg-green-500 text-white animate-pulse'
                                    : 'bg-gray-700 text-gray-300') }}">
                            @if($step === 'ready_for_shipment') 📦
                            @elseif($step === 'picked_up') 🚚
                            @elseif($step === 'out_for_delivery') 📍
                            @else 🏠
                            @endif
                        </div>
                    </div>

                    <div class="ml-4">
                        <p class="font-medium
                            {{ $currentIndex >= $i ? 'text-black' : 'text-gray-500' }}">
                            {{ ucwords(str_replace('_', ' ', $step)) }}
                        </p>

                        <p class="text-xs text-gray-500">
                            @switch($step)
                                @case('ready_for_shipment') Packed and waiting for pickup @break
                                @case('picked_up') Courier has the parcel @break
                                @case('out_for_delivery') Courier is on the way @break
                                @case('delivered') Package received @break
                            @endswitch
                        </p>
                    </div>
                </div>
            @endforeach






        </div>
    </div>
</div>

@endsection
