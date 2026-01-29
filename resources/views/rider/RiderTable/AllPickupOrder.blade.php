
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

                                    </div>
                                    <h4 class="page-title">Rider Pick Up Table</h4>
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
                                                    <th>Invoice No</th>
                                                    <th>Customer Name</th>
                                                    <th>Address</th>
                                                    <th>Qty</th>
                                                    <th>Payment Method</th>
                                                    <th>Delivery Status</th>
                                                    <th>Product Details</th>
                                                    <th>Action</th>

                                                </tr>

                                        </thead>
                                        
                                        
                                            <tbody>
                                            @php $sl = 1 @endphp
                                            @foreach ($riderOrders as $data) 
                                            <tr id="order-row-{{ $data->id }}">
                                                    <td>{{ $data->invoice_no ?? '' }}</td>
                                                    <td>{{ $data->customer->name ?? '' }}</td>
                                                    <td></td>
                                                    <td>{{ $data->total_products ?? '' }}</td>
                                                    <td>{{ $data->payment_method ?? '' }}</td>
                                                    <td>{{ $data->delivery_status ?? '' }}</td>
                                                    <td><a href="{{route('Product.details.pickUp', $data->id) }}" class="btn btn-success rounded-pill waves-effect waves-light">
                                                        <i class="fa-solid fa-square-pen"></i> Details</a>
                                                                            </td>

                                                    <td>
                                                        {{-- @if(Auth::user()->can('edit-category')) --}}
                                                        <button class="btn btn-sm btn-info mark-delivering" data-id="{{ $data->id }}">Start Delivery</button>

                                                        
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
$(document).ready(function() {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': '{{ csrf_token() }}'
}
});


        // Mark as Shipped
        $('.mark-delivering').click(function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Mark as Out For Delivering?',
                text: 'Are you sure you want to mark this order as Start Delivering?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Mark it!',
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{ route('orders.Delivering') }}", { id: id }, function(data) {
                        if (data.success) {
                            $('#order-row-' + id).fadeOut();
                            Swal.fire('Success', data.message, 'success');
                        }
                    });
                }
            });
        });


});

</script>



@endsection
