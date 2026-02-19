<!DOCTYPE html>
<html>
<head>
    <title>Return Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        h2 {
            color: #2a7ae2;
        }
        p {
            margin: 0.5em 0;
        }
        .footer {
            margin-top: 2em;
            font-size: 0.9em;
            color: #555;
        }
        .highlight {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Hello {{ $returnData->customer_name }},</h2>

    @if($status === 'refunded')
        <p>Your return for order <span class="highlight">#{{ $returnData->order->id }}</span> has been <span class="highlight">approved</span>.</p>

        @if($returnData->order->payment_method === 'paypal')
            <p>The refund of PHP <span class="highlight">{{ $returnData->order->total }}</span> has been processed to your PayPal account.</p>
        @elseif($returnData->order->payment_method === 'cod')
            <p>As this order was paid via COD, please contact us at <span class="highlight">+63-951-7372530</span> to arrange your refund</p>
        @endif


    @elseif($status === 'rejected')
        <p>Your return for order <span class="highlight">#{{ $returnData->order->id }}</span> has been <span class="highlight">rejected</span>.</p>
        <p>Reason: {{ $returnData->description }}</p>
    @endif

    <p>We apologize for any inconvenience and appreciate your understanding.</p>

    <div class="footer">
        <p>Thank you,</p>
        <p><strong>Salinio Drug Pharmacy</strong></p>
        <p>Customer Support: +63-951-7372530</p>
    </div>
</body>
</html>
