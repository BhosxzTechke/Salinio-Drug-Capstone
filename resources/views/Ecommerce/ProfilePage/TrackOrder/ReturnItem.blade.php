@extends('Ecommerce.Layout.ecommerce')

@section('content')
<div class="tracking-order-container py-6 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto">
        <div class="card shadow-md rounded-lg overflow-hidden">
            <div class="card-header bg-primary text-white p-4">
                <h3 class="mb-0 text-lg font-semibold">Return Order Request</h3>
                <p class="text-sm mt-1">You can request a return within 7 days of delivery.</p>
            </div>
            <div class="card-body p-6 bg-white">
                @if($order->canBeReturned())
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Order Info -->
                        <div class="mb-4">
                            <label class="block font-medium text-gray-700">Order ID</label>
                            <input type="text" class="form-control" value="{{ $order->id }}" disabled>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700" for="reason">Reason for Return</label>
                            <select name="reason" id="reason" class="form-control" required>
                                <option value="">Select a reason</option>
                                <option value="defective">Defective Product</option>
                                <option value="wrong_item">Wrong Item Received</option>
                                <option value="not_as_described">Not As Described</option>
                                <option value="changed_mind">Changed Mind</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700" for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Explain the issue" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700" for="quantity">Quantity to Return</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" min="1" max="{{ $order->total_products }}" value="1" required>
                            <small class="text-gray-500">Maximum: {{ $order->quantity }}</small>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700" for="images">Upload Photos (optional)</label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*">
                            <small class="text-gray-500">Attach images if product is defective or damaged.</small>
                        </div>

                        <div class="flex justify-end gap-2 mt-6">
                            <a href="{{ route('customer.profile') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit Return Request</button>
                        </div>
                    </form>
                @else
                    <div class="text-center p-6">
                        <p class="text-gray-600 mb-3">This order cannot be returned.</p>
                        <p class="text-gray-500 text-sm">Return requests are allowed within 7 days of delivery.</p>
                        <a href="{{ route('customer.profile') }}" class="btn btn-primary mt-3">Back to Order Details</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

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
