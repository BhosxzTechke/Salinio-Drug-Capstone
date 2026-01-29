@extends('admin_dashboard')
@section('admin')



    <form action="{{ route('orders.assign.store', $order->id) }}" method="POST">

        @csrf

            <input type="hidden" name="order_id" value="{{ $order->id }}">


        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Rider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="modal_order_id" value="">

                <div class="mb-3">
                    <label class="form-label">Select Rider <span class="text-danger">*</span></label>
                    <select name="rider_id" id="modal_rider_select" class="form-control">
                        <option value="" selected disabled>Select Rider</option>
                        @foreach($Riders as $rider)
                            <option value="{{ $rider->id }}"> {{ $rider->user->name }} - {{ $rider->vehicle_type }}</option>

                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
                    <label class="form-label">Instructions (Optional)</label>
                    <textarea id="modal_instructions" class="form-control" rows="2" placeholder="E.g., Deliver before 5PM"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Assign Rider</button>
            </div>
        </div>


        </form>


        
        
@endsection 