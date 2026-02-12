@extends('admin_dashboard')
@section('admin')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Provinces</li>
                                        </ol>
                                    </div>
                                    
                                    <h4 class="page-title">Add Provinces Form</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->


<div class="row">

                        <div class="col-lg-8 col-xl-12">
                                <div class="card">
                                    <div class="card-body">
    
                                            <div class="tab-pane" id="settings">





<form method="POST" id="ProvincesForm" action="{{ route('provinces.store')}}" enctype="multipart/form-data">
    @csrf




                    <div class="row">
                        {{-- Provinces Name --}}
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="name">Provinces Name <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="name" 
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter Provinces name"
                                    value="{{ old('name') }}"
                                >
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                                    {{-- Status --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="is_active">Status <span class="text-danger">*</span></label>
                                    <select 
                                        name="is_active" 
                                        id="is_active" 
                                        class="form-control @error('is_active') is-invalid @enderror"
                                    >
                                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('is_active')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                    <div class="text-end">

                        <button type="submit"
                                class="btn btn-dark"
                                onclick="this.disabled=true; this.innerText='Saving...'; this.form.submit();">
                            Save Provinces
                        </button>
                    </div>
                </form>









                    </div>
                    <!-- end settings content-->

            </div>
        </div> <!-- end card-->

    </div> <!-- end col -->
</div>
<!-- end row-->

</div> <!-- container -->

</div> <!-- content -->


                <script type="text/javascript">
                
                $(document).ready(function(){
                    $('#image').change(function(e){
                    var reader = new FileReader();
                    reader.onload =  function(e){
                        $('#showImages').attr('src',e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0']);
                    });
                });

                </script>




<script>
$(document).ready(function () {
    $('#ProvincesForm').validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 200
            },
            email: {
                required: true,
                email: true,
                maxlength: 200
            },

        },
        messages: {
            name: {
                required: "Please enter the supplier's name",
                minlength: "Name must be at least 3 characters",
                maxlength: "Name can't be longer than 200 characters"
            },
            email: {
                required: "Please enter an email address",
                email: "Please enter a valid email address",
                maxlength: "Email can't be longer than 200 characters"
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