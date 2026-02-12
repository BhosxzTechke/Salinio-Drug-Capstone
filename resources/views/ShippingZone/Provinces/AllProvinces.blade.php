
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
                                            

                                            <a href="{{ route('provinces.create')}}"><button type="button" class="btn btn-success rounded-pill waves-effect waves-light">Add Provinces</button></a>
                            
                            </ol>

                                    </div>
                                    <h4 class="page-title">Provinces</h4>
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
                                                    <th>Province Name</th>
                                                    <th>Is Active</th>
                                                    <th>Action</th>
                                                </tr>

                                        </thead>
                                        
                                            <tbody>

                                            @php $sl = 1 @endphp
                                            @foreach ($provinces as $data)
                                                <tr>
                                                    <td>{{ $sl++ }}</td>
                                                    <td>{{ $data->name ?? '' }}</td>
                                                    <td>{{ $data->is_active ? 'Active' : 'Not Active' }}</td>
                                                    <td>
                                                        <a href="{{ route('provinces.edit', $data->id) }}" class="btn btn-success rounded-pill waves-effect waves-light"><i class="fa-solid fa-square-pen"></i> Edit</a>

                                                            <form action="{{ route('provinces.destroy', $data->id) }}" 
                                                                method="POST" 
                                                                class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-sm btn-danger rounded-pill waves-effect waves-light"
                                                                        onclick="return confirm('Delete this province?')">
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
