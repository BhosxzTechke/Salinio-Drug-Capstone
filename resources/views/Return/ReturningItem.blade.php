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
                                data-bs-target="#returnDetailsModal{{ $data->id }}">
                                View Return Details
                            </button>


                            <!-- Modal -->
    <div class="modal fade"
        id="returnDetailsModal{{ $data->id }}"
        tabindex="-1"
        aria-hidden="true">

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



                    </td>


                    <td class="return-status-cell">

                        <!-- Status display -->
                        {{-- <button type="button" class="btn btn-sm btn-secondary return-status-btn">
                            {{ ucfirst($data->shipment_status ?? 'In Progress') }}
                        </button> --}}

                        <span class="badge badge-pill bg-warning return-status-btn"> {{ ucfirst($data->shipment_status ?? 'In Progress') }}</span>

                        
                    </td>

{{-- 
                @if($data->returnRequest->status == 'refunded' || $data->returnRequest->status == 'rejected' )

                    <td><span class="badge badge-pill bg-danger"> {{ $data->returnRequest->status ?? '' }}</span></td>

                @else

                    <td class="confirm-pickup-cell" data-return-shipment-id="{{ $data->id }}">
                            <a href="{{route('admin.confirmed.return', $data->returnRequest->id )}} " type="button" class="btn btn-sm btn-success confirm-pickup-btn" style="display: none;">
                                Returned Process
                            </a>
                    </td>

                @endif --}}





        <td class="confirm-pickup-cell" data-return-shipment-id="{{ $data->id }}">
            
            @if($data->returnRequest->status == 'refunded' || $data->returnRequest->status == 'rejected')
                <span class="badge badge-pill bg-danger">{{ $data->returnRequest->status ?? '' }}</span>
            @elseif($data->returnRequest->status == 'received')
                <a href="{{ route('admin.confirmed.return', $data->returnRequest->id) }}" 
                class="btn btn-sm btn-success confirm-pickup-btn">
                Returned Process
                </a>
            @else

            
    <a href="{{ route('admin.return.mark-received',
                $data->returnRequest->id)}}"  class="btn btn-sm btn-dark mark-Confirm-received" onclick="this.disabled=true; this.innerText='Saving...'; this.form.submit();">
                    Confirm Received</a>

                {{-- <a href="{{ route('admin.confirmed.return', $data->returnRequest->id) }}" 
                class="btn btn-sm btn-success confirm-pickup-btn" style="display: none;">
                Returned Process
                </a> --}}
            @endif
        </td>




                
   <tr>






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












{{--  AUTO UPDATE FETCHING  --}}
{{-- <script>
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
</script> --}}







<script>
$(document).ready(function() {

    $('.mark-Confirm-received').click(function(e) {
        e.preventDefault();

        let url = $(this).attr('href');

        Swal.fire({
            title: 'Mark as Received?',
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


{{-- <script>
document.addEventListener('DOMContentLoaded', function () {

    // --- MARK AS RECEIVED BUTTON ---
    document.querySelectorAll('.mark-received-btn').forEach(button => {
        button.addEventListener('click', function(){
            let cell = button.closest('.confirm-pickup-cell');
            let returnShipmentId = cell.dataset.returnShipmentId;

            fetch(`/admin/return/mark-received/${returnShipmentId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: 'received' })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    // Hide the "Mark as Received" button
                    button.style.display = 'none';

                    // Show "Returned Process"
                    let returnedBtn = cell.querySelector('.confirm-pickup-btn');
                    if(returnedBtn) returnedBtn.style.display = 'inline-block';
                } else {
                    alert('Failed to mark as received');
                }
            })
            .catch(err => console.error('Error:', err));
        });
    });

    // --- AUTO REFRESH STATUS ---
    function refreshStatuses() {
        document.querySelectorAll('.return-status-cell').forEach(el => {
            let id = el.dataset.returnShipmentId;
            let url = `/return-shipment/${id}/status`;

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    let status = (data.shipment_status ?? 'unknown').toLowerCase();

                    // Update status badge or text
                    let statusBtn = el.querySelector('.return-status-btn');
                    if(statusBtn) statusBtn.textContent = status.charAt(0).toUpperCase() + status.slice(1);

                    // Update buttons
                    let cell = document.querySelector(`.confirm-pickup-cell[data-return-shipment-id="${id}"]`);
                    if(cell){
                        let markReceivedBtn = cell.querySelector('.mark-received-btn');
                        let returnedBtn = cell.querySelector('.confirm-pickup-btn');

                        if(status === 'received'){
                            if(markReceivedBtn) markReceivedBtn.style.display = 'none';
                            if(returnedBtn) returnedBtn.style.display = 'inline-block';
                        } else if(status === 'refunded' || status === 'rejected'){
                            if(markReceivedBtn) markReceivedBtn.style.display = 'none';
                            if(returnedBtn) returnedBtn.style.display = 'none';
                        } else {
                            if(markReceivedBtn) markReceivedBtn.style.display = 'inline-block';
                            if(returnedBtn) returnedBtn.style.display = 'none';
                        }
                    }
                })
                .catch(err => console.error('Status fetch error:', err));
        });
    }

    refreshStatuses();
    setInterval(refreshStatuses, 3000);

});
</script> --}}




@endsection
