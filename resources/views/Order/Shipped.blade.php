@extends('admin_dashboard')
@section('admin')


                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                        </ol>

                                    </div>
                                    <h4 class="page-title">Shipped Order Table</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 



                        
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">


                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>

                                    <tr>
                                        <th>SL</th>
                                        <th>Invoice</th>
                                        <th>Customer Name</th>
                                        <th>Payment</th>
                                        <th>Order Status</th>
                                        <th>Tracking Number</th>
                                        <th>Delivery Status</th>
                                        <th>Action</th> 
                                    </tr>


                    </thead>
                    
                    
    <tbody>
        {{-- Order table Fillable --}}
    @php $sl = 1 @endphp
        @foreach ($Orders as $data)

            @php
        $shipment = $data->shipments->first(); // get first shipment if exists
        $tracking_number = $shipment->tracking_number ?? null;
        $delivery_status = $shipment->delivery_status ?? $data->delivery_status;
            @endphp




        <tr>
            <td>{{ $sl++ }}</td>
            <td>{{ $data->invoice_no }}</td>
            <td>{{ $data->customer->name ?? '' }}</td>
            <td>{{ $data->payment_status }}</td>
            <td><span class="badge bg-danger"> {{ $data->order_status }}</span></td>


            {{-- Without Reloading the page --}}
            <td class="tracking" data-order-id="{{ $data->id }}">
                <span class="badge bg-danger"> {{ $tracking_number ?? '—' }} </span>
            </td>


            <td class="delivery-status" data-order-id="{{ $data->id }}">
                <span class="badge bg-danger"> {{ $delivery_status }} </span>
            </td>
                <td class="action-cell" data-order-id="{{ $data->id }}"
                    data-courier="{{ $data->courier }}"
                    data-complete-url="{{ route('complete.order.details', $data->id) }}">

                        @if($delivery_status === 'delivered' && in_array($data->courier, ['jnt']) && $tracking_number)
                            <a href="{{ route('complete.order.details', $data->id) }}"
                            class="btn btn-sm btn-dark">
                                Complete Order Details
                            </a>

                        @elseif(in_array($data->courier, ['jnt']) && $data->tracking_number)
                            <a href="{{ route('track.shipment.order', $data->id) }}" class="btn btn-sm btn-dark">
                                Tracking Shipment
                            </a>
                        @else
                            <span class="text-gray-600 italic">In Progress</span>
                        @endif

                </td>

                

            
            </tr>
    @endforeach



            </tbody>
                    </table>

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->


       
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- end Footer -->

            </div>



        </div>
        <!-- END wrapper -->







<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
document.addEventListener('DOMContentLoaded', function () {

    function refreshStatuses() {
        document.querySelectorAll('.delivery-status').forEach(el => {
            let orderId = el.dataset.orderId;

            fetch(`/order/${orderId}/shipment-status`)
                .then(res => res.json())
                .then(data => {

                    // Update delivery status text
                    let badge = el.querySelector('span');
                    badge.textContent = data.delivery_status;

                    // Button logic
                    let actionCell = document.querySelector(
                        `.action-cell[data-order-id="${orderId}"]`
                    );

                    if (
                        data.delivery_status === 'delivered' &&
                        actionCell &&
                        actionCell.dataset.courier === 'jnt'
                    ) {
                        // If button doesn't exist yet, add it
                        if (!actionCell.querySelector('a')) {
                            let url = actionCell.dataset.completeUrl;
                            actionCell.innerHTML = `
                                <a href="${url}" class="btn btn-sm btn-dark">
                                    Complete Order Details
                                </a>
                            `;
                        }
                    }
                })
                .catch(console.error);
        });
    }

    refreshStatuses();
    setInterval(refreshStatuses, 3000);
});
</script>







<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    // Mark as Shipped
    $('.mark-shipped').click(function() {
        let id = $(this).data('id');

        Swal.fire({
            title: 'Mark as Shipped?',
            text: 'Are you sure you want to mark this order as shipped?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Ship it!',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("{{ route('orders.ajax.shipped') }}", { id: id }, function(data) {
                    if (data.success) {
                        $('#order-row-' + id).fadeOut();
                        Swal.fire('Success', data.message, 'success');
                    }
                });
            }
        });
    });



    // Cancel Order
    $('.mark-cancelled').click(function() {
        let id = $(this).data('id');

        Swal.fire({
            title: 'Cancel this order?',
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Cancel it!',
            cancelButtonText: 'No, go back'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("{{ route('orders.ajax.cancelled') }}", { id: id }, function(data) {
                    if (data.success) {
                        $('#order-row-' + id).fadeOut();
                        Swal.fire('Cancelled', data.message, 'success');
                    }
                });
            }
        });
    });
});
</script>



@endsection
