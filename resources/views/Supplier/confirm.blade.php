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

                    <div class="mb-3">
                        <label class="form-label">Expected Delivery Date</label>
                        <input type="date"
                            name="expected_delivery_date"
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
                                    <th>Expiration Date</th>
                                </tr>
                            </thead>
            <tbody>
            @foreach ($purchase->items as $key => $item)
                <tr>
                    <input type="hidden"
                        name="items[{{ $key }}][purchase_order_item_id]"
                        value="{{ $item->id }}">

                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product->product_name }}</td>
                    <td>{{ $item->quantity_ordered }}</td>

                    @if ($item->product && $item->product->has_expiration === 1)
                        <td>
                            <input type="date"
                                name="items[{{ $key }}][expiration_date]"
                                class="form-control"
                                min="{{ now()->format('Y-m-d') }}"
                                required>
                        </td>

                                                


                    @else
                        <td>
                            <input type="text"
                                class="form-control"
                                value="Non-Expiration Item"
                                readonly>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>

                        </table>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-check-circle"></i> Confirm Purchase Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
