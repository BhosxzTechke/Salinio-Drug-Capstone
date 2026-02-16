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
                                    <h4 class="page-title">Orders Table</h4>
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
                                        <th>Order #</th>
                                        <th>Order Source</th>
                                        <th>Name</th>
                                        <th>Order Date</th>
                                        <th>Payment</th>
                                        <th>Invoice</th>
                                        <th>Pay</th>
                                        <th>Status</th>
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



        <tr id="order-row-{{ $data->id }}">
    
            <td>{{ $sl++ }}</td>
            <td>Order#:{{$data->id }}</td>
            <td>{{ $data->order_source }}</td>
            <td>{{ $data->customer->name ?? '' }}</td>
            <td>{{ $data->order_date }}</td>
            <td>{{ $data->payment_status }}</td>
            <td>{{ $data->invoice_no }}</td>
            <td>{{ $data->pay }}</td>
            <td><span class="badge bg-danger"> {{ $data->order_status }}</span></td>





<td>



        {{-- J&T Logic --}}
        @if($data->courier === 'jnt')

            {{-- No tracking number & pending --}}
                @if(!$data->tracking_number && $data->delivery_status === 'pending')

                    <a href="{{ route('confirm.Mark.Order', $data->id)}}"  class="btn btn-sm btn-success mark-Confirm-Order" onclick="this.disabled=true; this.innerText='Saving...'; this.form.submit();"
                        >Confirm Order</a>


                    <a href="{{ route('details', $data->id) }}" class="btn btn-sm btn-secondary">View Details</a>
                    <button class="btn btn-sm btn-danger mark-cancelled-order" data-id="{{ $data->id }}">Cancel</button>



                    {{-- AFTER CONFIRM THE STATUS IS READY FOR SHIPMENT NA SO ELSE IF RUN --}}
                    
                {{-- Ready for shipment (tracking may or may not exist) --}}
                @elseif($data->delivery_status === 'ready_for_shipment')


                    <input type="text"
                        class="form-control form-control-sm mb-1 tracking-input"
                        data-order-id="{{ $data->id }}"
                        placeholder="Enter J&T Tracking Number"
                        value="{{ $tracking_number ?? '' }}">

                    <button class="btn btn-sm btn-outline-primary print-label-btn {{ $tracking_number ? '' : 'd-none' }}"
                            data-order-id="{{ $data->id }}">
                        Print
                    </button>

                    <button class="btn btn-sm btn-outline-warning pickup-btn {{ $tracking_number ? '' : 'd-none' }}"
                        data-order-id="{{ $data->id }}" onclick="this.disabled=true; this.innerText='Saving...'; this.form.submit();">
                        Pickup
                    </button>


                @else
                    <span class="text-muted">Waiting for tracking number</span>
                @endif

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


            </div>



        </div>
        <!-- END wrapper -->






        



<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    function loadShipments() {
        $.getJSON('/shipments/status', function(data) {
            let rows = '';
            data.forEach(function(shipment) {
                rows += `<tr>
                            <td>${shipment.order_id}</td>
                            <td>${shipment.tracking_number}</td>
                            <td>${shipment.delivery_status}</td>
                        </tr>`;
            });
            $('#shipment-table tbody').html(rows);
        });
    }

// Load initially
loadShipments();

// Reload every 5 seconds
setInterval(loadShipments, 5000);
</script>





<script>
        // Print button
    if (e.target.classList.contains('print-label-btn')) {
        const orderId = e.target.dataset.orderId;
        window.open(`/orders/print-label/${orderId}`, '_blank');
    }

</script>



{{-- AJAX script --}}
<script>
document.addEventListener('click', function (e) {
    // Save Tracking AJAX
    if (e.target.classList.contains('save-tracking-btn')) {
        const orderId = e.target.dataset.orderId;
        const input = document.querySelector(`.tracking-input[data-order-id="${orderId}"]`);
        const trackingNumber = input.value.trim();

        if (!trackingNumber) {
            alert('Please enter tracking number');
            return;
        }

        fetch("{{ route('orders.saveTracking') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                order_id: orderId,
                tracking_number: trackingNumber
            })
        })



        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Tracking saved successfully');



                // PAG KA SUCCESS DISABLED SI INPUT AND SAVING TRACKING NUMBER
                input.disabled = true;
                e.target.disabled = true;

                // Show Print & Pickup buttons
                document.querySelector(`.print-label-btn[data-order-id="${orderId}"]`).classList.remove('d-none');
                document.querySelector(`.pickup-btn[data-order-id="${orderId}"]`).classList.remove('d-none');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error saving tracking number');
        });
    }



// Pickup button AJAX
if (e.target.classList.contains('pickup-btn')) {
    const orderId = e.target.dataset.orderId;
    const url = window.location.href; // current page reload

    fetch(`/orders/pickup/${orderId}`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: "Processing...",
                text: "Please wait",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                },
                timer: 500, // optional short wait
                timerProgressBar: true,
            }).then(() => {
                window.location.href = url; // reload page after alert closes
            });
        }
    })
    .catch(err => {
        console.error(err);
        Swal.fire("Error", "Error marking pickup", "error");
    });
}



    // Print button
    if (e.target.classList.contains('print-label-btn')) {
        const orderId = e.target.dataset.orderId;
        window.open(`/orders/print-label/${orderId}`, '_blank');
    }
});


</script>








<script>
$(document).ready(function() {

    $('.mark-Confirm-Order').click(function(e) {
        e.preventDefault();

        let url = $(this).attr('href');

        Swal.fire({
            title: 'Mark as Confirmed?',
            text: 'Are you sure you want to confirm this order?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, confirm it!',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Processing...",
                    text: "Please wait",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });

                setTimeout(() => {
                    window.location.href = url; // ✅ FIXED
                }, 300);
            }


        });
    });

});
</script>






    {{-- CONFIRM PICK UP --}}

<script>
$(document).ready(function() {

    $('.mark-Confirm-Pickup').click(function(e) {
        e.preventDefault();

        let url = $(this).attr('href');

        Swal.fire({
            title: 'Mark as Confirmed Pickup?',
            text: 'Are you sure you want to confirm to Pickup this?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Pickup it!',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Processing...",
                    text: "Please wait",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });

                setTimeout(() => {
                    window.location.href = url; // ✅ FIXED
                }, 300);
            }
        });
    });

});
</script>





<script>
$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    $(document).on('click', '.mark-cancelled-order', function(e) {
        e.preventDefault();

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
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }

                }).fail(function() {
                    Swal.fire('Error', 'Unauthorized or session expired', 'error');
                });

            }
        });

    });

});
</script>




@endsection
