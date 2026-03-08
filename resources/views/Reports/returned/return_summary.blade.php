
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

@endsection