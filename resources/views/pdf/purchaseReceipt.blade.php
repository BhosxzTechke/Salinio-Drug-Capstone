<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .title { font-size: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="title">
        Purchase Order {{ $purchase->po_number }}
    </div>

    <p>Supplier: {{ $purchase->supplier_name }}</p>
    <p>Date: {{ $purchase->created_at->format('Y-m-d') }}</p>

    <!-- Add your items table here -->



    <div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>SL</th>
                <th>Product</th>
                <th>Quantity Ordered</th>
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


                </tr>
            @endforeach
            </tbody>

                        </table>
                    </div>
                    

</body>
</html>
