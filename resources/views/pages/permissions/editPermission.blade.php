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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Add Permission</a></li>
                                            
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Add Permission</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

<div class="row">
    

  <div class="col-lg-8 col-xl-12">
<div class="card">
    <div class="card-body">
                                    
                                      
                                         
                                           

    <!-- end timeline content-->

    <div class="tab-pane" id="settings">
        <form id="myForm" method="post" action="{{ route('permission.update', $permission->id ) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Permission</h5>

            <div class="row">


    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="firstname" class="form-label">Permission Name</label>
            <input type="text" name="name" class="form-control" value="{{ $permission->name }}"   >
           
        </div>
    </div>


                <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="firstname" class="form-label">Group Name </label>


        <select name="group_name" class="form-select" id="example-select"> 
            <option selected disabled>Select Group</option>

            <option value="audit" {{ $permission->group_name == 'audit' ? 'selected' : '' }}>Audit Trail</option>
            <option value="backup" {{ $permission->group_name == 'backup' ? 'selected' : '' }}>Backup</option>
            <option value="brand" {{ $permission->group_name == 'brand' ? 'selected' : '' }}>Brand</option>
            <option value="categories" {{ $permission->group_name == 'categories' ? 'selected' : '' }}>Categories</option>
            <option value="chat-customer" {{ $permission->group_name == 'chat-customer' ? 'selected' : '' }}>Chat Customer</option>
            <option value="commerce" {{ $permission->group_name == 'commerce' ? 'selected' : '' }}>Commerce</option>
            <option value="customer-orders" {{ $permission->group_name == 'customer-orders' ? 'selected' : '' }}>Customer Orders</option>
            <option value="dashboard" {{ $permission->group_name == 'dashboard' ? 'selected' : '' }}>Dashboard</option>
            <option value="expense" {{ $permission->group_name == 'expense' ? 'selected' : '' }}>Expense</option>
            <option value="inventory" {{ $permission->group_name == 'inventory' ? 'selected' : '' }}>Inventory</option>
            <option value="permissions" {{ $permission->group_name == 'permissions' ? 'selected' : '' }}>Permissions</option>
            <option value="point-of-sale" {{ $permission->group_name == 'point-of-sale' ? 'selected' : '' }}>POS</option>
            <option value="products" {{ $permission->group_name == 'products' ? 'selected' : '' }}>Products</option>
            <option value="purchase-orders" {{ $permission->group_name == 'purchase-orders' ? 'selected' : '' }}>Purchase Orders</option>
            <option value="reports" {{ $permission->group_name == 'reports' ? 'selected' : '' }}>Reports</option>
            <option value="returns" {{ $permission->group_name == 'returns' ? 'selected' : '' }}>Return Orders</option>
            <option value="roles" {{ $permission->group_name == 'roles' ? 'selected' : '' }}>Roles</option>
            <option value="sub-category" {{ $permission->group_name == 'sub-category' ? 'selected' : '' }}>Sub-Category</option>
            <option value="suppliers" {{ $permission->group_name == 'suppliers' ? 'selected' : '' }}>Suppliers</option>
            <option value="system-settings" {{ $permission->group_name == 'system-settings' ? 'selected' : '' }}>System Settings</option>
            <option value="user-accounts" {{ $permission->group_name == 'user-accounts' ? 'selected' : '' }}>User Accounts</option>
        </select>
                        


                
        </div>
    </div>




            </div> <!-- end row -->
 
        
            
            <div class="text-end">
                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
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
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                }, 
                group_name: {
                    required : true,
                }, 
                
            },
            messages :{
                name: {
                    required : 'Please Enter Permission Name',
                }, 
                group_name: {
                    required : 'Please Select Group Name',
                },
              

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>

 



@endsection