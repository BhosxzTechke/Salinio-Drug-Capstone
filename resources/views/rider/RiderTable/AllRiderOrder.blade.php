
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
                                                        <button type="button" class="btn btn-sm btn-info mark-Pickup" data-id="{{ $data->id }}">Pickup</button>

                                                        
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
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    // Mark as Pickup (mobile-safe)
    $(document).on('click touchstart', '.mark-Pickup', function (e) {
        e.preventDefault(); // ⬅️ CRITICAL

        let id = $(this).data('id');

        Swal.fire({
            title: 'Mark as Pickup?',
            text: 'Are you sure you want to mark this order as shipped?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Pickup it!',
            cancelButtonText: 'No, cancel',
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("{{ route('orders.pickUp') }}", { id: id }, function (data) {
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






            <script>
            $(document).ready(function () {
                $('#MyForm').validate({
                    rules: {
                        category: {
                            required: true,
                            maxlength: 100
                        },

                    },
                    messages: {
                        category: {
                            required: "Please enter a Category name",
                            maxlength: "Category name cannot be more than 100 characters"
                        },

                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function (element) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element) {
                        $(element).removeClass('is-invalid');
                    }
                });
            });
            </script>



@endsection
