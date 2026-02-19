            <div class="left-side-menu">

                <div class="h-100" data-simplebar>

                    <!-- User box -->
                    <div class="user-box text-center">
                        <img src="assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme"
                            class="rounded-circle avatar-md">
                        <div class="dropdown">
                            <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                                data-bs-toggle="dropdown">Bosske</a>
                            <div class="dropdown-menu user-pro-dropdown">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-user me-1"></i>
                                    <span>My Account</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-settings me-1"></i>
                                    <span>Settings</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-lock me-1"></i>
                                    <span>Lock Screen</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-log-out me-1"></i>
                                    <span>Logout</span>
                                </a>

                            </div>
                        </div>
                        <p class="text-muted">Admin Head</p>
                    </div>




                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <li class="menu-title">Main</li>
                


                            

                            {{-- DASHBOARD PART --}}

                            @if(Auth::user()->can('can-access-dashboard')) 

                            <li>
                                <a href="{{ route('admin.dashboard') }}" >
                                    <i class="mdi mdi-view-dashboard-outline"></i>
                                    {{-- <span class="badge bg-success rounded-pill float-end">4</span> --}}
                                    <span> Dashboards </span>
                                </a>

                            </li>
                            @endif




                            
                            {{-- <li>
                                <a href="{{ route('ai.admin.chat') }}" >
                                    <i class="mdi mdi-view-dashboard-outline"></i> --}}
                                    {{-- <span class="badge bg-success rounded-pill float-end"></span> --}}
                                    {{-- <span> Ai Assistant </span>
                                </a>

                            </li> --}}





                                        {{-- MANAGE POS PART --}}

                            @if(Auth::user()->can('can-access-pos')) 
                                <li>
                                    <a href="{{ route('pos') }}" >
                                        <i class="fa-solid fa-cash-register"></i>
                                            <span class="badge bg-pink float-end">Hot</span>
                                        <span> POS </span>
                                    </a>

                                </li>
                            @endif




                                        {{-- MANAGE SUPPLIERS PART --}}

                        @if(Auth::user()->can('can-manage-suppliers')) 
                            <li>    
                                <a href="#sidebarEmail" data-bs-toggle="collapse">
                                    <i class="fa-solid fa-truck-field"></i>
                                    <span> Manage Supplier </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarEmail">
                                    <ul class="nav-second-level">


                                    @if(Auth::user()->can('can-view-all-suppliers')) 
                                        <li>
                                            <a href="{{ route('all.supplier') }}">All Supplier</a>
                                        </li>
                                        @endif

                                        
                                        
                                        @if(Auth::user()->can('can-create-suppliers'))
                                        <li>
                                            <a href="{{ route('supplier.create') }}">Add Supplier</a>
                                        </li>
                                        @endif


                                    </ul>
                                </div>
                            </li>
                    @endif






                                        {{-- MANAGE CATEGORIES PART --}}



                        @if(Auth::user()->can('can-manage-categories'))
                            <li>
                                <a href="#cat" data-bs-toggle="collapse">
                                    <i class="fas fa-store"></i>
                                    <span> Manage Category </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="cat">
                                    <ul class="nav-second-level">
                                        <li><a href="{{ route('category.list') }}">All Category</a></li>
                                    </ul>
                                </div>  
                            </li>
                        @endif




                                {{-- SUB CATEGORIES PART --}}

                        
                    @if(Auth::user()->can('can-manage-sub-categories'))
                        <li>
                            <a href="#sub-Category" data-bs-toggle="collapse">
                                <i class="fas fa-store"></i>
                                <span> Manage Sub-Category </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sub-Category">
                                <ul class="nav-second-level">

                                    @if(Auth::user()->can('can-view-sub-categories'))
                                    <li>
                                        <a href="{{ route('sub-category.list') }}">All Sub-Category
                                        </a>
                                    </li>
                                    @endif


                                    @if(Auth::user()->can('can-create-category'))
                                    <li>
                                        <a href="{{ route('sub-category.create') }}">Add Sub-Category
                                            </a>
                                    </li>
                                    @endif

                                </ul>
                            </div>
                        </li>
                        @endif






                                    {{-- MANAGE BRAND PART --}}


                    @if(Auth::user()->can('can-manage-brand'))
                        <li>
                            <a href="#brands" data-bs-toggle="collapse">
                                <i class="fas fa-store"></i>
                                <span> Manage Brand </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="brands">
                                <ul class="nav-second-level">

                                    @if(Auth::user()->can('can-view-all-brand'))
                                        <li>
                                            <a href="{{ route('brand.list') }}">All Brand</a>
                                        </li>
                                        @endif


                                        @if(Auth::user()->can('can-create-brand'))
                                        <li>
                                            <a href="{{ route('brand.create') }}">Add Brand
                                            </a>
                                        </li>

                                    @endif


                                    
                                </ul>
                            </div>
                        </li>
                        @endif







                        {{-- MANAGE PRODUCT PART INCLUDING PURCHASE ORDER --}}



                    @if(Auth::user()->can('can-manage-products'))

                        <li>
                            <a href="#product" data-bs-toggle="collapse">
                                <i class="mdi mdi-cart-outline"></i>
                                <span> Manage Product </span>
                                <span class="menu-arrow"></span>
                            </a>

                            <div class="collapse" id="product">
                                <ul class="nav-second-level">

                                    @if(Auth::user()->can('can-view-all-products'))
                                        <li>
                                            <a href="{{ route('product.list') }}">All Product
                                            </a>
                                        </li>
                                    @endif



                                    @if(Auth::user()->can('can-create-products'))
                                        <li>
                                            <a href="{{ route('add.product') }}">Add Product
                                            </a>
                                        </li>
                                    @endif



                                    {{-- @if(Auth::user()->can('import-products'))
                                        <li><a href="{{ route('import.product') }}">Import Product</a></li>
                                    @endif --}}





                                        {{-- MANAGE PURCHASE ORDER PART --}}

                        @if(Auth::user()->can('can-manage-purchase-order'))

                        <li>
                                <a href="#purchaseOrder" data-bs-toggle="collapse">
                                    <span> Purchase Order </span>
                                    <span class="menu-arrow"></span>
                                </a>

                                <div class="collapse" id="purchaseOrder">
                                    <ul class="nav-second-level">

                                            <li>
                                                <a href="{{ route('all.purchase.order') }}">All POs</a>
                                            </li>


                                        @if(Auth::user()->can('can-create-pO'))
                                            <li>
                                                <a href="{{ route('purchase.order') }}">Create PO</a>
                                            </li>
                                        @endif


                                        @if(Auth::user()->can('can-received-deliveries'))
                                            <li>
                                                <a href="{{ route('all.pending.order') }}">Received Deliveries
                                                </a>
                                            </li>
                                        @endif


                                            <li>
                                                <a href="{{ route('deliveries.index') }}">All Deliveries
                                                </a>
                                            </li>

                                    </ul>
                                </div>
                        </li>
                    @endif




                </ul>
            </div>
        </li>
        @endif







                            {{--  MANAGE INVENTORY PART --}}

                        @if(Auth::user()->can('can-view-inventory'))
                            <li>
                                <a href="#inventory" data-bs-toggle="collapse">
                                    <i class="mdi mdi-warehouse"></i>
                                    <span> Manage Inventory </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="inventory">
                                    <ul class="nav-second-level">

                                        <li><a href="{{ route('show.inventory') }}">Inventory</a></li>
                                    </ul>
                                </div>
                            </li>
                        @endif





                                        {{-- CUSTOMER ORDER PART --}}

                    @if(Auth::user()->can('can-manage-customer-order'))
                            <li>
                            <a href="#orders" data-bs-toggle="collapse">
                                <i class="mdi mdi-package-variant"></i>
                                <span> Manage Customer Orders </span>
                                <span class="menu-arrow"></span>
                            </a>


                        <div class="collapse" id="orders">
                            <ul class="nav-second-level">

                                <li>
                                    <a href="{{ route('pending.order') }}">Pending Orders</a>
                                </li>


                                <li>
                                    <a href="{{ route('all.ship.order')}}">Shipping Orders</a>
                                </li>


                                <li>
                                    <a href="{{ route('all.cancel.order')}}">Cancel Orders</a>
                                </li>

                                    


                                <li>
                                    <a href="{{ route('complete.order') }}">Complete Orders</a>
                                </li>


                        
                                </ul>
                            </div>
                        </li>
                    @endif






                                    {{-- MANAGE RETURN ORDERS FROM CUSTOMER --}}


                    @if(Auth::user()->can('can-manage-return-orders')) 

                            <li>
                                <a href="#Returnorders" data-bs-toggle="collapse">
                                    <i class="mdi mdi-package-variant"></i>
                                    <span> Manage Return Orders </span>
                                    <span class="menu-arrow"></span>
                                </a>


                                <div class="collapse" id="Returnorders">
                                    <ul class="nav-second-level">

                                            <li>
                                                <a href="{{ route('customer.request.pending') }}">Return Order Request</a>
                                            </li>


                                            <li>
                                                <a href="{{ route('customer.returning.item') }}">Return Order Item
                                            </a>
                                            
                                        </li>

                                
                                        </ul>
                                    </div>
                            </li>

                        @endif






                        {{-- MANAGE SHIPPING ZONE SYSTEM FROM CUSTOMER --}}


                    @if(Auth::user()->can('can-manage-shipping-zone')) 

                            <li>
                                <a href="#ShippingZone" data-bs-toggle="collapse">
                                    <i class="mdi mdi-package-variant"></i>
                                    <span> Shipping Zone System </span>
                                    <span class="menu-arrow"></span>
                                </a>


                                <div class="collapse" id="ShippingZone">
                                    <ul class="nav-second-level">


                                            @if(Auth::user()->can('can-access-provinces')) 
                                            
                                            <li>
                                                <a href="{{ route('provinces.index') }}">Provinces</a>
                                            </li>

                                            @endif


                                                @if(Auth::user()->can('can-access-city')) 
                                            <li>
                                                <a href="{{ route('cities.index') }}">City
                                            </a>

                                                @endif


                                                @if(Auth::user()->can('can-access-barangay')) 

                                            <li>
                                                <a href="{{ route('barangays.index') }}">Barangay
                                            </a>

                                                @endif

                                            
                                        </li>

                                
                                        </ul>
                                    </div>
                            </li>

                        @endif





                                        {{--MANAGE EXPENSE PART --}}


                    @if(Auth::user()->can('can-manage-expenses'))
                            <li>
                                <a href="#sidebarAuth" data-bs-toggle="collapse">
                                    <i class="mdi mdi-cash-multiple"></i>
                                    <span> Manage Expense </span>
                                    <span class="menu-arrow"></span>
                                </a>


                                    <div class="collapse" id="sidebarAuth">
                                        <ul class="nav-second-level">

                                            <li>
                                                <a href="{{ route('add.expense')}}">Add Expense</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('todays.expense')}}">Today Expense</a>
                                            </li>
                                            
                                            <li>
                                                <a href="{{ route('month.expense')}}">Monthly Expense</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('year.expense')}}">Yearly Expense</a>
                                            </li>
                                            
                                    

                                        </ul>
                                    </div>
                        </li>

                        @endif



        
                                        {{--MANAGE AUDIT TRAIL PART  --}}


                    @if(Auth::user()->can('can-view-audit-trail'))
                            <li>
                                <a href="#audit" data-bs-toggle="collapse">
                                    <i class="mdi mdi-file-document-outline"></i>
                                    <span>Audit Trail Report </span>
                                    <span class="menu-arrow"></span>
                                </a>


                            <div class="collapse" id="audit">
                                <ul class="nav-second-level">

                                    @if(Auth::user()->can('can-view-audit-by-action'))
                                        <li>
                                            <a href="{{ route('audit.trail')}}">Audit By Action</a>
                                        </li>
                                    @endif


                                    @if(Auth::user()->can('can-view-audit-by-log'))
                                    <li>
                                        <a href="{{ route('audit.log') }}">Audit By Log</a>
                                    </li>
                                    @endif


                                    </ul>
                                </div>
                            </li>

                        @endif








                                        {{-- MANAGE OR VIEW REPORTS PART --}}

                            @if(Auth::user()->can('can-view-reports'))
                                <li>
                                    <a href="#SalesReport" data-bs-toggle="collapse">
                                        <i class="mdi mdi-chart-bar"></i>
                                        <span>Sales Report </span>
                                        <span class="menu-arrow"></span>
                                    </a>


                                <div class="collapse" id="SalesReport">
                                    <ul class="nav-second-level">

                                        @if(Auth::user()->can('can-view-daily-sales'))
                                            <li>
                                                <a href="{{ route('daily.reports')}}">Daily Sales Report</a>
                                            </li>
                                        @endif


                                        @if(Auth::user()->can('can-view-top-sellings'))
                                        <li>
                                            <a href="{{ route('top.sellings') }}">Top Selling Products</a>
                                        </li>
                                        @endif

                                        </ul>
                                    </div>
                                </li>
                            @endif








                            {{-- VAT DISCOUNT COMMERCE PART --}}

                    @if(Auth::user()->can('can-manage-commerce-settings'))
                        <li>
                            
                            <a href="{{ route('commerce.settings') }}">
                                <i class="mdi mdi-cart-outline"></i>
                                <span> Commerce Settings</span>
                            </a>
                        
                        </li>
            @endif







                            {{-- CHAT CUSTOMER PART --}}


                    @if(Auth::user()->can('can-view-customer-chat'))

                        <li>
                            
                            <a href="{{ route('view.admin.chat') }}"><i class="mdi mdi-cart-outline">
                                </i><span> Chat Customer</span>
                            
                            </a>

                        </li>

                        @endif




        @if (Auth::guard('web')->user()->roles->contains('name', 'Super Admin', 'Admin'))

                    <li class="menu-title mt-2">GENERAL SETTINGS</li>

            @endif



                            {{-- SETTINGS SYSTEM PART --}}


                
                @if(Auth::user()->can('can-manage-system-settings')) 

                <li>
                        <a href="#HeroSlider" data-bs-toggle="collapse">
                            <i class="mdi mdi-cog"></i>
                            <span>System Settings </span>
                            <span class="menu-arrow"></span>
                        </a>


                <div class="collapse" id="HeroSlider">
                    <ul class="nav-second-level">

                        @if(Auth::user()->can('can-change-system-titles'))
                            <li>
                                <a href="{{ route('heroslider.show')}}">Change Banner
                                </a>
                            </li>

                        @endif


                        @if(Auth::user()->can('can-change-banner/slider'))
                            <li>
                                <a href="{{ route('business.name')}}">
                                    <span> Change Title System</span>
                                </a>
                    
                            </li>

                        @endif


                    </ul>
                </div>

            </li>


            @endif





                                {{-- MANAGE ROLES PART --}}


                    @if(Auth::user()->can('can-manage-roles'))

                        <li>
                            <a href="#roles" data-bs-toggle="collapse">
                                <i class="mdi mdi-account-key"></i>
                                <span> Roles </span>
                                <span class="menu-arrow"></span>
                            </a>
                        <div class="collapse" id="roles">
                            <ul class="nav-second-level">   

                                @if(Auth::user()->can('can-view-roles'))
                                <li>
                                    <a href="{{ route('all.roles') }}">All Roles</a>
                                </li>
                                @endif


                                @if(Auth::user()->can('can-create-roles'))
                                <li>
                                    <a href="{{ route('add.roles') }}">Add Roles</a>
                                </li>
                                @endif
                            </ul>

                            </div>
                    </li>

                @endif






                                {{--  PERMISSIONS PART --}}

                                
            @if(Auth::user()->can('can-manage-permission'))
                <li>
                    <a href="#sidebarExpages" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-key"></i>
                        <span> Permission </span>
                        <span class="menu-arrow"></span>
                    </a>
                <div class="collapse" id="sidebarExpages">
                    <ul class="nav-second-level">   

                        {{-- <li>
                            <a href="{{ route('all.permission') }}">All Permission</a>
                        </li> --}}

                        @if(Auth::user()->can('can-add-roles-in-permissions'))
                        <li>
                            <a href="{{ route('add.roles.permission') }}">Add Roles in Permission</a>
                        </li>
                        @endif


                        <li>
                            <a href="{{ route('all.roles.permission') }}">All Roles in Permission</a>
                        </li>

                    </ul>

                    </div>
                </li>
            @endif








                            {{-- MANAGE USER ACCOUNT  PART --}}

                @if(Auth::user()->can('can-manage-user-accounts'))
                        <li>
                                <a href="#admin" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-circle"></i>
                                    <span> User Account </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="admin">
                                    <ul class="nav-second-level">

                                        @if(Auth::user()->can('can-view-all-users'))
                                        <li>
                                            <a href="{{ route('all.admin') }}">All Users</a>
                                        </li>
                                        @endif

                                        @if(Auth::user()->can('can-create-users'))
                                        <li>
                                            <a href="{{ route('create.admin') }}">Add Users</a>
                                        </li>
                                        @endif

                                    </ul>

                            </div>
                        </li>
                @endif





                                    {{-- BACKUP DATABASE PART --}}


                        @if(Auth::user()->can('can-manage-backup-database'))
                                <li>
                                    <a href="#backup" data-bs-toggle="collapse">
                                        <i class="mdi mdi-backup-restore"></i>
                                        <span class="badge bg-blue float-end">New</span>
                                        <span> Manage Backup </span>
                                    </a>

                                    <div class="collapse" id="backup">
                                            <ul class="nav-second-level">

                                                            <li>
                                                                <a href="{{ route('backup.database')}}">Backup Database</a>
                                                            </li>
                                                
                                            </ul>
                                    </div>
                                </li>
                        @endif








        
    {{-- @endif --}}

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>