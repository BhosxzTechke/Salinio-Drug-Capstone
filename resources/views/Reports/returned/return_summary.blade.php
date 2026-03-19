
@extends('admin_dashboard')
@section('admin')

<br>


<div class="row">

<div class="col-md-3">
    <div class="card bg-primary text-white">
        <div class="card-body">
            <h5>Total Returns</h5>
            <h2>{{ $totalReturns }}</h2>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card bg-success text-white">
        <div class="card-body">
            <h5>Refunded</h5>
            <h2>{{ $refunded }}</h2>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card bg-danger text-white">
        <div class="card-body">
            <h5>Rejected</h5>
            <h2>{{ $rejected }}</h2>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card bg-warning text-white">
        <div class="card-body">
            <h5>Pending</h5>
            <h2>{{ $pending }}</h2>
        </div>
    </div>
</div>

</div>

<hr>

<h4>Total Refund Amount: ₱{{ number_format($totalRefundAmount,2) }}</h4>



<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-primary text-white">

            <h4 style="color:rgb(255, 255, 255);"> Return Reports</style></h4>
        </div>
        <div class="card-body">
        <table id="basic-datatable" class="table dt-responsive nowrap w-100"> 
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Return ID</th>
                            <th>Invoice</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Qty Returned</th>
                            <th>Refund Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp

                        @foreach($returns as $return)
                            @foreach($return->order->orderDetails as $item)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>#{{ $return->id }}</td>
                                    <td>{{ $return->order->invoice_no }}</td>
                                    <td>{{ $return->order->customer->name ?? 'Walk-in' }}</td>

                                    <td>{{ $item->product->product_name ?? 'N/A' }}</td>

                                    <td>{{ $item->quantity }}</td>

                                    <td>₱{{ number_format($return->refund_amount, 2) }}</td>

                                    <td>
                                        <span class="badge 
                                            {{ $return->status == 'refunded' ? 'bg-success' : 
                                            ($return->status == 'rejected' ? 'bg-danger' : 'bg-warning') }}">
                                            {{ ucfirst($return->status) }}
                                        </span>
                                    </td>

                                    <td>{{ $return->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>


        </div>
    </div>




</div>




@endsection