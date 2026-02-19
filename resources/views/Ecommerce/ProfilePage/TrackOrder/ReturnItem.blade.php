@extends('Ecommerce.Layout.ecommerce')

@section('content')
<div class="tracking-order-container py-8 bg-white min-h-screen">
    <div class="max-w-3xl mx-auto px-4">

        @php
        $exists = !empty($order->id) && App\Models\ReturnRequest::where('order_id', $order->id)->exists();
        @endphp

        @if($exists)

        <div class="card shadow-sm rounded-lg p-6 bg-white border border-gray-200">
            <h2 class="text-2xl font-semibold mb-4 text-gray-900">Return Request Status</h2>
            @php
                $returnRequest = App\Models\ReturnRequest::where('order_id', $order->id)->first();
            @endphp
            <p class="text-gray-700 mb-2"><strong>Order ID:</strong> {{ $order->id }}</p>
            <p class="text-gray-700 mb-2"><strong>Reason:</strong> {{ $returnRequest->reason }}</p>
            <p class="text-gray-700 mb-3"><strong>Description:</strong> {{ $returnRequest->description }}</p>
            <p class="text-gray-700 mb-3"><strong>Tracking Number:</strong> {{ $returnRequest->shipment->tracking_number ?? '' }}</p>

            <p class="mb-4">
                <strong>Status:</strong>
            @php
                $status = $returnRequest->shipment->shipment_status ?? 'pending';
                $statusColors = [
                    'ready_for_pickup' => 'bg-gray-100 text-gray-800',
                    'picked_up' => 'bg-gray-100 text-gray-800',
                    'in_transit' => 'bg-gray-100 text-gray-800',
                    'delivered' => 'bg-gray-100 text-gray-800',
                ];
                $colorClass = $statusColors[strtolower($status)] ?? 'bg-gray-100 text-gray-800';
            @endphp
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $colorClass }}">
                @if($status == 'delivered') 
                {{ ucfirst($status) }} - Return Success
                @else 
                {{ ucfirst($status) }}
                @endif
            </span>
            </p>

            @if ($returnRequest->status == 'approved')
                <p class="text-gray-700 font-medium mb-4">Please pack the item securely.</p>
                <form method="POST" action="{{ route('hand.to.courier', $returnRequest->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success customer-ready-pickup">
                        Hand to Courier
                    </button>
                </form>
            @endif



            @if($returnRequest->images)
                <div class="mt-6">
                    <p class="text-gray-700 font-medium mb-3">Uploaded Images:</p>
                    <div class="flex gap-3">
                        @foreach($returnRequest->images as $image)
                            <img src="{{ asset('storage/' . $image) }}" class="w-20 h-20 object-cover rounded border border-gray-200">
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        @else







        <div class="card shadow-sm rounded-lg overflow-hidden border border-gray-200">
            <div class="card-header bg-white border-b border-gray-200 p-6">
                <h3 class="text-2xl font-semibold text-gray-900">Return Order Request</h3>
                <p class="text-gray-600 text-sm mt-2">You can request a return within 7 days of delivery.</p>
            </div>
            <div class="card-body p-6 bg-white">
                @if($order->canBeReturned())
                    <form action="{{ route('store.return.requests')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-5">
                            <label class="block font-medium text-gray-800 mb-2">Order ID</label>
                            <input type="text" class="form-control" value="{{ $order->id }}" disabled>
                        </div>

                        <input type="hidden" name="order_id" value="{{ $order->id }}">

                        <div class="mb-5">
                            <label class="block font-medium text-gray-800 mb-2" for="reason">Reason for Return</label>
                            <select name="reason" id="reason" class="form-control" required>
                                <option value="">Select a reason</option>
                                <option value="defective">Defective Product</option>
                                <option value="wrong_item">Wrong Item Received</option>
                                <option value="not_as_described">Not As Described</option>
                                <option value="changed_mind">Changed Mind</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="mb-5">
                            <label class="block font-medium text-gray-800 mb-2" for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Explain the issue" required></textarea>
                        </div>

                        <div class="mb-5">
                            <label class="block font-medium text-gray-800 mb-2" for="quantity">Quantity to Return</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" min="1" max="{{ $order->total_products }}" value="1" required>
                            <small class="text-gray-500">Maximum: {{ $order->quantity }}</small>
                        </div>

                        <div class="mb-5">
                            <label class="block font-medium text-gray-800 mb-2" for="images">Upload Photos (optional)</label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*">
                            <small class="text-gray-500">Attach images if product is defective or damaged.</small>
                        </div>

                        <div class="flex justify-end gap-3 mt-8">
                            <a href="{{ route('customer.profile') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit Return Request</button>
                        </div>
                    </form>
                @else
                    <div class="text-center p-8">
                        <p class="text-gray-700 mb-2 text-lg">This order cannot be returned.</p>
                        <p class="text-gray-600 text-sm mb-6">Return requests are allowed within 7 days of delivery.</p>
                        <a href="{{ route('customer.profile') }}" class="btn btn-success">Back to Order Details</a>
                    </div>
                @endif
            </div>
        </div>

        @endif
    </div>
</div>






<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>
$(document).ready(function() {
    $('.customer-ready-pickup').click(function(e) {
        e.preventDefault();  // stop immediate submit
        let form = $(this).closest('form'); // find the form

        Swal.fire({
            title: 'Mark as Confirmed Pickup?',
            text: 'Are you sure you want to confirm this?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Pickup it!',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Processing...",
                    text: "Please wait",
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading(),
                });

                setTimeout(() => {
                    form.submit();  // ✅ submit POST
                }, 300);
            }
        });
    });
});
</script>



<style>
    .tracking-order-container .card {
        border: 1px solid #e2e8f0;
    }
    .form-control {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #cbd5e0;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        transition: border-color 0.2s;
    }
    .form-control:focus {
        border-color: #3182ce;
        outline: none;
    }
    .btn {
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        cursor: pointer;
    }
    .btn-success {
        background-color: #38a169;
        color: white;
    }
    .btn-success:hover {
        background-color: #2f855a;
    }
    .btn-secondary {
        background-color: #a0aec0;
        color: white;
    }
    .btn-secondary:hover {
        background-color: #718096;
    }
</style>
@endsection
