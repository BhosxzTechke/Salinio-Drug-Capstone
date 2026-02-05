<!DOCTYPE html>
<html>
<head>
    <title>Return Status</title>
</head>
<body>
    <h2>Hello {{ $returnData->customer_name }},</h2>

    @if($status === 'refunded')
        <p>Your return for order #{{ $returnData->order->id }} has been <strong>refunded</strong>.</p>
        <p>Amount refunded: PHP {{ $returnData->order->total }}</p>
    @elseif($status === 'rejected')
        <p>Your return for order #{{ $returnData->order->id }} has been <strong>rejected</strong>.</p>
        <p>Reason: {{ $returnData->description }}</p>
    @endif

    <p>Thank you for shopping with us.</p>
    <p><strong>Your Business Name</strong></p>
</body>
</html>
