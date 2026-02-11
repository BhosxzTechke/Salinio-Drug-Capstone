<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4">Purchase Order Created</h2>
            
            <p class="card-text">
                Purchase Order <strong>{{ $purchase->po_number }}</strong> has been created.
            </p>
            
            <p class="card-text">
                Please confirm the product expiration and expected delivery date.
            </p>
            
            <div class="mt-4">
                <a href="{{ $confirmationUrl }}" class="btn btn-primary btn-lg">
                    Confirm Product & Delivery
                </a>
            </div>

            
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>