<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Purchase Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Confirm Purchase Order</h4>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p><strong>PO #:</strong> {{ $purchase->po_number }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Supplier:</strong> {{ $purchase->supplier->name }}</p>
                    </div>
                </div>

<form method="POST">
    @csrf

    <!-- Option to cancel entire order -->
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="cancel_order" id="cancel_order" onclick="toggleFields(this)">
        <label class="form-check-label text-danger" for="cancel_order">
            Cancel Entire Order
        </label>
    </div>

    <!-- Expected Delivery Date -->
    <div class="mb-3">
        <label class="form-label">Expected Delivery Date</label>
        <input type="date"
            name="expected_delivery_date"
            id="expected_delivery_date"
            class="form-control"
            min="{{ now()->format('Y-m-d') }}"
            required>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>SL</th>
                    <th>Product</th>
                    <th>Quantity Ordered</th>
                    <th>Unit</th>
                    <th>Unit Per Piece</th>
                    <th>Expiration Date</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($purchase->items as $key => $item)
                <tr>
                    <input type="hidden" name="items[{{ $key }}][purchase_order_item_id]" value="{{ $item->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product->product_name }}</td>
                    <td>{{ $item->quantity_ordered }}</td>
                    <td>{{ $item->product->purchase_unit ?? '' }}</td>
                    <td>{{ $item->product->pieces_per_unit ?? '' }}</td>
                    <td>
                        @if ($item->product && $item->product->has_expiration === 1)
                            <input type="date"
                                name="items[{{ $key }}][expiration_date]"
                                class="form-control expiration_date"
                                min="{{ now()->addDays(30)->format('Y-m-d') }}"
                                required>
                        @else
                            <input type="text"
                                class="form-control"
                                value="Non-Expiration Item"
                                readonly>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-success btn-lg">
            Confirm Purchase Order
        </button>
    </div>
</form>

<script>
    function toggleFields(checkbox) {
        // If cancel_order is checked, remove required from inputs
        let requiredFields = document.querySelectorAll('#expected_delivery_date, .expiration_date');
        requiredFields.forEach(function(field) {
            if (checkbox.checked) {
                field.removeAttribute('required');
            } else {
                field.setAttribute('required', true);
            }
        });
    }
</script>



            </div>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
