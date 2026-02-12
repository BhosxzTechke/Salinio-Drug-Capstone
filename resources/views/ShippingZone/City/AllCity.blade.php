
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
                                            

                                            <a href="{{ route('cities.create')}}"><button type="button" class="btn btn-success rounded-pill waves-effect waves-light">Add City</button></a>
                            
                            </ol>

                                    </div>
                                    <h4 class="page-title">City</h4>
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
                                        <th>#</th>
                                        <th>Province</th>
                                        <th>Name</th>
                                        <th>Shipping Fee</th>
                                        <th>Delivery Days</th>
                                        <th>Status</th>
                                        <th width="150">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cities as $city)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $city->province->name ?? '-' }}</td>
                                            <td>{{ $city->name }}</td>
                                            <td>{{ $city->shipping_fee ?? 'Default' }}</td>
                                            <td>{{ $city->delivery_days ?? '-' }}</td>
                                            <td>
                                                @if($city->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('cities.edit', $city->id) }}" 
                                                class="btn btn-sm btn-warning">Edit</a>

                                                <form action="{{ route('cities.destroy', $city->id) }}" 
                                                    method="POST" 
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Delete this city?')">
                                                        Delete
                                                    </button>
                                                </form>
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







{{--  MODAL --}}
                    <!-- Save Category  content -->
                    <div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="height: 100vh">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">

                                    <form method="post" id="MyForm" action="{{ route('store.category') }}" class="px-3">
                                        @csrf

                                        <div class="form-group mb-3">
                                            <label for="emailaddress1" class="form-label">Category Name</label>
                                            <input name="category" class="form-control" type="text" id="category" required="">
                                        </div>


                                        

                            <div class="mb-2 text-center">
                                        <button type="submit"
                                                class="btn btn-dark"
                                                onclick="this.disabled=true; this.innerText='Saving...'; this.form.submit();">
                                            Save Category
                                        </button>    
                            </div>

                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->






                        
                    </div> <!-- container -->

                </div> <!-- content -->


            </div>



        </div>
        <!-- END wrapper -->





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
