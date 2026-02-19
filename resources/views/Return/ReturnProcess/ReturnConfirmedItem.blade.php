@extends('admin_dashboard')
@section('admin')
{{-- admin/returns/action.blade.php --}}

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            Return Action
        </div>

        <div class="card-body">
            <p>
                <strong>Order #:</strong> {{ $requestData->order->id ?? '' }} <br>
                <strong>PayPal TXN:</strong> {{ $requestData->order->paypal_order_id ?? '' }} <br>
                <strong>Paid Amount:</strong> ₱{{ $requestData->order->total ?? '' }} <br>
                <strong>Customer Payment Method:</strong> {{ $requestData->order->payment_method == 'cod' ? 'Cash On Delivery' : 'PayPal' }}


            </p>

            <form method="POST" action="{{ route('admin.handle.return', $requestData->id )}}">
                @csrf
                <input type="hidden" name="order_id" value="{{ $requestData->order->id }}">


                <input type="hidden" name="invoice_id" value="{{ $requestData->order->invoice_no ?? ''}}">


                {{-- Action Selector --}}
                <div class="mb-3">
                    <label class="form-label">Return Decision</label>
                    <select class="form-select" name="action" id="returnAction" required>
                        <option value="">Select action</option>
                        <option value="refund">Refund</option>
                        <option value="reject">Reject Return</option>
                    </select>
                </div>

                {{-- Refund Fields --}}
                <div id="refundFields" class="border rounded p-3 mb-3 d-none">
                    <h6 class="text-success">Refund Details</h6>

                        <div class="mb-3">
                            <label class="form-label">Refund Amount</label>
                            <input type="number"
                                class="form-control"
                                name="refund_amount"
                                step="0.01"
                                max="{{ $requestData->order->total ?? '' }}">
                        </div>

                    <div class="mb-3">
                        <label class="form-label">Refund Reason</label>
                        <select class="form-select" name="refund_reason">
                            <option value="ITEM_RETURNED">Item Returned</option>
                        </select>
                    </div>
                </div>

                    {{-- Reject Fields --}}
                    <div id="rejectFields" class="border rounded p-3 mb-3 d-none">
                        <h6 class="text-danger">Rejection Details</h6>

                        <div class="mb-3">
                            <label class="form-label">Rejection Reason</label>
                            <textarea class="form-control"
                                    name="reject_reason"
                                    rows="3"></textarea>
                        </div>
                    </div>

                <button class="btn btn-primary w-100">
                    Submit Decision
                </button>
            </form>
        </div>
    </div>
</div>



{{-- Toggle Script --}}
<script>
document.getElementById('returnAction').addEventListener('change', function () {
    const refundFields = document.getElementById('refundFields');
    const rejectFields = document.getElementById('rejectFields');

    refundFields.classList.add('d-none');
    rejectFields.classList.add('d-none');

    if (this.value === 'refund') {
        refundFields.classList.remove('d-none');
    }

    if (this.value === 'reject') {
        rejectFields.classList.remove('d-none');
    }
});
</script>




@endsection