            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-end mb-0">



                    {{-- Search bar --}}
                    {{-- <li class="d-none d-lg-block">
                            <form class="app-search">
                                <div class="app-search-box dropdown">
                                    <div class="input-group">
                                        <input type="search" class="form-control" placeholder="Search..." id="top-search">
                                        <button class="btn input-group-text" type="submit">
                                            <i class="fe-search"></i>
                                        </button>
                                    </div>
                                    
                                    <div class="dropdown-menu dropdown-lg" id="search-dropdown">
                                        <!-- item-->
                                        <div class="dropdown-header noti-title">
                                            <h5 class="text-overflow mb-2">Found 22 results</h5>
                                        </div>
            
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <i class="fe-home me-1"></i>
                                            <span>Analytics Report</span>
                                        </a>
            
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <i class="fe-aperture me-1"></i>
                                            <span>How can I help you?</span>
                                        </a>
                            
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <i class="fe-settings me-1"></i>
                                            <span>User profile settings</span>
                                        </a>

                                        <!-- item-->
                                        <div class="dropdown-header noti-title">
                                            <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                                        </div>

                                        <div class="notification-list">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                <div class="d-flex align-items-start">
                                                    <img class="d-flex me-2 rounded-circle" src="assets/images/users/user-2.jpg" alt="Generic placeholder image" height="32">
                                                    <div class="w-100">
                                                        <h5 class="m-0 font-14">Erwin E. Brown</h5>
                                                        <span class="font-12 mb-0">UI Designer</span>
                                                    </div>
                                                </div>
                                            </a>

                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                <div class="d-flex align-items-start">
                                                    <img class="d-flex me-2 rounded-circle" src="assets/images/users/user-5.jpg" alt="Generic placeholder image" height="32">
                                                    <div class="w-100">
                                                        <h5 class="m-0 font-14">Jacob Deo</h5>
                                                        <span class="font-12 mb-0">Developer</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
            
                                    </div>  
                                </div>
                            </form>
                        </li>

    
                     <li class="dropdown d-inline-block d-lg-none">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-search noti-icon"></i>
                            </a>
                            <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                                <form class="p-3">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                </form>
                            </div>
                        </li>
    
             
 --}}




                    {{-- NOTIF FOR LOWEST STOCK / OUT OF STOCK AND EXPIRED PRODUCT  --}}




                @php
                use App\Models\Inventory;

                $today = now();

                // Update expired items
                Inventory::where('expiry_date', '<', $today)
                        ->where('status', '!=', 'expired')
                        ->update(['status' => 'expired']);

                // Update out of stock items
                Inventory::where('quantity', '<=', 0)
                        ->where('status', '!=', 'out_of_stock')
                        ->update(['status' => 'out_of_stock']);

                // Retrieve items for notifications
                $expiredItems = Inventory::where('status', 'expired')->get();
                $lowStockItems = Inventory::where('quantity', '<', 5) // threshold for low stock
                                        ->where('status', '!=', 'out_of_stock')
                                        ->get();
                $outOfStockItems = Inventory::where('status', 'out_of_stock')->get();

                // Merge all notifications into a single collection
                $notifications = $expiredItems->merge($lowStockItems)->merge($outOfStockItems);


                @endphp



        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button">
                <i class="fe-bell noti-icon"></i>
                <span class="badge bg-danger rounded-circle noti-icon-badge">{{ $notifications->count() }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-lg">
                <div class="dropdown-item noti-title">
                    <h5 class="m-0">
                        <span class="float-end">
                            {{-- <a href="#" class="text-dark"><small>Clear All</small></a> --}}
                        </span>
                        Notification
                    </h5>
                </div>

                <div class="noti-scroll" data-simplebar>
                    @foreach($notifications as $item)
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon 
                                @if($item->status == 'expired') bg-warning
                                @elseif($item->status == 'out_of_stock') bg-danger
                                @elseif($item->quantity < 5) bg-info
                                @endif">
                                <i class="mdi mdi-alert"></i>
                            </div>
                            <p class="notify-details">

                                {{ $item->product->product_name ?? '' }} - 
                                @if($item->status == 'expired')
                                    Expired
                                @elseif($item->status == 'out_of_stock')
                                    Out of Stock
                                @elseif($item->quantity < 5)
                                    Low Stock
                                @endif
                                <small class="text-muted">{{ $item->updated_at->diffForHumans() }}</small>
                            </p>
                        </a>
                    @endforeach
                </div>

                {{-- <a href="#" class="dropdown-item text-center text-primary notify-item notify-all">
                    View all <i class="fe-arrow-right"></i>
                </a> --}}
            </div>
        </li>









@php
    $user = Auth::User(); // This is the current logged-in user
@endphp

                                    {{-- Profile View  --}}
                              <li class="dropdown notification-list topbar-dropdown">
                                  <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    
                                            <img src="{{ 
                                                    !empty($user->photo)
                                                        ? (Str::startsWith($user->photo, ['http://', 'https://'])
                                                            ? $user->photo
                                                            : asset('uploads/profile_image/' . $user->photo))
                                                        : asset('uploads/noimage.png')
                                                }}"
                                                class="rounded-circle avatar-lg img-thumbnail"
                                                alt="profile-image">
                                    
                                      <span class="pro-user-name ms-1">
                                           <i class="mdi mdi-chevron-down"></i> 
                                      </span>
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                      <!-- item-->
                                      <div class="dropdown-header noti-title">
                                          <h6 class="text-overflow m-0">Welcome !</h6>
                                      </div>
          
                                      <!-- item-->
                                      <a href="{{ route('view.profile')}}" class="dropdown-item notify-item">
                                          <i class="fe-user"></i>
                                          <span>My Account</span>
                                      </a>
          
                                      {{-- <!-- item-->
                                      <a href="javascript:void(0);" class="dropdown-item notify-item">
                                          <i class="fe-settings"></i>
                                          <span>Settings</span>
                                      </a>
           --}}
                                      <!-- item-->
                                <a href="{{ route('admin.change.password')}}" class="dropdown-item notify-item">
                                          <i class="fe-lock"></i>
                                          <span>Change Password</span>
                                      </a>
          
                                      <div class="dropdown-divider"></div>
          
                                      
                                      <!-- item-->
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item notify-item flex items-center gap-2">
                                    <i class="fe-log-out"></i>
                                    <span>Logout</span>
                                </button>
                            </form>

          
                                  </div>
                              </li>




                                {{-- Settings  --}}
                 <li class="dropdown notification-list d-none">
                            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                                <i class="fe-settings noti-icon"></i>
                            </a>
                        </li>
    
                    </ul> 



                {{-- <div class="logo-box h-8 w-8 flex items-center justify-center">
                    <a href="{{ route('admin.dashboard')}}" class="logo logo-dark">
                        <svg class="w-4 h-4 text-gray-600"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M8 12l2 2 4-4"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>


                     --}}

    
                    <ul class="list-unstyled topnav-menu topnav-menu-left m-0" style="margin-left: 20px;">
                        <li>
                            <button class="button-menu-mobile waves-effect waves-light" style="margin-left: 1rem;" >
                                <i class="fe-menu"></i>
                            </button>
                        </li>

                        <li>
                            <!-- Mobile menu toggle (Horizontal Layout)-->
                            <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>   
            

                    </ul>



                    <div class="clearfix"></div>
                </div>
            </div>