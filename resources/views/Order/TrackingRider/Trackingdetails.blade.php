@extends('admin_dashboard')
@section('admin')


<h3>Order #{{ $order->id }}</h3>

@if($trackingInfo)
    <h4>Tracking Status:</h4>
    <p>Status: {{ $trackingInfo['data']['tracking']['tag'] ?? 'Unknown' }}</p>
    <p>Last update: {{ $trackingInfo['data']['tracking']['last_update'] ?? 'N/A' }}</p>

    <h5>Checkpoints:</h5>
    <ul>
        @foreach($trackingInfo['data']['tracking']['checkpoints'] ?? [] as $checkpoint)
            <li>
                {{ $checkpoint['location'] ?? 'Unknown location' }} - 
                {{ $checkpoint['message'] ?? '' }} - 
                {{ $checkpoint['time'] ?? '' }}
            </li>
        @endforeach
    </ul>
@else
    <p>No tracking info available.</p>
@endif



@endsection