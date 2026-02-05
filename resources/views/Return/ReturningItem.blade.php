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
                                    <h4 class="page-title">Returning Item Process</h4>
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
                                        <th>Order Id</th>
                                        <th>Customer Name</th>
                                        <th>Quantity</th>
                                        <th>Return Details</th>
                                        <th>Return Shipment Status</th>
                                        <th> Status</th>

                                    </tr>


                    </thead>
                    
                    
    <tbody>



        {{-- Return Shipment table Fillable --}}
    @php $sl = 1 @endphp
    @foreach ($ReturnData as $data)
    


    {{-- Return request id have on table request shipment --}}  
    {{-- @php
        $shipment = $data->shipment->first(); // get first shipment if exists
        $tracking_number = $shipment->tracking_number ?? null;
        $delivery_status = $shipment->shipment_status ?? null;
    @endphp  --}}



                <tr id="order-row-{{ $data->id }}">
            
                    <td>{{ $sl++ }}</td>
                    <td>Order#:{{$data->returnRequest->order_id ?? '' }}</td>
                    <td>{{ $data->returnRequest->order->customer->name ?? '' }}</td>
                    <td>{{ $data->returnRequest->quantity }}</td>

                    <td>
                        {{-- Modal --}}
                            <button 
                                type="button"
                                class="btn btn-outline-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#returnDetailsModal"
                            >
                                View Return Details
                            </button>
                    </td>


                    <td class="return-status-cell"
                        data-return-shipment-id="{{ $data->id }}">

                        <!-- Status display -->
                        {{-- <button type="button" class="btn btn-sm btn-secondary return-status-btn">
                            {{ ucfirst($data->shipment_status ?? 'In Progress') }}
                        </button> --}}

                        <span class="badge badge-pill bg-warning return-status-btn"> {{ ucfirst($data->shipment_status ?? 'In Progress') }}</span>

                        
                    </td>


                @if($data->returnRequest->status == 'refunded' || $data->returnRequest->status == 'rejected' )

                    <td><span class="badge badge-pill bg-danger"> {{ $data->returnRequest->status ?? '' }}</span></td>

                @else

                <td class="confirm-pickup-cell" data-return-shipment-id="{{ $data->id }}">
                        <a href="{{route('admin.confirmed.return', $data->returnRequest->id )}} " type="button" class="btn btn-sm btn-success confirm-pickup-btn" style="display: none;">
                            Returned Process
                        </a>
                </td>

                @endif


                    


                    </tr>




                    {{-- Modal Return Details per  --}}

<div class="modal fade" id="returnDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Return Request Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <strong>Order ID:</strong>
                    <div>{{ $data->returnRequest->order_id ?? ''}}</div>
                </div>

                <div class="mb-3">
                        <strong>Reason:</strong>
                        <div>{{ ucfirst(str_replace('_',' ', $data->returnRequest->reason ?? '')) }}</div>
                    </div>

                <div class="mb-3">
                    <strong>Description:</strong>
                    <div>{{ $data->returnRequest->description ?? '' }}</div>
                </div>

                <div class="mb-3">
                    <strong>Quantity:</strong>
                    <div>{{ $data->returnRequest->quantity ?? '' }}</div>
                </div>

                <div class="mb-3">
                    <strong>Images:</strong>
                    <div class="d-flex gap-2 flex-wrap">
                        @if($data->returnRequest->photos)
                            @foreach($data->returnRequest->photos as $img)
                                <img src="{{ $img }}" class="img-thumbnail" width="120">
                            @endforeach
                        @else
                            <span class="text-muted">No images uploaded</span>
                        @endif
                    </div>
                </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>

        </div>
    </div>
</div>






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




{{-- AJAX script --}}
<script>

    document.addEventListener('click', function(e) {
    if (e.target.classList.contains('approve-btn')) {
        const orderId = e.target.dataset.orderId;
        if (!orderId) return;

        const token = document.querySelector('meta[name="csrf-token"]').content;

        fetch(`/request/approve/${orderId}`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": token,
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Approved!',
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    // Optionally, reload page or remove row
                    // window.location.reload();
                    e.target.closest('tr').remove(); // remove table row
                });
            } else {
                Swal.fire('Error', data.message || 'Something went wrong', 'error');
            }
        })
        .catch(err => {
            console.error(err);
            Swal.fire('Error', 'Failed to approve return', 'error');
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

        
            $('.mark-cancelled-order').click(function() {
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

                    }).fail(function(xhr) {
                        Swal.fire('Error', 'Unauthorized or session expired', 'error');
                    });
                }
            });
            });


    });

</script>









{{--  AUTO UPDATE FETCHING  --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    function refreshStatuses() {
        document.querySelectorAll('.return-status-cell').forEach(el => {
            let id = el.dataset.returnShipmentId;
            let url = `/return-shipment/${id}/status`;

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    let newStatus = data.shipment_status ?? 'unknown';

                    // Update status button text
                    let statusBtn = el.querySelector('.return-status-btn');
                    if (statusBtn) {
                        statusBtn.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
                    }

                    // Show/hide confirm pickup in its own cell
                    let confirmCell = document.querySelector(`.confirm-pickup-cell[data-return-shipment-id="${id}"]`);
                    if (confirmCell) {
                        let confirmBtn = confirmCell.querySelector('.confirm-pickup-btn');
                        if (confirmBtn) {
                            confirmBtn.style.display = (newStatus === 'delivered') ? 'inline-block' : 'none';
                        }

                        else {
                            
                        }
                    }
                })
                .catch(err => console.error("Status fetch error:", err));
        });
    }

    // Run first, then every 3 seconds
    refreshStatuses();
    setInterval(refreshStatuses, 3000);

});
</script>



@endsection
