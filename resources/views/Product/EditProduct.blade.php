
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
                                            <li class="breadcrumb-item active">Product</li>
                                        </ol>
                                    </div>
                                    
                                    <h4 class="page-title">Edit Profile</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->


  <div class="row">

                        <div class="col-lg-8 col-xl-12">
                                <div class="card">
                                    <div class="card-body">
    
                                            <div class="tab-pane" id="settings">



<form method="POST" action="{{ route('update.product') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="hidden" name="id" value="{{ $product->id }}">
    <input type="hidden" name="old_image" value="{{ $product->product_image }}">

    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Edit Product</h5>
    <div class="row">

        {{-- Product Name --}}
        <div class="col-md-6 mb-3">
            <label for="product_name">Product Name <span class="text-danger">*</span></label>
            <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror"
                   value="{{ old('product_name', $product->product_name) }}">
            @error('product_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Product Code (readonly) --}}
        <div class="col-md-6 mb-3">
            <label for="product_code">Product Code</label>
            <input type="text" name="product_code" class="form-control"
                   value="{{ old('product_code', $product->product_code) }}" readonly>
        </div>

        {{-- Category --}}
        <div class="col-md-6 mb-3">
            <label for="category_id">Category <span class="text-danger">*</span></label>
            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                <option selected disabled>Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->category_name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Subcategory --}}
        <div class="col-md-6 mb-3">
            <label for="subcategory_id">Subcategory <span class="text-danger">*</span></label>
            <select name="subcategory_id" id="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror">
                <option selected disabled>Select Subcategory</option>
                @foreach($subcategories as $sub)
                    <option value="{{ $sub->id }}" {{ old('subcategory_id', $product->subcategory_id) == $sub->id ? 'selected' : '' }}>
                        {{ $sub->name }}
                    </option>
                @endforeach
            </select>
            @error('subcategory_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Brand --}}
        <div class="col-md-6 mb-3">
            <label for="brand_id">Brand <span class="text-danger">*</span></label>
            <select name="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
            @error('brand_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Dosage Form --}}
        <div class="col-md-6 mb-3">
                <label for="dosage_form">Dosage Form (Optional)</label>
            <select name="dosage_form" class="form-control @error('dosage_form') is-invalid @enderror">
                @php $dosageOptions = ['Tablet','Capsule','Syrup','Cream','Ointment']; @endphp
                @foreach($dosageOptions as $option)
                    <option value="{{ $option }}" {{ old('dosage_form', $product->dosage_form) == $option ? 'selected' : '' }}>
                        {{ $option }}
                    </option>
                @endforeach
            </select>
            @error('dosage_form')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>



                    {{-- Selling Price --}}
            <div class="col-md-6 mb-3">
                <label for="selling_price">Selling Price <span class="text-danger">*</span></label>
                <input type="text" name="selling_price" class="form-control @error('selling_price') is-invalid @enderror"
                    value="{{ old('selling_price', $product->selling_price) }}">
                @error('selling_price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


                    





        {{-- Prescription Required --}}
        <div class="col-md-6 mb-3">
            <label for="prescription_required">Prescription Required <span class="text-danger">*</span></label>
            <select name="prescription_required" class="form-control @error('prescription_required') is-invalid @enderror">
                <option value="0" {{ old('prescription_required', $product->prescription_required) == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ old('prescription_required', $product->prescription_required) == 1 ? 'selected' : '' }}>Yes</option>
            </select>
            @error('prescription_required')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>



                    {{-- Expiration Switch --}}
            <div class="form-check form-switch mb-3">
                <input type="checkbox" class="form-check-input" id="has_expiration" name="has_expiration"
                    value="1" {{ old('has_expiration', $product->has_expiration) == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="has_expiration">Has Expiration</label>
            </div>



            
        {{-- TOGGLE TO OPEN ECOMMERCE PART --}}


        <div class="form-check form-switch mb-4">
            <input class="form-check-input" type="checkbox" id="is_ecommerce" name="is_ecommerce" value="1"
                {{ old('is_ecommerce') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_ecommerce">
                Ecommerce Product
            </label>
        </div>





            {{-- FOR ECOMMERCE PART --}}
        <div id="ecommerce-fields">

            

            {{-- Target Gender --}}
            <div class="col-md-6 mb-3">
                <label for="target_gender">Target Gender <span class="text-danger">*</span></label>
                <select name="target_gender" id="target_gender" class="form-control @error('target_gender') is-invalid @enderror">
                    @php $genderOptions = ['Unisex','Male','Female']; @endphp
                    @foreach($genderOptions as $option)
                        <option value="{{ $option }}" {{ old('target_gender', $product->target_gender) == $option ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
                @error('target_gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Age Group --}}
            <div class="col-md-6 mb-3">
                <label for="age_group">Age Group <span class="text-danger">*</span></label>
                <select name="age_group" id="age_group" class="form-control @error('age_group') is-invalid @enderror">
                    @php $ageOptions = ['All','Kids','Adults','Seniors']; @endphp
                    @foreach($ageOptions as $option)
                        <option value="{{ $option }}" {{ old('age_group', $product->age_group) == $option ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
                @error('age_group')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Health Concern --}}
            <div class="col-md-6 mb-3">
                <label for="health_concern">Health Concern</label>
                <input type="text" id="health_concern" name="health_concern" class="form-control @error('health_concern') is-invalid @enderror"
                    value="{{ old('health_concern', $product->health_concern) }}">
                @error('health_concern')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>



            {{-- Description --}}
            <div class="col-md-12 mb-3">
                <label for="description">Description <span class="text-danger">*</span></label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


        </div>



            {{-- Product Image --}}
            <div class="col-md-6 mb-3">
                <label for="product_image">Product Image </label>
                <input type="file" name="product_image" class="form-control @error('product_image') is-invalid @enderror">
                @error('product_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Current Image --}}
            <div class="col-md-6 mb-3">
                <label>Current Image</label>
                <img src="{{ $product->product_image ? asset($product->product_image) : url('uploads/noimage.png') }}"
                    class="rounded-circle avatar-lg img-thumbnail" alt="product-image">
            </div>

    </div> <!-- end row -->





    <div class="text-end">
                <button type="submit"
                        class="btn btn-dark"
                        onclick="this.disabled=true; this.innerText='Updating...'; this.form.submit();">
                    Update Product
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





                <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const toggle = document.getElementById('is_ecommerce');
                    const ecommerceFields = document.getElementById('ecommerce-fields');
                    const requiredFields = ['target_gender', 'age_group','description'];

                    function toggleEcommerceFields() {
                        if (toggle.checked) {
                            ecommerceFields.style.display = 'block';
                            requiredFields.forEach(id => {
                                document.getElementById(id).setAttribute('required', 'required', 'required');
                            });

                        } else {
                            ecommerceFields.style.display = 'none';
                            requiredFields.forEach(id => {
                                document.getElementById(id).removeAttribute('required');
                            });
                        }
                    }

                    toggleEcommerceFields();
                    toggle.addEventListener('change', toggleEcommerceFields);
                });
</script>




                    <script type="text/javascript">
                        
                        $(document).ready(function(){
                        $('#image').change(function(e){
                            var reader = new FileReader();
                            reader.onload =  function(e){
                            $('#showImage').attr('src',e.target.result);
                            }
                            reader.readAsDataURL(e.target.files['0']);
                        });
                        });

                    </script>
                                


<script type="text/javascript">
$(document).ready(function () {
    $('#myForm').validate({
        rules: {
            product_name: {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            category_id: { required: true },
            subcategory_id: { required: true },
            brand_id: { required: true },
            dosage_form: { required: true },



            //  Ecommerce only
            age_group: {
                required: function () {
                    return $('#is_ecommerce').is(':checked');
                }
            },
            target_gender: {
                required: function () {
                    return $('#is_ecommerce').is(':checked');
                }
            },
            health_concern: {
                required: function () {
                    return $('#is_ecommerce').is(':checked');
                }
            },

            description: {
                required: function () {
                    return $('#is_ecommerce').is(':checked');
                }
            },

            product_image: {
                required: function () {
                    return $('#is_ecommerce').is(':checked');
                }
            },



            prescription_required: { required: true },
            description: {
                required: true,
                minlength: 10
            },
            selling_price: {
                required: true,
                number: true,
                min: 0
            },

        },

        messages: {
            age_group: {
                required: 'Age group is required for ecommerce products'
            },
            target_gender: {
                required: 'Target gender is required for ecommerce products'
            },
            health_concern: {
                required: 'Health concern is required for ecommerce products'
            }
            description: {
                required: 'Description is required for ecommerce products'
            }
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

    // Revalidate when toggle changes
    $('#is_ecommerce').on('change', function () {
        $('#age_group, #target_gender, #health_concern, #description').each(function () {
            $(this).valid();
        });
    });
});
</script>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $('#category_id').on('change', function () {
        var category_id = $(this).val();
        if (category_id) {
            $.ajax({
                url: '/product/edit/' + category_id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#subcategory_id').empty().append('<option selected disabled>Select Subcategory</option>');
                    $.each(data, function (key, value) {
                        $('#subcategory_id').append(
                            '<option value="' + value.id + '">' + value.name + '</option>'
                        );
                    });
                }
            });
        } else {
            $('#subcategory_id').empty().append('<option selected disabled>Select Subcategory</option>');
        }
    });
</script>




@endsection