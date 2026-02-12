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
                                            <li class="breadcrumb-item active">Barangay</li>
                                        </ol>
                                    </div>
                                    
                                    <h4 class="page-title">Add Barangay Form</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->


<div class="row">

                        <div class="col-lg-8 col-xl-12">
                                <div class="card">
                                    <div class="card-body">
    
                                            <div class="tab-pane" id="settings">





{{-- <form method="POST" id="ProvincesForm" action="{{ route('barangays.store') }}" enctype="multipart/form-data">
    @csrf --}}
    <form method="POST" 
        action="{{ isset($barangay) ? route('barangays.update', $barangay->id) : route('barangays.store') }}">
        
        @csrf
        @if(isset($barangay))
            @method('PUT')
        @endif



        <div class="row">



    {{-- Barangay Name --}}
    <div class="form-group mb-3">
        <label for="name">Barangay Name <span class="text-danger">*</span></label>
        <input 
            type="text" 
            name="name"
            id="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $barangay->name ?? '') }}"
        >
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    {{-- City Dropdown --}}
    <div class="form-group mb-3">
        <label for="city_id">City <span class="text-danger">*</span></label>
        <select name="city_id" class="form-control @error('city_id') is-invalid @enderror">
            <option value="">Select City</option>
            @foreach($cities as $city)
                <option value="{{ $city->id }}" 
                    {{ old('city_id', $barangay->city_id ?? '') == $city->id ? 'selected' : '' }}>
                    {{ $city->name }}
                </option>
            @endforeach
        </select>
        @error('city_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    {{-- Extra Fee --}}
    <div class="form-group mb-3">
        <label for="extra_fee">Extra Fee</label>
        <input 
            type="number" 
            step="0.01"
            name="extra_fee"
            id="extra_fee"
            class="form-control @error('extra_fee') is-invalid @enderror"
            value="{{ old('extra_fee', $barangay->extra_fee ?? '') }}"
        >
        @error('extra_fee')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

                {{-- Status --}}
                <div class="form-group mb-3">
                    <label for="is_active">Status <span class="text-danger">*</span></label>
                    <select name="is_active" class="form-control @error('is_active') is-invalid @enderror">
                        <option value="1" {{ old('is_active', $barangay->is_active ?? '') == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('is_active', $barangay->is_active ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('is_active')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark" onclick="this.disabled=true; this.innerText='Saving...'; this.form.submit();">
                    {{ isset($barangay) ? 'Update Barangay' : 'Create Barangay' }}
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