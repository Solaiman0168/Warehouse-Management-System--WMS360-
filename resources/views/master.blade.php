<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Warehouse Management System">
    <meta name="author" content="Combosoft">
    <title>
        @yield('title', 'WMS360 | Admin Panel')
    </title>
    <link rel="shortcut icon" href="{{asset('assets/common-assets/wms.ico')}}">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script>
    <script src='{{asset('assets/js/fab.fas.js')}}'></script>

{{--    <!-- date clock picker-->--}}
{{--    <link href="{{asset('assets/plugins/timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('assets/plugins/clockpicker/css/bootstrap-clockpicker.min.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">--}}
<!-- DataTables -->
    {{--    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">--}}
    {{--    <!-- Responsive datatable examples -->--}}
    {{--    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">--}}

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    @if(isset($_COOKIE['mode']))
        <link href="{{asset('assets/')}}/css/{{$_COOKIE['mode']}}.css" rel="stylesheet" type="text/css" data-style-sheet>
    @else
        <link href="{{asset('assets/')}}/css/style.css" rel="stylesheet" type="text/css" data-style-sheet>
    @endif
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/loader.css')}}">

    <link rel="stylesheet" href="{{asset('assets/plugins/magnific-popup/css/magnific-popup.css')}}">
    <!---Animate css----->
    <link rel="stylesheet" href="{{asset('assets/plugins/animate/animate.min.css')}}">

    <style>
        #wms_preloader{
            background: rgb(0 0 0 / 80%) url('{{asset('assets/common-assets/loader2.gif')}}') no-repeat center center;
        }
    </style>
    <style>
        #ajax_loader{
            background: rgb(0 0 0 / 80%) url('{{asset('assets/common-assets/loader2.gif')}}') no-repeat center center;
        }
    </style>

</head>


<body class="fixed-left">
{{-- <script type="text/javascript">
    jQuery("body").prepend('<div id="Load" class="load">\n' +
'                           <div class="load__container">\n' +
'                           <div class="load__animation"></div>\n' +
'                           <div class="load__mask"></div>\n' +
'                           <span class="load__title">Processing...</span>\n' +
'                           </div>\n' +
'                           </div>');
    jQuery(document).ready(function() {
        jQuery("#Load").remove();
    });
</script>  --}}

{{-- ajax loader --}}
<div id="ajax_loader" class="ajax_loader" style="display: none;"></div>

{{-- page loader --}}
<script type="text/javascript">
    jQuery("body").prepend('<div id="wms_preloader"> </div>');

    jQuery(document).ready(function() {
        jQuery("#wms_preloader").remove();
    });
</script>

@php
    $navabr_humberger_btn_value = \App\NavbarHumbergerExpandCollapse::where('user_id', Auth::user()->id)->first();
@endphp

<!-- Begin page -->
@if(isset($navabr_humberger_btn_value))
<div id="wrapper" class="forced @if($navabr_humberger_btn_value->expand_collapse_value == 0) enlarged @endif">
@endif

    <!-- Top Bar Start -->
    <div class="topbar">
    @php
        $shelf_use = Session::get('shelf_use');
        if($shelf_use == ''){
            $shelf_use = \App\Client::first()->shelf_use;
            Session::put('shelf_use',$shelf_use);
        }
        $channels = \App\Channel::get()->toArray();
        if(($key = array_search('ebay',array_column($channels,'channel_term_slug'))) !== false){
            Session::put('ebay',$channels[$key]['is_active']);
        }
        if(($key = array_search('woocommerce',array_column($channels,'channel_term_slug'))) !== false){
            Session::put('woocommerce',$channels[$key]['is_active']);
        }
        if(($key = array_search('onbuy',array_column($channels,'channel_term_slug'))) !== false){
            Session::put('onbuy',$channels[$key]['is_active']);
        }
        if(($key = array_search('amazon',array_column($channels,'channel_term_slug'))) !== false){
            Session::put('amazon',$channels[$key]['is_active']);
        }
        if(($key = array_search('shopify',array_column($channels,'channel_term_slug'))) !== false){
            Session::put('shopify',$channels[$key]['is_active']);
        }
        //dd($channels);
    @endphp


    <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <!--<a href="index.html" class="logo"><i class="icon-magnet icon-c-logo"></i><span>Ub<i class="md md-album"></i>ld</span></a> -->
                <!-- Image Logo here -->
                <a href="{{url('dashboard')}}" class="logo">
                    <i class="icon-c-logo"> <img class="mbl-logo" src="{{asset('assets/common-assets/WMS_360.png')}}" /> </i>
                    <span><img src="{{asset('assets/common-assets/WMS_360.png')}}" alt="logo" /></span>
                </a>
            </div>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <nav class="navbar-custom">

            <ul class="list-inline float-right mb-0">
                {{--  <li class="list-inline-item dropdown notification-list">
                      <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                         aria-haspopup="false" aria-expanded="false">
                          <i class="dripicons-bell noti-icon"></i>
                          <span class="badge badge-pink noti-icon-badge">4</span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                          <!-- item-->
                          <div class="dropdown-item noti-title">
                              <h5><span class="badge badge-danger float-right">5</span>Notification</h5>
                          </div>

                          <!-- item-->
                          <a href="javascript:void(0);" class="dropdown-item notify-item">
                              <div class="notify-icon bg-success"><i class="icon-bubble"></i></div>
                              <p class="notify-details">Robert S. Taylor commented on Admin<small class="text-muted">1 min ago</small></p>
                          </a>

                          <!-- item-->
                          <a href="javascript:void(0);" class="dropdown-item notify-item">
                              <div class="notify-icon bg-info"><i class="icon-user"></i></div>
                              <p class="notify-details">New user registered.<small class="text-muted">1 min ago</small></p>
                          </a>

                          <!-- item-->
                          <a href="javascript:void(0);" class="dropdown-item notify-item">
                              <div class="notify-icon bg-danger"><i class="icon-like"></i></div>
                              <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">1 min ago</small></p>
                          </a>

                          <!-- All-->
                          <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
                              View All
                          </a>

                      </div>
                  </li>  --}}
                {{-- <li class="list-inline-item notification-list">
                    <a class="nav-link waves-light waves-effect" href="https://wms360.co.uk/my-account/">
                        <div class="wp-account">My Account</div>
                    </a>
                </li> --}}

                <li class="list-inline-item notification-list">
                    <a class="nav-link waves-light waves-effect" href="#" id="btn-fullscreen">
                        <i class="dripicons-expand noti-icon"></i>
                    </a>
                </li>

                {{-- <li class="list-inline-item notification-list">
                     <a class="nav-link slide-toggle waves-light waves-effect" href="#">
                         <i class="fa fa-cog"></i>
                     </a>
                 </li> --}}

                <li class="list-inline-item dropdown notification-list">
                    {{-- <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false"> --}}
                    <a class="nav-link slide-toggle waves-effect waves-light nav-user">
                        @if(Auth::check())
                            <img src="{{asset(Auth::user()->image ? 'uploads/'.Auth::user()->image : 'assets/common-assets/img_avatar.png')}}" alt="" class="rounded-circle">
                        @endif
                    </a>
                    {{-- <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview" style="width: auto">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="text-overflow"><small>Welcome ! {{Auth::user()->name}}</small> </h5>
                        </div>

                        <!-- item-->
                        <a href="{{url('user-details/'.Crypt::encrypt(Auth::user()->id))}}" class="dropdown-item notify-item">
                            <i class="md md-account-circle"></i> <span>Profile</span>
                        </a> --}}

                <!-- item-->
                    {{--                        <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
                    {{--                            <i class="md md-settings"></i> <span>Settings</span>--}}
                    {{--                        </a>--}}

                <!-- item-->
                    {{--                        <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
                    {{--                            <i class="zmdi zmdi-lock-open"></i> <span>Lock Screen</span>--}}
                    {{--                        </a>--}}
                    {{-- <a href="{{url('user/change-password/'.Auth::id())}}" class="dropdown-item notify-item">
                        <i class="md md-lock-open"></i> <span>Change Password</span>
                    </a> --}}
                    {{-- <a href="{{url('settings')}}" class="dropdown-item notify-item">
                        <i class="md md-settings"></i> <span>Setting</span>
                    </a> --}}

                <!-- item-->
                    {{-- <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        <i class="md md-settings-power"></i> <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form> --}}

                    {{--                        <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
                    {{--                            <i class="md md-settings-power"></i> <span>Logout</span>--}}
                    {{--                        </a>--}}

                    {{-- </div> --}}
                </li>

            </ul>
            
            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <button class="button-menu-mobile open-left waves-light waves-effect" onclick="sidebar_humberger_btn()">
                        @if(isset($navabr_humberger_btn_value))
                            <input type="hidden" id="sidebar-humberger-btn" value="{{$navabr_humberger_btn_value->expand_collapse_value}}">
                        @else 
                            <input type="hidden" id="sidebar-humberger-btn" value="1">
                        @endif
                        <i class="dripicons-menu"></i>
                    </button>
                </li>
                <!-- <li class="hide-phone app-search">
                     <form role="search" class="">
                         <input type="text" placeholder="Search..." class="form-control">
                         <a href=""><i class="fa fa-search"></i></a>
                     </form>
                 </li> -->
            </ul>

        </nav>

    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->

    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">
            <!--- Divider -->
            <div id="sidebar-menu">
                <ul>
                    {{--                    <li class="text-muted menu-title">Navigation</li>--}}
                    @if (Auth::check() && !empty(array_intersect(['1','2'],explode(',',Auth::user()->role))))
                        <li class="has_sub">
                            <a href="{{url('dashboard')}}" class="waves-effect"><i class="ti-home" aria-hidden="true"></i><span> Dashboard </span></a>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-panel" aria-hidden="true"></i><span> Catalogue  </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{url('completed-catalogue-list')}}"> Active Catalogue </a></li>
                                <li><a href="{{url('draft-catalogue-list')}}"> Draft Catalouge</a></li>
                                <li><a href="{{url('product-draft/create')}}"> Add Catalogue </a></li>
                            {{--                            <li><a href="{{url('published-product')}}"> Published Catalogue List</a></li>--}}

                            @if (Auth::check() && !empty(array_intersect(['1','2'],explode(',',Auth::user()->role))))

                                <!-- <li><a href="{{url('attribute/create')}}"> Add Attribute </a></li>
                                <li><a href="{{url('attribute')}}">Attribute List</a></li> -->
                                    <li><a href="{{url('attribute-terms')}}">Variation</a></li>
                                {{--                            <li>--}}
                                {{--                                <a href="javascript:void(0);" class="waves-effect"><span>Attribute</span> <span class="menu-arrow"></span></a>--}}
                                {{--                                <ul class="list-unstyled">--}}
                                {{--                                                                <li><a href="{{url('attribute/create')}}"> Add Attribute </a></li>--}}
                                {{--                                    <li><a href="{{url('attribute')}}">Attribute List</a></li>--}}
                                {{--                                    <li><a href="{{url('attribute-terms/create')}}">Add Attribute Terms</a></li>--}}
                                {{--                                    <li><a href="{{url('attribute-terms')}}">Attribute Terms List</a></li>--}}
                                {{--                                </ul>--}}
                                {{--                            </li>--}}
                            @endif

                            <!-- <li><a href="{{url('condition')}}">Condition</a></li> -->
                                {{--                            <li>--}}
                                {{--                                <a href="javascript:void(0);" class="waves-effect"><span>Condition</span> <span class="menu-arrow"></span></a>--}}
                                {{--                                <ul class="list-unstyled">--}}
                                {{--                                    <li><a href="{{url('condition/create')}}"> Add Condition </a></li>--}}
                                {{--                                    <li><a href="{{url('condition')}}"> Condition List</a></li>--}}
                                {{--                                </ul>--}}
                                {{--                            </li>--}}

                                {{--                            <li><a href="{{url('product-variation')}}">Product List</a></li>--}}


                                {{--                            <li>--}}
                                {{--                                <a href="javascript:void(0);" class="waves-effect"><span>Product</span> <span class="menu-arrow"></span></a>--}}
                                {{--                                <ul class="list-unstyled">--}}
                                {{--                                    <li><a href="{{url('product-variation/create')}}">Add Product</a></li>--}}
                                {{--                                    <li><a href="{{url('product-variation')}}">Product List</a></li>--}}
                                {{--                                    <li><a href="{{url('low-quantity-product-list')}}">Low Quantity</a></li>--}}
                                {{--                                    <li><a href="{{url('defected-product-list')}}">Defected Product</a></li>--}}
                                {{--                                    <li><a href="{{url('unmatched-inventory-list')}}">Unmatched Product</a></li>--}}
                                {{--                                </ul>--}}
                                {{--                            </li>--}}

                                <li class="has_sub">
                                    <a id="tab_tab" href="javascript:void(0);" class="waves-effect"><span>Categorization</span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        {{--                                <li><a href="{{url('woowms-category/create')}}"> Add Category </a></li>--}}
                                        <li><a href="{{url('woowms-category')}}"> Category</a></li>
                                        <li><a href="{{url('brand')}}">Brand</a></li>
                                        <li><a href="{{url('gender')}}">Department</a></li>
                                        <li><a href="{{url('condition')}}">Condition</a></li>
                                    </ul>
                                </li>
                                {{-- <li><a href="{{url('reports')}}"> Reports </a></li> --}}
                                {{-- <li><a href="{{url('global_reports')}}"> WMS Reports </a></li> --}}
                                <li><a href="{{url('item-attribute')}}">Item Attribute </a></li>
                                <li><a href="{{url('item-profiles')}}">Item Profiles </a></li>
                                <!-- <li><a href="{{url('channels')}}">Channels </a></li> -->
                            </ul>
                        </li>


                    <!-- <li class="has_sub">
                            <a href="{{url('amazon-authorization')}}" class="waves-effect"><i class="ti-panel" aria-hidden="true"></i><span> Amazon  </span></a>
                        </li> -->

                    @if ((($key = array_search('woocommerce',array_column($channels,'channel_term_slug'))) !== false))
                        @if ($channels[$key]['is_active'] == 1)
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-panel" aria-hidden="true"></i><span> WooCommerce  </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{url('woocommerce/publish/catalogue/list')}}">Active Product</a></li>
                                <li><a href="{{url('woocommerce/pending/catalogue/lists')}}">Pending Product</a></li>
                                <li><a href="{{url('woocommerce/draft/catalogue/list')}}">Draft Product</a></li>
                                @if (Auth::check() && !empty(array_intersect(['1','2'],explode(',',Auth::user()->role))))
                                    <li><a href="{{url('category')}}"> Category </a></li>
                                    <li><a href="{{url('woocommerce-choose-migration')}}">Attribute</a></li>
                                    <li><a href="{{url('woocommerce/account-credentials')}}"> Account </a></li>
                                    {{--                                    <li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><span>Web Category</span> <span class="menu-arrow"></span></a>--}}
                                    {{--                                        <ul class="list-unstyled">--}}
                                    {{--                                            <li><a href="{{url('category/create')}}"> Add Category</a></li>--}}
                                    {{--                                            <li><a href="{{url('category')}}"> Category List </a></li>--}}
                                    {{--                                        </ul>--}}
                                    {{--                                    </li>--}}
                                @endif
                            </ul>
                        </li>
                        @endif
                    @endif
                @if ((($key = array_search('onbuy',array_column($channels,'channel_term_slug'))) !== false))
                    @if ($channels[$key]['is_active'] == 1)
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-panel" aria-hidden="true"></i><span> OnBuy  </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{url('onbuy/master-product-list')}}">Active Product</a></li>
                            <li><a href="{{url('onbuy/pending-catalogue-listing/with-ean')}}">Pending Product</a></li>
                            <li><a href="{{url('onbuy/pending-catalogue-listing/without-ean')}}">Missing EAN Product</a></li>
{{--                            <li><a href="{{url('onbuy/failed-catalogue-list')}}">Failed Product</a></li>--}}
                            <li><a href="{{url('onbuy/create-profile')}}"> Add Profile </a></li>
                            <li><a href="{{url('onbuy/profile-list')}}"> Profile </a></li>
                            <li><a href="{{url('onbuy/category')}}"> Category</a></li>
                            <li><a href="{{url('onbuy/brand')}}"> Brand</a></li>
                            <li><a href="{{url('onbuy/search-product')}}"> Search Product</a></li>
                            <li><a href="{{url('onbuy/account-credentials')}}"> Account </a></li>
                        </ul>
                    </li>
                    @endif
                @endif
                @if ((($key = array_search('ebay',array_column($channels,'channel_term_slug'))) !== false))
                    @if ($channels[$key]['is_active'] == 1)
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-panel" aria-hidden="true"></i><span> eBay </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{url('ebay-master-product-list')}}">Active Product</a></li>
                                <li><a href="{{url('ebay-pending-list')}}">Pending Product</a></li>
                                <li><a href="{{url('ebay-revise-product-list')}}">Revise Product</a></li>
                                <li><a href="{{url('ebay-end-product-list')}}">End Product</a></li>
                            <!-- <li><a href="{{url('ebay-master-product-with-error-message-list')}}">Error Log</a></li> -->
                                <li><a href="{{url('ebay-profile')}}"> Profile </a></li>
                                {{--                                <li><a href="javascript:void(0);" class="waves-effect"><span> Profile </span> <span class="menu-arrow"></span></a>--}}
                                {{--                                    <ul class="list-unstyled">--}}
                                {{--                                        <li><a href="{{url('ebay-profile')}}"> Profile List</a></li>--}}
                                {{--                                        <li><a href="{{url('ebay-profile/create')}}">Add Profile</a></li>--}}
                                {{--                                    </ul>--}}
                                {{--                                </li>--}}
                                <li><a href="{{url('ebay-template')}}">eBay Template</a></li>
                                {{--                                <li><a href="javascript:void(0);" class="waves-effect"><span> Template  </span> <span class="menu-arrow"></span></a>--}}
                                {{--                                    <ul class="list-unstyled">--}}
                                {{--                                        <li><a href="{{url('ebay-template')}}">Ebay Template</a></li>--}}
                                {{--                                        <li><a href="{{url('ebay-template/create')}}">Add Ebay Template</a></li>--}}
                                {{--                                    </ul>--}}
                                {{--                                </li>--}}
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><span> Policy  </span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="{{url('return-policy')}}">Return Policy</a></li>
                                        <li><a href="{{url('payment-policy')}}">Payment policy </a></li>
                                        <li><a href="{{url('shipment-policy')}}">Shipment Policy </a></li>
                                    </ul>
                                </li>

                                <li><a href="{{url('ebay-migration-list')}}">eBay Migration </a></li>
                                {{--                                <li><a href="javascript:void(0);" class="waves-effect"><span> Policies  </span> <span class="menu-arrow"></span></a>--}}
                                {{--                                    <ul class="list-unstyled">--}}
                                {{--                                        <li><a href="javascript:void(0);" class="waves-effect"><span> Return policy </span> <span class="menu-arrow"></span></a>--}}
                                {{--                                            <ul class="list-unstyled">--}}
                                {{--                                                <li><a href="{{url('return-policy')}}">Return Policies list</a></li>--}}
                                {{--                                                <li><a href="{{url('return-policy/create')}}">Add Return Policies</a></li>--}}
                                {{--                                            </ul></li>--}}
                                {{--                                        <li>--}}
                                {{--                                            <a href="javascript:void(0);" class="waves-effect"><span>Payment Policy  </span> <span class="menu-arrow"></span></a>--}}
                                {{--                                            <ul class="list-unstyled">--}}
                                {{--                                                <li><a href="{{url('payment-policy')}}">Payment policy List </a></li>--}}
                                {{--                                                <li><a href="{{url('payment-policy/create')}}">Add Payment policy</a></li>--}}
                                {{--                                            </ul>--}}
                                {{--                                        </li>--}}
                                {{--                                        <li>--}}
                                {{--                                            <a href="javascript:void(0);" class="waves-effect"><span>Shipment Policy  </span> <span class="menu-arrow"></span></a>--}}
                                {{--                                            <ul class="list-unstyled">--}}
                                {{--                                                <li><a href="{{url('shipment-policy')}}">Shipment Policy List </a></li>--}}
                                {{--                                                <li><a href="{{url('shipment-policy/create')}}">Add Shipment Policies</a></li>--}}
                                {{--                                            </ul>--}}
                                {{--                                        </li>--}}
                                {{--                                    </ul>--}}
                                {{--                                </li>--}}
                                <li><a href="{{url('ebay-account-list')}}">Account </a></li>
                                {{--                                <li><a href="{{url('ebay-create-account')}}">Add Ebay</a></li>--}}


                                {{--                                <li><a href="javascript:void(0);" class="waves-effect"><span> Product  </span> <span class="menu-arrow"></span></a>--}}
                                {{--                                    <ul class="list-unstyled">--}}
                                {{--                                        <li><a href="{{url('ebay-master-product-list')}}">Active Product</a></li>--}}
                                {{--                                        <li><a href="{{url('ebay-pending-list')}}">Pending Product</a></li>--}}

                                {{--                                    </ul>--}}
                                {{--                                </li>--}}
                                {{--                                <li><a href="{{url('ebay-paypal')}}">Paypal</a></li>--}}
                                {{--                                <li><a href="javascript:void(0);" class="waves-effect"><span> Paypal  </span> <span class="menu-arrow"></span></a>--}}
                                {{--                                    <ul class="list-unstyled">--}}
                                {{--                                        <li><a href="{{url('ebay-paypal')}}">Paypal</a></li>--}}
                                {{--                                        <li><a href="{{url('ebay-paypal/create')}}">Add Paypal</a></li>--}}

                                {{--                                    </ul>--}}
                                {{--                                </li>--}}
                                {{--                                @if (Auth::check() && !empty(array_intersect(['1','2'],explode(',',Auth::user()->role))))--}}
                                {{--                                <li class="has_sub">--}}
                                {{--                                    <a href="{{url('https://auth.ebay.com/oauth2/authorize?client_id=Mahfuzhu-warehous-PRD-b2eb49443-8e2b8238&response_type=code&redirect_uri=Mahfuzhur_Rahma-Mahfuzhu-wareho-uyhilcaf&scope=https://api.ebay.com/oauth/api_scope https://api.ebay.com/oauth/api_scope/sell.marketing.readonly https://api.ebay.com/oauth/api_scope/sell.marketing https://api.ebay.com/oauth/api_scope/sell.inventory.readonly https://api.ebay.com/oauth/api_scope/sell.inventory https://api.ebay.com/oauth/api_scope/sell.account.readonly https://api.ebay.com/oauth/api_scope/sell.account https://api.ebay.com/oauth/api_scope/sell.fulfillment.readonly https://api.ebay.com/oauth/api_scope/sell.fulfillment https://api.ebay.com/oauth/api_scope/sell.analytics.readonly https://api.ebay.com/oauth/api_scope/sell.finances https://api.ebay.com/oauth/api_scope/sell.payment.dispute https://api.ebay.com/oauth/api_scope/commerce.identity.readonly')}}" class="waves-effect"><span> Authorize ebay </span></a>--}}
                                {{--                                </li>--}}
                                {{--                                @endif--}}
                            </ul>
                        </li>
                    @endif
                @endif
                        {{--                    <li class="has_sub">--}}
                        {{--                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-agenda"></i><span>Onbuy Profile </span> <span class="menu-arrow"></span></a>--}}
                        {{--                        <ul class="list-unstyled">--}}
                        {{--                        </ul>--}}
                        {{--                    </li>--}}
                        {{--                    <li class="has_sub">--}}
                        {{--                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-package"></i><span> Product </span> <span class="menu-arrow"></span></a>--}}
                        {{--                        <ul class="list-unstyled">--}}
                        {{--                            <li><a href="{{url('product-variation/create')}}"> Add Product </a></li>--}}
                        {{--                            <li><a href="{{url('product-variation')}}"> Product List</a></li>--}}
                        {{--                            <li><a href="{{url('low-quantity-product-list')}}"> Low Quantity List</a></li>--}}
                        {{--                            <li><a href="{{url('defected-product-list')}}"> Defected Product List</a></li>--}}
                        {{--                            <li><a href="{{url('unmatched-inventory-list')}}"> Unmatched Quantity</a></li>--}}
                        {{--                        </ul>--}}
                        {{--                    </li>--}}
                @if ((($key = array_search('amazon',array_column($channels,'channel_term_slug'))) !== false))
                    @if ($channels[$key]['is_active'] == 1)
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-panel" aria-hidden="true"></i><span> Amazon  </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{url('amazon/active-catalogues')}}">Active Catalogue</a></li>
                                <li><a href="{{url('amazon/pending-catalogue')}}">Pending Catalogue</a></li>
                                <li><a href="{{url('amazon/accounts')}}">Accounts</a></li>
                                <li><a href="{{url('amazon/applications')}}">Applications</a></li>
                                <li><a href="{{url('amazon/seller-sites')}}">Seller Sites</a></li>
                            </ul>
                        </li>
                    @endif
                @endif
                @if ((($key = array_search('shopify',array_column($channels,'channel_term_slug'))) !== false))
                    @if ($channels[$key]['is_active'] == 1)
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-panel" aria-hidden="true"></i><span> Shopify  </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{url('shopify/shopify-master-product-list')}}">Active Product</a></li>
                                <li><a href="{{url('shopify/shopify-pending-list')}}">Pending Product</a></li>
                                <li><a href="{{url('shopify/draft-product-list')}}">Draft Product</a></li>
                                <li><a href="{{url('shopify/collection')}}">Collection</a></li>
                                <li><a href="{{url('shopify/tags')}}">Tags</a></li>
                                <li><a href="{{url('shopify/accounts')}}">Accounts</a></li>
                            </ul>
                        </li>
                    @endif
                @endif
                    @endif
                    @if (Auth::check() && !empty(array_intersect(['1','2','4'],explode(',',Auth::user()->role))))
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-receipt"></i><span> Inventory </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                @if (Auth::check() && !empty(array_intersect(['1','2'],explode(',',Auth::user()->role))))
                                    <li><a href="{{url('invoice/create')}}"> Add Inventory </a></li>
                                    {{--                            <li><a href="{{url('invoice-edit')}}"> Invoice Edit </a></li>--}}

                                @endif
                                @if($shelf_use == 1)
                                    {{-- <li><a href="{{url('pending-receive')}}"> Awaiting Shelving </a></li> --}}
                                    <li><a href="{{url('awaiting-shelving')}}"> Awaiting Shelving </a></li>
                                @endif
                                @if (Auth::check() && !empty(array_intersect(['1','2'],explode(',',Auth::user()->role))))
                                    <li><a href="{{url('invoice')}}"> Invoice History </a></li>
                                @endif
                                <li><a href="{{url('suppliers')}}"><span> Supplier </span> </a></li>
                                <li><a href="{{url('low-quantity-product-list')}}">Low Quantity</a></li>
                                <li><a href="{{url('defected-product-list')}}">Defected Product</a></li>
                            <!-- <li><a href="{{url('defect-reason/na/all')}}">Defect Reason</a></li> -->
                                <li><a href="{{url('unmatched-inventory-list')}}">Unmatched Product</a></li>
                                <li><a href="{{url('change-shelf-quantity-log')}}"> Shelf Qty Change Log </a></li>
                                <li class="has_sub">
                                    <a id="tab_tab" href="javascript:void(0);" class="waves-effect"><span>Report</span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        {{--                                <li><a href="{{url('woowms-category/create')}}"> Add Category </a></li>--}}
                                        <li><a href="{{url('export-catalogue-reports')}}"> Export Catalogue Reports </a></li>
                                        <li><a href="{{url('inventory-reports')}}"> Inventory Reports </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (Auth::check() && !empty(array_intersect(['1','2'],explode(',',Auth::user()->role))))
                        {{--                    <li class="has_sub">--}}
                        {{--                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-agenda"></i><span> Attribute </span> <span class="menu-arrow"></span></a>--}}
                        {{--                        <ul class="list-unstyled">--}}
                        {{--                            --}}{{--                            <li><a href="{{url('attribute/create')}}"> Add Attribute </a></li>--}}
                        {{--                            <li><a href="{{url('attribute')}}"> Attribute List </a></li>--}}
                        {{--                            <li><a href="{{url('attribute-terms/create')}}"> Add Attribute Terms</a></li>--}}
                        {{--                            <li><a href="{{url('attribute-terms')}}"> Attribute Terms List </a></li>--}}
                        {{--                        </ul>--}}
                        {{--                    </li>--}}
                        {{--                    <li class="has_sub">--}}
                        {{--                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-archive"></i><span> Attribute Terms </span> <span class="menu-arrow"></span></a>--}}
                        {{--                        <ul class="list-unstyled">--}}
                        {{--                            <li><a href="{{url('attribute-terms/create')}}"> Add Attribute Terms</a></li>--}}
                        {{--                            <li><a href="{{url('attribute-terms')}}"> Attribute Terms List </a></li>--}}
                        {{--                        </ul>--}}
                        {{--                    </li>--}}

                        {{--                        <li class="has_sub">--}}
                        {{--                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-agenda"></i><span>Onbuy Profile </span> <span class="menu-arrow"></span></a>--}}
                        {{--                            <ul class="list-unstyled">--}}
                        {{--                                <li><a href="{{url('onbuy/profile-list')}}"> Profile List</a></li>--}}
                        {{--                                <li><a href="{{url('onbuy/create-profile')}}"> Add Profile </a></li>--}}
                        {{--                            </ul>--}}
                        {{--                        </li>--}}



                        {{--                        <li class="has_sub">--}}
                        {{--                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-agenda"></i><span>Conditions</span> <span class="menu-arrow"></span></a>--}}
                        {{--                            <ul class="list-unstyled">--}}
                        {{--                                <li><a href="{{url('condition/create')}}"> Add Condition </a></li>--}}
                        {{--                                <li><a href="{{url('condition')}}"> Condition List</a></li>--}}
                        {{--                            </ul>--}}
                        {{--                        </li>--}}

                        {{--                        <li class="has_sub">--}}
                        {{--                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-agenda"></i><span>Brand</span> <span class="menu-arrow"></span></a>--}}
                        {{--                            <ul class="list-unstyled">--}}
                        {{--                                <li><a href="{{url('brand/create')}}"> Add Brand </a></li>--}}
                        {{--                                <li><a href="{{url('brand')}}"> Brand List</a></li>--}}
                        {{--                            </ul>--}}
                        {{--                        </li>--}}

                        {{--                        <li class="has_sub">--}}
                        {{--                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-agenda"></i><span>Gender</span> <span class="menu-arrow"></span></a>--}}
                        {{--                            <ul class="list-unstyled">--}}
                        {{--                                <li><a href="{{url('gender/create')}}"> Add Gender </a></li>--}}
                        {{--                                <li><a href="{{url('gender')}}"> Gender List</a></li>--}}
                        {{--                            </ul>--}}
                        {{--                        </li>--}}

                    @endif
                    @if (Auth::check() && !empty(array_intersect(['1','2','3'],explode(',',Auth::user()->role))))
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-write"></i><span> Order </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                @if (Auth::check() && !empty(array_intersect(['1','2'],explode(',',Auth::user()->role))))
                                    <li><a href="{{url('order/list')}}"> Awaiting Dispatch </a></li>
                                @endif
                                @if (Auth::check() && !empty(array_intersect(['1','2'],explode(',',Auth::user()->role))))
                                    <li><a href="{{url('all/order')}}"> All Order </a></li>
                                @endif
                                <li><a href="{{url('group-order')}}"> Group Order </a></li>
                                @if($shelf_use == 1)
                                    <li><a href="{{url('assigned/order/list')}}"> Assigned Order </a></li>
                                @endif
                                @if (Auth::check() && !empty(array_intersect(['1','2'],explode(',',Auth::user()->role))))
                                    <li><a href="{{url('hold/order/list')}}"> Hold Order</a></li>
                                    <li><a href="{{url('completed/order/list')}}"> Dispatched Order </a></li>
                                    <li><a href="{{url('return/order/list')}}"> Return Order </a></li>
                                    <li><a href="{{url('cancelled/order/list')}}"> Cancelled Order </a></li>
                                    <li><a href="{{url('manual-order')}}"> Create Order </a></li>
                                <!-- <li><a href="{{url('order-cancel-reason')}}"> Order Cancel Reason </a></li> -->
                                    {{--                            <li><a href="{{url('picked/order/list')}}"> Picked Order List</a></li>--}}
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if($shelf_use == 1)
                        @if (Auth::check() && !empty(array_intersect(['1','2','3','4'],explode(',',Auth::user()->role))))
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-warehouse"></i></i><span> Warehouse </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    @if (Auth::check() && !empty(array_intersect(['1','2'],explode(',',Auth::user()->role))))
                                        {{--                            <li><a href="{{url('shelf/create')}}"> Add Shelf </a></li>--}}
                                    @endif
                                    @if (Auth::check() && !empty(array_intersect(['1','2','3','4'],explode(',',Auth::user()->role))))
                                        <li><a href="{{url('warehouse/all')}}"> Warehouse List </a></li>
                                        <li><a href="{{url('shelf')}}"> Shelf List </a></li>
                                    @endif
                                    @if (Auth::check() && !empty(array_intersect(['1','2'],explode(',',Auth::user()->role))))
                                        <li><a href="{{url('reshelved-product-list')}}"> Reshelved Product </a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                    @endif

                    @if (Auth::check() && !empty(array_intersect(['1','2'],explode(',',Auth::user()->role))))
                        {{--                    <li class="has_sub">--}}
                        {{--                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-layout-menu-v"></i><span> Category </span> <span class="menu-arrow"></span></a>--}}
                        {{--                        <ul class="list-unstyled">--}}
                        {{--                            <li><a href="{{url('category/create')}}"> Add Category</a></li>--}}
                        {{--                            <li><a href="{{url('category')}}"> Category List </a></li>--}}
                        {{--                        </ul>--}}
                        {{--                    </li>--}}
                        <li><a href="{{url('activity-log')}}"><i class="ti-bookmark-alt" aria-hidden="true"></i><span> Activity Log </span> </a></li>
                        @if (Auth::check() && in_array('1',explode(',',Auth::user()->role)))
                        <li><a href="{{url('user-list')}}"><i class="ti-user" aria-hidden="true"></i><span> User & Role </span> </a></li>
                        <li><a href="{{url('update-list')}}"><i class="ti-bookmark-alt" aria-hidden="true"></i><span> Update </span> </a></li>
                        @endif
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-panel" aria-hidden="true"></i><span> Setting  </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{url('invoice-setting')}}"> Invoice Setting </a></li>
                                <li><a href="{{url('shipping-setting')}}"> Shipping Setting </a></li>
                                @if (Auth::check() && in_array('1',explode(',',Auth::user()->role)))
                                <li><a href="{{url('settings')}}"> Wms Settings </a></li>
                                @endif
                            {{--                                <li><a href="{{url('shopify-api-test')}}"> Shopify Api Test </a></li>--}}
                            <!-- <li><a href="{{url('auto-sync-button')}}"> auto sync on of button </a></li> -->
                            </ul>
                        </li>
                        <!-- <li><a href="{{url('channel-integration/1')}}"><i class="ti-bookmark-alt" aria-hidden="true"></i><span> Integration </span> </a></li> -->
                        {{--                        <li class="has_sub">--}}
                        {{--                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-user" aria-hidden="true"></i><span> User </span> <span class="menu-arrow"></span></a>--}}
                        {{--                            <ul class="list-unstyled">--}}
                        {{--                                <li><a href="{{url('add-user')}}"> Add User </a></li>--}}
                        {{--                                <li><a href="{{url('user-list')}}"> User List </a></li>--}}
                        {{--                            </ul>--}}
                        {{--                        </li>--}}

                    @endif

                <!-- <li><a href="{{url('vendor-all-list')}}"><i class="ti-id-badge" aria-hidden="true"></i><span> Supplier </span> </a></li> -->
                    {{--                    <li class="has_sub">--}}
                    {{--                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-id-badge" aria-hidden="true"></i><span> Supplier </span> <span class="menu-arrow"></span></a>--}}
                    {{--                        <ul class="list-unstyled">--}}
                    {{--                            <li><a href="{{url('/vendor/create')}}"> Add Supplier </a></li>--}}
                    {{--                            <li><a href="{{url('vendor-all-list')}}"> Supplier List </a></li>--}}
                    {{--                        </ul>--}}
                    {{--                    </li>--}}

                    {{--                    <li class="has_sub">--}}
                    {{--                        <a href="{{url('reshelved-product-list')}}" class="waves-effect"><i class="ti-share-alt"></i><span> Reshelved Product </span></a>--}}
                    {{--                    </li>--}}


                    @if (Auth::check() && in_array('1',explode(',',Auth::user()->role)))
                    <!-- <li><a href="{{url('role')}}"><i class="ti-crown"></i><span> Role List</span></a></li> -->
                        {{--                    <li class="has_sub">--}}
                        {{--                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-crown"></i><span> Role </span> <span class="menu-arrow"></span></a>--}}
                        {{--                        <ul class="list-unstyled">--}}
                        {{--                            <li><a href="{{url('role/create')}}"> Add Role </a></li>--}}
                        {{--                            <li><a href="{{url('role')}}"> Role List </a></li>--}}
                        {{--                        </ul>--}}
                        {{--                    </li>--}}
                    @endif
                 {{-- <li class="has_sub">
                        <a href="{{url('manual-order-list')}}" class="waves-effect"><i class="ti-layout-tab-window"></i><span> Manual Order List</span></a>
                    </li> --}}

                {{-- <li class="has_sub">
                        <a href="{{url('user-details/'.Crypt::encrypt(Auth::user()->id))}}" class="waves-effect"><i class="ti-clipboard"></i><span> User History </span></a>
                    </li> --}}

                    {{--                    <li class="has_sub">--}}
                    {{--                        <a href="{{url('notification-page')}}" class="waves-effect"><i class="ti-bell" aria-hidden="true"></i><span> Notification </span> </a>--}}
                    {{--                    </li>--}}

                    @if (Auth::check() && !empty(array_intersect(['1','2'],explode(',',Auth::user()->role))))
                        {{--                        <li class="has_sub">--}}
                        {{--                            <a href="{{url('api/auto-git-pull')}}" class="waves-effect"><i class="ti-link"></i><span>Update</span></a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="has_sub">--}}
                        {{--                            <a href="https://sellercentral-europe.amazon.com/apps/authorize/consent?application_id=amzn1.sp.solution.044f792f-191e-482a-b97a-55fbd88d7319&state=CBC62794911FF31B2864ECD3DBBBEE7EBCB7EA41C5A42E2CBA377F3CFDB42811&redirect_uri=https://woowms.com/wms-1004/amazon-authorization&version=beta" class="waves-effect"><i class="ti-link"></i><span>Update Amazon</span></a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="has_sub">--}}
                        {{--                            <a href="{{url('https://auth.ebay.com/oauth2/authorize?client_id=Mahfuzhu-warehous-PRD-b2eb49443-8e2b8238&response_type=code&redirect_uri=Mahfuzhur_Rahma-Mahfuzhu-wareho-uyhilcaf&scope=https://api.ebay.com/oauth/api_scope https://api.ebay.com/oauth/api_scope/sell.marketing.readonly https://api.ebay.com/oauth/api_scope/sell.marketing https://api.ebay.com/oauth/api_scope/sell.inventory.readonly https://api.ebay.com/oauth/api_scope/sell.inventory https://api.ebay.com/oauth/api_scope/sell.account.readonly https://api.ebay.com/oauth/api_scope/sell.account https://api.ebay.com/oauth/api_scope/sell.fulfillment.readonly https://api.ebay.com/oauth/api_scope/sell.fulfillment https://api.ebay.com/oauth/api_scope/sell.analytics.readonly https://api.ebay.com/oauth/api_scope/sell.finances https://api.ebay.com/oauth/api_scope/sell.payment.dispute https://api.ebay.com/oauth/api_scope/commerce.identity.readonly')}}" class="waves-effect"><i class="ti-link"></i><span> Authorize ebay </span></a>--}}
                        {{--                        </li>--}}
                    @endif
                    {{--                    <li><a href="https://woowms.com/WMS360_App/WMS360_App.apk"><i class="ti-download" aria-hidden="true"></i><span> Download The App </span> </a></li>--}}
                    <!-- <li><a href="{{url('wms/app/download')}}"><i class="ti-download" aria-hidden="true"></i><span> Download The App </span> </a></li> -->
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-panel" aria-hidden="true"></i><span> Channels </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            @if (Auth::check() && in_array('1',explode(',',Auth::user()->role)))
                            <li><a href="{{url('channels')}}">Available Channel </a></li>
                            <li><a href="{{url('channel-integration/1')}}"><span> Integration </span> </a></li>
                            @endif
                            <li><a href="{{url('wms/app/download')}}"><span> Download The App </span> </a></li>
                        </ul>
                    </li>

                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Left Sidebar End -->

    <div class="box" style="display: none">
        <div class="box-inner">

            <div class="noti-title">
                <h5 class="text-overflow text-center pro-text"><small>Welcome ! {{Auth::user()->name}}</small> </h5>
            </div>

            <a class="dropdown-item pro-text text-center btn btn-success w-100" href="{{url('user-details/'.Crypt::encrypt(Auth::user()->id))}}">
                <i class="md md-account-circle"></i> <span>Profile Details</span>
            </a>

            <a class="dropdown-item pro-text text-center btn btn-success wp-myaccount w-100 mt-2" href="https://wms360.co.uk/my-account/">
                <span>My Account</span>
            </a>

            {{-- <h4 class="pt-1">Sidebar Color</h4> --}}
            {{-- <div class="btn-group d-flex justify-content-center align-item-center mt-2 darkLight">
                <div>
                    <button type="button" onclick="changeStyleSheet('style');" class="btn btn-secondary">Dark</button>
                </div>
                <div>
                    <button type="button" onclick="changeStyleSheet('light');" class="btn btn-info">Light</button>
                </div>
            </div> --}}
            <div class="text-center mt-2">
                <button class="btn btn-secondary w-100" type="button" onclick="changeStyleSheet('style');">Dark Sidebar</button>
            </div>

            <div class="text-center mt-2">
                <button class="btn btn-info w-100" type="button" onclick="changeStyleSheet('light');">Light Sidebar</button>
            </div>

            <a class="dropdown-item pro-text text-center btn btn-warning w-100 mt-2" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="md md-settings-power"></i> <span>Logout</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>


    @yield('content')


    <footer class="footer d-flex justify-content-center">
        &copy; 2019 - {{ date('Y') }}. All rights reserved. <a href="https://combosoft.co.uk/"><b class="company-name">&nbsp;Combosoft</b></a>
        <span class="mt-3 text-center" style="position: absolute"><p>{{Session::get('appVersion')}}</p></span>
    </footer>

</div>
<!-- END wrapper -->


<!-- MODAL -->
<div id="dialog" class="modal-block mfp-hide">
    <section class="card p-20">
        <header class="panel-heading">
            <h4 class="panel-title mt-0">Are you sure?</h4>
        </header>
        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="modal-text">
                    <p>Are you sure that you want to delete this row?</p>
                </div>
            </div>

            <div class="row m-t-20">
                <div class="col-md-12 text-right">
                    <button id="dialogConfirm" class="btn btn-success waves-effect waves-light">Confirm</button>
                    <button id="dialogCancel" class="btn btn-danger waves-effect">Cancel</button>
                </div>
            </div>
        </div>

    </section>
</div>

<!-- Edit Order Address modal start -->
<div class="modal fade" id="modifyOrderAddress">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-purple">
                <h4 class="modal-title text-white p-1">Edit Order Address</h4>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form action="javascript:void(0)" id="shippingForm">
                <div class="modal-body">
                    <h6>Order Information</h6>
                    <input type="hidden" name="order_id" id="order_id" value="">
                    <input type="hidden" name="order_type" id="order_type" value="">
                    <div class="form-row" id="order-address-info">

                    </div>
                    </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary update-order-address">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Order Address modal end -->

<!-- DPD service modal start -->
<div class="modal fade" id="dpdShippingModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-purple">
                <h4 class="modal-title text-white p-1">DPD Shipping Information</h4>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form action="javascript:void(0)" id="dpdShippingForm">
            <div class="modal-body">
                <h6>Delivery Information</h6>
                    <div class="row border mx-1 my-2 p-2" id="dpd_shipping_details"></div>
                    <input type="hidden" name="order_id_for_dpd" id="order_id_for_dpd" value="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="shipping_date" class="required">Shipping / Collection Date</label>
                            <input type="date" class="form-control" name="shipping_date" value="{{date('Y-m-d')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="services" class="required">Services</label>
                            <select class="form-control select2" name="services" id="dpd_services" required></select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="number_of_parcel" class="required">Number Of Parcel</label>
                            <input type="text" class="form-control" name="number_of_parcel" value="1" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="total_weight" class="required">Total Weight (kg)</label>
                            <input type="text" class="form-control" name="total_weight" id="total_weight" value="" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="parcel_description" class="required">Parcel Description</label>
                            <input type="text" class="form-control" name="parcel_description" id="parcel_description" value="" required>
                        </div>
                        <div class="form-group col-md-6" id="export_reason">

                        </div>
                    </div>

                    <div class="form-row" id="invoice_terms_type"></div>
                    <div class="row mx-1 my-2 p-2" id="parcel_products"></div>

                </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary send-dpd-order">Create</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- DPD service modal end -->

<!-- <div id="Load" class="load" style="display: none;">
    <div class="load__container">
        <div class="load__animation"></div>
        <div class="load__mask"></div>
        <span class="load__title">Content id loading...</span>
    </div>
</div> -->
<!-- end Modal -->

<!-- jQuery -->
<!-- <script src="{{asset('assets/js/jquery.min.js')}}"></script> -->
<script src="{{asset('assets/js/popper.min.js')}}"></script><!-- Popper for Bootstrap -->
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/detect.js')}}"></script>
<script src="{{asset('assets/js/fastclick.js')}}"></script>
<script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('assets/js/jquery.blockUI.js')}}"></script>
<script src="{{asset('assets/js/waves.js')}}"></script>
<script src="{{asset('assets/js/wow.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('assets/js/jquery.scrollTo.min.js')}}"></script>
<!-- App js -->
<script src="{{asset('assets/js/jquery.core.js')}}"></script>
<script src="{{asset('assets/js/jquery.app.js')}}"></script>

<!-- Required datatable js -->
{{-- <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>--}}
{{-- <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>--}}

<!--- form validation parsely js----->
<script src="{{asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>

<!--form validation init-->
<script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>

<!--JS cookies--->
<script src="{{asset('assets/js/js.cookie.js')}}"></script>

{{--<!----- ckeditor summernote ------->--}}
{{--<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>--}}

<!-- date clock picker-->
{{--<script src="{{asset('assets/plugins/moment/moment.js')}}"></script> <!-- for range picker-->--}}
{{--<script src="{{asset('assets/plugins/timepicker/bootstrap-timepicker.js')}}"></script>--}}
{{--<script src="{{asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/pages/jquery.form-pickers.init.js')}}"></script>--}}
{{--<script src="{{asset('assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script> <!-- for range picker-->--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>


<script>

    function check_delete(name) {
        var check = confirm('Are you sure you want to delete this '+name+' ?');
        if(check){
            return true;
        }else{
            return false;
        }
    }

    function deleteConfirmationMessage(catalogue,id){
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure to delete this ' + catalogue + '?',
            text: "If you delete, all it's associates information will also be deletle",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // $('#' + formId).submit();
                var url = "{{url('product-draft')}}"+'/'+id
                var token = "{{ csrf_token() }}"
                $.ajax({
                    url: url,
                    type: "DELETE",
                    data: {
                        "_token": token,
                    },
                    success: function(response){
                        // console.log(response.success)
                        if(response.message){
                            Swal.fire(response.message,'','success')
                        }
                        if(response.catalog_not_found){
                            Swal.fire(response.catalog_not_found,'','error')
                        }
                        if(response.error){
                            Swal.fire(response.error,'','error')
                        }
                    }
                })
            }
        })
    }
    var resizefunc = [];



    //color changer animation toggle
    $(document).ready(function(){
        $(".slide-toggle").click(function(){
            $(".box").animate({
                width: "toggle"
            });
        });
        //Pagination and OnOff switch button area
        $('.pagination-apply').on('click',function () {
            var screenOption = {};
            $('.onoffswitch-checkbox[name]').each(function (){
                var fieldName = $(this).attr("name");
                screenOption[fieldName] = $('#'+fieldName).is(':checked') == true ? 1 : 0;
            })
            var page = $('.pagination-count').val();
            var arrFirstKey = $('#firstKey').val();
            var arrSecondKey = $('#secondKey').val();
            $.ajax({
                type: "post",
                url: "{{url('save-setting')}}",
                data: {
                    "_token" : "{{csrf_token()}}",
                    "per_page" : page,
                    "screen_option" : screenOption,
                    "arrFirstKey" : arrFirstKey,
                    "arrSecondKey" : arrSecondKey
                },
                beforeSend: function () {
                    $('#ajax_loader').show();
                },
                success: function (response) {
                    console.log(response);
                    // $('span.pagination-mgs-show').html(response.data);
                    Swal.fire({
                        icon: 'success',
                        html: response.data,
                        confirmButtonText: "Wait for while!!",
                    }).then(function(isConfirm){
                        if(isConfirm){
                            location.reload();
                        }
                    });setTimeout(function() {
                        window.location.reload();
                    }, 500);
                },
                complete: function () {
                    $('#ajax_loader').hide();
                }
            })
        });
        //Pagination and OnOff switch button area

        $(document).on('click','.clear-params',function(){
            var url = $('input[name="route_name"]').val()
            $.ajax({
                type: 'get',
                url: "{{asset('/')}}"+url+'?is_clear_filter=true',
                beforeSend: function(data){
                    $('#product_variation_loading').show()
                },
                success: function(response){
                    console.log(response);
                    $('tbody').html(response.html);
                    $('table thead tr th').each(function(){
                        console.log(response.html)
                        $(this).find('input:text,select').val(null)
                        $(this).find('input[type=number]').val(null)
                        $(this).find('input:checkbox').removeAttr('checked')
                        $(this).find('.text-warning').removeClass("text-warning")
                        $(this).find('.select2').val('').trigger('change')
                    })
                    $('#product_variation_loading').hide()
                    //history.pushState({}, "", url)
                    var tr_row_catalog = $('.catalog-table #search_reasult .search-tr').length
                    var tr_row = $('.draft_search_result #woocomtdody .search-tr').length
                    var tr_row_onbuy = $('.onbuy-table tbody .search-tr').length
                    var tr_row_ebay = $('.ebay-table tbody .search-tr').length
                    if(tr_row > 3){
                        $('.catalog .card-box').removeClass('table-column-filter-issue')
                    }
                    if(tr_row_catalog > 3){
                        $('.catalog .card-box').removeClass('table-column-filter-issue')
                    }
                    if(tr_row_onbuy > 3){
                        $('.catalog .card-box').removeClass('table-column-filter-issue')
                    }
                    if(tr_row_ebay > 3){
                        $('.catalog .card-box').removeClass('table-column-filter-issue')
                    }
                },
                complete: function(){
                    $('#product_variation_loading').hide()
                }
            })
            $(this).closest("div").remove()
        })

    }); 



    //stylesheet color changer js cookies
    function changeStyleSheet(filez = 'style') {
        let base_path = '{{asset('assets/css/')}}/';

        Cookies.remove('mode', { path: '/' });

        $('[data-style-sheet]').attr('href', base_path + filez + '.css');
        console.log(base_path + filez + '.css');
        Cookies.set('mode', filez, { expires: 365, path: '/' });
    }


    //prevent onclick dropdown menu close
    $('.filter-content').on('click', function(event){
        event.stopPropagation();
    });


    //WMS ALL CHANNEL ID ONCLICK TEXT COPIER
    function textCopiedID(el){
        var inp = document.createElement('input');
        document.body.appendChild(inp);
        inp.value = el.textContent;
        inp.select();
        document.execCommand('copy',false);
        inp.remove();
        var tt = el.parentNode.querySelector(".wms__id__tooltip__message");
        tt.style.display = "inline";
        setTimeout( function() {
            tt.style.display = "none";
        }, 1000);
    }

    //WMS ALL CHANNEL SKU ONCLICK TEXT COPIER
    function wmsSkuCopied(el){
        var inp = document.createElement('input');
        document.body.appendChild(inp);
        inp.value = el.textContent;
        inp.select();
        document.execCommand('copy',false);
        inp.remove();
        var tt = el.parentNode.querySelector(".wms__sku__tooltip__message");
        tt.style.display = "inline";
        setTimeout( function() {
            tt.style.display = "none";
        }, 1000);
    }


    function wmsOrderPageTextCopied(el){
        var inp = document.createElement('input');
        document.body.appendChild(inp);
        inp.value = el.textContent;
        inp.select();
        document.execCommand('copy',false);
        inp.remove();
        var tt = el.parentNode.querySelector(".wms__order__page__tooltip__message");
        tt.style.display = "inline";
        setTimeout( function() {
            tt.style.display = "none";
        }, 1000);
    }


    $(document).ready(function () {
        $("#ckbCheckAll").click(function () {
            $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        });

        $(".checkBoxClass").change(function(){
            if (!$(this).prop("checked")){
                $("#ckbCheckAll").prop("checked",false);
            }
        });
    });


    function product_description(e){
        $(e).toggleClass('primary-color text-white hide')
        $(e).next('.product-description-content').toggleClass('hide')
        $(e).find('.fa-arrow-down').toggleClass('hide')
        $(e).find('.fa-arrow-up').toggleClass('hide')
    }

    function ebay_product_description(e){
        $(e).toggleClass('primary-color text-white')
        $(e).next('.product-description-content').toggleClass('hide')
        $(e).find('.fa-arrow-down').toggleClass('hide')
        $(e).find('.fa-arrow-up').toggleClass('hide')
    }


    // if(Cookies.get('mode')) {
    //     changeStyleSheet(Cookies.get('mode'));
    // }
    {{--$(document).ready(function(){--}}
    {{--    setInterval(function(){--}}
    {{--        $.ajax({--}}
    {{--            type: "POST",--}}
    {{--            url: "{{url('complete-order-general-search')}}",--}}
    {{--            data: {--}}
    {{--                "_token" : "{{csrf_token()}}",--}}
    {{--                "search_value" : '69817',--}}
    {{--                "order_search_status" : 'processing'--}}
    {{--            },--}}
    {{--            success: function( response ) {--}}
    {{--                console.log(response);--}}
    {{--                $('table tbody tr').remove();--}}
    {{--                $('table tbody').append(response);--}}
    {{--                // update div--}}
    {{--            }--}}
    {{--        });--}}
    {{--    },5000);--}}
    {{--});--}}


    // Entire table row column display
    // $("#display-all").click(function(){
    //     $("table tr th, table tr td").show();
    //     $(".column-display .checkbox input[type=checkbox]").prop("checked", "true");
    // });
    //
    //
    // After unchecked any column display all checkbox will be unchecked
    // $(".column-display .checkbox input[type=checkbox]").change(function(){
    //     if (!$(this).prop("checked")){
    //         $("#display-all").prop("checked",false);
    //     }
    // });

    //Datatable row-wise searchable option
    // $(document).ready(function(){
    //     $("#row-wise-search").on("keyup", function() {
    //         let value = $(this).val().toLowerCase();
    //         $("#table-body tr").filter(function() {
    //             $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //         });
    //
    //     });
    // });

    //table header-search option toggle
    // $(document).ready(function(){
    //     $(".header-search").click(function(){
    //         $(".header-search-content").toggle();
    //     });
    // });
    $('.variation-term-select2').select2({
            matcher: matchCustom
    })
    function matchCustom(params, data) {
        // If there are no search terms, return all of the data
        if ($.trim(params.term) === '') {
        return data;
        }
        // Do not display the item if there is no 'text' property
        if (typeof data.text === 'undefined') {
        return null;
        }
        // `params.term` should be the term that is used for searching
        // `data.text` is the text that is displayed for the data object
        // if (data.text.indexOf(params.term) > -1) {
        if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) === 0) {
        var modifiedData = $.extend({}, data, true);
        // You can return modified objects from here
        // This includes matching the `children` how you want in nested data sets
        return modifiedData;
        }
        // Return `null` if the term should not be displayed
        return null;
    }

        $('#orderTable').on('click','.edit-address',function(){
            $('#ajax_loader').show()
            var orderId = $(this).attr('data')
            var orderType = $(this).attr('shipping-type')
            if((orderId == '') || (orderType == '')){
                $('#ajax_loader').hide()
                Swal.fire('Oops!','Order Not Found','error')
                return false
            }
            var url = "{{asset('/edit-order-address')}}"
            var token = "{{csrf_token()}}"
            var dataObj = {
                orderId: orderId,
                orderType: orderType,
            }
            return fetch(url,{
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                method: 'post',
                body: JSON.stringify(dataObj)
            })
            .then(response => {
                if(!response.ok){
                    throw new Error(response.statusText)
                }
                return response.json()
            })
            .then(data => {
                if(data.type == 'success'){
                    $('#modifyOrderAddress #order_id').val(orderId)
                    $('#modifyOrderAddress #order_type').val(orderType)
                    $('#modifyOrderAddress #order-address-info').html(data.dataHtmlData)
                    $('#modifyOrderAddress').modal('show');
                }else{
                    Swal.fire('Oops!',data.msg,'error')
                }
                $('#ajax_loader').hide()
            })
            .catch(err => {
                $('#ajax_loader').hide()
            })
        })

        $('#orderTable').on('click','.create-dpd-order',function(){
        // var html = '<div class="form-group">'
        //     +'<label for="country">Collection Country</label>'
        //     +'<input type="text" class="form-control" id="collectionCountry" value="GB" placeholder="Enter Collection Country">'
        //     +'<label for="postcode">Collection Postcode</label>'
        //     +'<input type="text" class="form-control" id="collectionPostcode" value="DA9 9EZ" placeholder="Enter Collection Postcode">'
        // +'</div>'
        var orderNumber = $(this).attr('data')
        // Swal.fire({
        //     title: 'Are you sure ?',
        //     text: 'This will create an order in DPD',
        //     html:html,
        //     confirmButtonText: 'Yes',
        //     showCancelButton: true,
        //     cancelButtonColor: '#d33',
        //     showLoaderOnConfirm: true,
        //     preConfirm: (function(){
                // var collectionCountry = Swal.getPopup().querySelector('#collectionCountry').value
                // var collectionPostcode = Swal.getPopup().querySelector('#collectionPostcode').value
                // if((collectionCountry == '') || (collectionPostcode == '')){
                //     Swal.showValidationMessage(`Enter Valid Value`)
                //     return false
                // }
                $('#ajax_loader').show();
                var url = "{{asset('/shipping/dpd/fetch-dpd-available-info')}}"
                var token = "{{csrf_token()}}"
                var dataObj = {
                    orderNumber: orderNumber,
                    collectionCountry: 'GB',
                    collectionPostcode: 'DA9 9EZ'
                }
                return fetch(url,{
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    method: 'post',
                    body: JSON.stringify(dataObj)
                })
                .then(response => {
                    if(!response.ok){
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .then(data => {
                    if(data.type == 'success'){
                        $('#order_id_for_dpd').val(data.order_info.id)
                        $('#dpd_shipping_details').html(data.shipping_info)
                        $('select#dpd_services').html(data.services)
                        $('#export_reason').html(data.export_reason)
                        $('#invoice_terms_type').html(data.invoice_term_type)
                        $('#total_weight').val(data.total_weight)
                        $('#parcel_description').val(data.parcel_description)
                        if(data.parcel_products != ''){
                            $('#parcel_products').addClass('border')
                            $('#parcel_products').html(data.parcel_products)
                        }
                        $('#dpdShippingModal').modal('show');
                    }else{
                        Swal.fire('Oops!',data.msg,'error')
                    }
                    $('#ajax_loader').hide();
                })
                .catch(err => console.log(err))
        //     })
        // })
    })

    $('#dpdShippingModal').on('input','.number_of_item,.unit_weight,.unit_value',function(){
        var totalItemsArr = []
        var totalUnitWeightsArr = []
        var totalUnitValuesArr = []
        $('.number_of_item').each(function(){
            var numberOfItem = $(this).val()
            totalItemsArr.push(numberOfItem)
        })
        $('.unit_weight').each(function(){
            var unitWeight = $(this).val()
            totalUnitWeightsArr.push(unitWeight)
        })
        $('.unit_value').each(function(){
            var unitValue = $(this).val()
            totalUnitValuesArr.push(unitValue)
        })
        var totalPrice = 0
        var totalWeight = 0
        var shippingCost = parseFloat($('#order_shipping_cost').text())
        totalItemsArr.forEach(function(item,index){
            totalPrice += (item * totalUnitValuesArr[index])
        })
        totalItemsArr.forEach(function(item,index){
            totalWeight += (item * totalUnitWeightsArr[index])
        })
        var totalPriceWithShipping = (totalPrice + shippingCost).toFixed(2)
        $('#total_weight').val(totalWeight)
        $('#total_price').val(totalPriceWithShipping)
        $('#order_total_without_shipping').text(totalPrice.toFixed(2))
    })

    $("#dpdShippingForm").submit(function(e) {
        e.preventDefault(); // prevent actual form submit
        var jsonData = convertFormToJSON($(this));
        if(jsonData.services == ''){
            Swal.fire('Oops!','Please Select a Service')
            return false
        }
        if((jsonData.number_of_parcel <= 0) ||(jsonData.number_of_parcel == '')){
            Swal.fire('Oops!','Number Of Parcel Must Be Valid')
            return false
        }
        if((jsonData.total_weight <= 0) ||(jsonData.number_of_parcel == '')){
            Swal.fire('Oops!','Total Weight Must Be Valid')
            return false
        }
        if(jsonData.parcel_description == ''){
            Swal.fire('Oops!','Parcel Description Must Be Valid')
            return false
        }
        $("#ajax_loader").show();
        var url = "{{asset('shipping/dpd/create-dpd-order')}}"; //get submit url [replace url here if desired]
        var token = "{{csrf_token()}}"
        return fetch(url, {
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token
            },
            method: 'post',
            body: JSON.stringify(jsonData)
        })
        .then(response => {
            return response.json()
        })
        .then(data => {
            if(data.type == 'success'){
                $('#dpdShippingModal').modal('hide');
                Swal.fire('Success',data.msg,'success')
            }else{
                Swal.fire('Oops!',data.msg,'error')
            }
            $("#ajax_loader").hide();
        })
        .catch(err => {
            Swal.fire('Oops!',err,'error')
        })
    })

        function convertFormToJSONData(form) {
            const array = $(form).serializeArray(); // Encodes the set of form elements as an array of names and values.
            const json = {};
            $.each(array, function () {
                json[this.name] = this.value || "";
            });
            return json;
        }

        $('#shippingForm').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var jsonData = convertFormToJSONData($(this));
            $("#ajax_loader").show();
            var url = "{{asset('update-order-address')}}"; //get submit url [replace url here if desired]
                var token = "{{csrf_token()}}"
                return fetch(url, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    method: 'post',
                    body: JSON.stringify(jsonData)
                })
                .then(response => {
                    return response.json()
                })
                .then(data => {
                    if(data.type == 'success'){
                        $('#modifyOrderAddress').modal('hide');
                        Swal.fire('Success',data.msg,'success')
                        window.location.reload()
                    }else{
                        Swal.fire('Oops!',data.msg,'error')
                    }
                    $("#ajax_loader").hide();
                })
                .catch(err => {
                    Swal.fire('Oops!',err,'error')
                })
        })


    function convertFormToJSON(form) {
        const array = $(form).serializeArray(); // Encodes the set of form elements as an array of names and values.
        const json = {};
        $.each(array, function () {
            json[this.name] = this.value || "";
        });
        return json;
    }

    $(document).ready(function(){
        var tr_length = $('.order-table tbody tr').length
        var tr_length_pro_draft = $('.product-draft-table tbody tr').length
        var tr_length_onbuy = $('.onbuy-table tbody tr').length
        var tr_length_ebay = $('.ebay-table tbody tr').length
        var tr_length_amazon = $('.amazon-table tbody tr').length
        // alert(tr_length_supplier)
        if(tr_length == 0 || tr_length == 1 || tr_length == 2 || tr_length == 3){
            $('.order-content .card-box').addClass('table-column-filter-issue')
        }else if(tr_length > 3){
            $('.order-content .card-box').addClass('table-column-filter-issue-pad')
        }
        if(tr_length_pro_draft == 0 || tr_length_pro_draft == 1 || tr_length_pro_draft == 2 || tr_length_pro_draft == 3){
            $('.catalog .card-box').addClass('table-column-filter-issue')
        }else if(tr_length_pro_draft > 3){
            $('.catalog .card-box').addClass('table-column-filter-issue-pad')
        }
        if(tr_length_onbuy == 0 || tr_length_onbuy == 1 || tr_length_onbuy == 2 || tr_length_onbuy == 3){
            $('.catalog .card-box').addClass('table-column-filter-issue')
        }else if(tr_length_onbuy > 3){
            $('.catalog .card-box').addClass('table-column-filter-issue-pad')
        }
        if(tr_length_ebay == 0 || tr_length_ebay == 1 || tr_length_ebay == 2 || tr_length_ebay == 3){
            $('.catalog .card-box').addClass('table-column-filter-issue')
        }else if(tr_length_ebay > 3){
            $('.catalog .card-box').addClass('table-column-filter-issue-pad')
        }
        if(tr_length_amazon == 0 || tr_length_amazon == 1 || tr_length_amazon == 2 || tr_length_amazon == 3){
            $('.catalog .card-box').addClass('table-column-filter-issue')
        }else if(tr_length_amazon > 3){
            $('.catalog .card-box').addClass('table-column-filter-issue-pad')
        }

        $('table.receive-invoice-modal-table tbody').on('click','.create-royal-mail-order',function(){
            var orderNumber = $(this).attr('data')
            if((orderNumber == '') || (orderNumber == 'undefined') || (orderNumber == null)){
                Swal.fire('Oops!','Order Number Not Found','error')
                return false
            }
            var url = "{{url('create-royal-mail-order')}}"
            var token = "{{csrf_token()}}"
            var html = '<div class="form-group">'
                            +'<label class="required">Weight In Grams</label>'
                            +'<input type="text" class="form-control" id="weight_in_gram" placeholder="Enter The Parcel Weight" required>'
                        +'</div>'
                        +'<div class="form-group">'
                            +'<label class="required">Package Format</label>'
                            +'<select class="form-control" id="package_format" required>'
                            +'<option value="">Select Package</option>'
                            +'<option value="letter">Letter</option>'
                            +'<option value="largeLetter">LargeLetter</option>'
                            +'<option value="smallParcel">SmallParcel</option>'
                            +'<option value="mediumParcel">MediumParcel</option>'
                            +'<option value="parcel">Parcel</option>'
                            +'<option value="documents">Documents</option>'
                            +'<option value="undefined">Undefined</option>'
                            +'</select>'
                        +'</div>'
                        +'<div class="form-group">'
                            +'<label>Special Instruction</label>'
                            +'<input type="text" class="form-control" id="special_instruction" placeholder="Enter Special Instruction">'
                        +'</div>'
            Swal.fire({
                title: 'Create Order In Royal Mail',
                html: html,
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                showLoaderOnConfirm: true,
                preConfirm: function(){
                    var packageWeight = Swal.getPopup().querySelector('#weight_in_gram').value
                    var packageFormat = Swal.getPopup().querySelector('#package_format').value
                    var specialInstruction = Swal.getPopup().querySelector('#special_instruction').value
                    console.log(packageWeight,packageFormat)
                    if((packageWeight == '') || (packageFormat == '')){
                        Swal.showValidationMessage(`Enter Valid Value`)
                        return false
                    }
                    var dataObj = {
                        orderNumber: orderNumber,
                        packageWeight: packageWeight,
                        packageFormat: packageFormat,
                        specialInstruction: specialInstruction,
                    }
                    return fetch(url,{
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        method: 'post',
                        body: JSON.stringify(dataObj)
                    })
                    .then(response => {
                        if(!response.ok){
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .then(data => {
                        if(data.type == 'success'){
                            Swal.fire('Success',data.msg,'success')
                        }else{
                            Swal.fire('Oops!',data.msg,'error')
                        }
                    })
                    .catch(error => {
                        Swal.showValidationMessage(`Request Failed: ${error}`)
                    })
                }
            })
        })
    })

    function sidebar_humberger_btn(){
        var input_value = $('#sidebar-humberger-btn').val()
        if(input_value == 1){
            $('#sidebar-humberger-btn').val(0)
            var input_value = $('#sidebar-humberger-btn').val()
        }else{
            $('#sidebar-humberger-btn').val(1)
            var input_value = $('#sidebar-humberger-btn').val()
        }
        console.log(input_value);
        $.ajax({
            url: "{{asset('sidebar-humberger-btn-expand-collapse')}}",
            type: "post",
            data: {
                "_token" : "{{csrf_token()}}",
                "sidebar_humberger_btn_value" : input_value
            },
            success: function(response){
                console.log(response.data)
            }
        })
    }

    // From dispatched order cancel order modal then get response this modal.
    $(document).ready(function(){
        var returnProductText = $('div#returnOrderSuccessMsg').text()
        if(returnProductText != ''){
            Swal.fire({
            icon: 'success',
            title: 'Return product added successfully. Do you want to restock this product?',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Restock',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('div#receive-invoice-modal').show()
                }
            })
        }
    })

    $('button.remove-more-invoice').on('click',function(){
        var trCount = $('tr.invoice-row').length
        if(trCount != 1){
            $(this).closest('tr').remove()
        }
    })

    // From manage variation, this modal has used for only new product.
    $(document).ready(function(){
        var NewProductText = $('div#new_product_success').text()
        var product_draft_id = $('input[name="product_draft_id"]').val()
        if(NewProductText != ''){
            Swal.fire({
            icon: 'success',
            title: 'New product added successfully. Do you want to receive invoice this product?',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Receive',
            showLoaderOnConfirm: true,
            preConfirm:function(){
                return new Promise(function(resolve){
                    receive_invoice_modal(null,product_draft_id,null,null,null,null)
                })
            },
            allowOutsideClick: false
            })
        }
    })


    // parameters: id(catalogue ID), order_id(order ID), type(return or not), return_id(Return Order ID), variation_id(Product variation ID)
    function receive_invoice_modal(e,id,order_id,type,return_id,variation_id){
        $('tr.bg-highlight').removeClass('bg-highlight')
        $('div.single-variation-invoice-receive').removeClass('bg-highlight')
        if (type == 'return'){
            if(variation_id == null){
                var url = "{{url('catalogue-product-invoice-receive')}}"+'/'+id+'/'+order_id+'/'+type+'/'+return_id
            }else{
                var url = "{{url('catalogue-product-invoice-receive')}}"+'/'+id+'/'+order_id+'/'+type+'/'+return_id+'/'+variation_id
            } 
        }else{
            if(order_id == null){
                var url = "{{url('catalogue-product-invoice-receive')}}"+'/'+id 
            }else{
                var url = "{{url('catalogue-product-invoice-receive')}}"+'/'+id+'/'+order_id //here order_id is a product variation id 
            }
        }
        $.ajax({
            type: "get",
            url: url,
            beforeSend: function(){
                $("#ajax_loader").show()
            },
            success: function(response){
                // console.log(response.invoice_part)
                $(e).closest('tr').addClass('bg-highlight')
                $(e).closest('div.single-variation-invoice-receive').addClass('bg-highlight')
                $('table.order-table').after(response.invoice_part)
                $('table.catalog-table').after(response.invoice_part)
                $('table.add-pro-table').after(response.invoice_part)
                swal.close()
                $('#receive-invoice-modal').show()
                $('select.shelver_user_id').first().on('change',function(){
                    var getFirstSelectedValue = $(this).val()
                    $('select.shelver_user_id option').each(function(){
                        if(this.value == getFirstSelectedValue){
                            $(this).attr('selected','selected')
                        }
                    })
                })

                $("table.receive-invoice-modal-table tbody").on('change','.product-unit-cost',function () {
                    var product_variation_id = $(this).val();
                    var row_count_string = $(this).attr('id').split('product_variation_id_');
                    var row_count = row_count_string[1];
                    var return_order_id = $('#return_order_id').val();
                    var tr = $(this).closest('tr')
                    var trNumber = $('table.receive-invoice-modal-table tbody tr').index(tr)
                    var variationIds = []
                    var variationIds = putSelectedVariationIdToArray(variationIds)

                    showHideDropdownSku(variationIds)

                    if(product_variation_id == ''){
                        $('#variation-show_'+row_count).html('No Variation');
                        return false;
                    }
                    $.ajax({
                        type: "POST",
                        url: "{{url('/get-quantity')}}",
                        data: {
                            "_token" : "{{csrf_token()}}",
                            "product_variation_id" : product_variation_id,
                            "order_id" : return_order_id
                        },
                        success: function (data) {
                            $('#variation-show_'+row_count).html(data.variation);
                            $('#quantity'+row_count).val(data.quantity);
                            $('#qr_'+row_count).append(data.qr_code);
                            let exitCost = $('#price'+row_count).val()
                            $('#price'+row_count).val(exitCost != '' ? exitCost : data.cost_price);
                            addMoreButtonShowHide()
                            selectAllButtonShowHide()
                        },
                        error: function (jqXHR, exception) {

                        }
                    })

                });

                $('button.receive-all-product').on('click',function(){
                    var firstShelverDiv = $('.invoice-row').first().find('.shelver_user_id')
                    var firstShelverContent = firstShelverDiv.html()
                    var firstShelverId = firstShelverDiv.val()
                    var shelver = ''
                    if(firstShelverId == ''){
                        var content = '<select id="shelver_user_id" class="form-control shelver_user_id" name="shelver_user_id[]" required>'+firstShelverContent+'</div>'
                        Swal.fire({
                            title: 'Choose Shelver',
                            html: content,
                            showCancelButton: true,
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes',
                            showLoaderOnConfirm: true,
                            preConfirm: () => {
                                var shelver = Swal.getPopup().querySelector('#shelver_user_id').value
                                if(shelver == ''){
                                    Swal.showValidationMessage(`Select Shelver`)
                                    return false
                                }
                                $('td.shelver-td .shelver_user_id > option').each(function(){
                                    if(this.value == shelver){
                                        $(this).attr('selected','selected')
                                    }
                                })
                                bulkReceiveRow(shelver)
                            }
                        })
                        return false
                    }else{
                        bulkReceiveRow(firstShelverId)
                    }
                })

                $(".product_type").on('change',function () {
                    var product_type = $(this).val();
                    var row_count_string = $(this).attr('id').split('product_type_');
                    var row_count = row_count_string[1];
                    if(product_type == 0){
                        $('#shelver_user_id'+row_count).attr("required", false);
                        $('#shelver_user_id'+row_count).hide();
                        return false;
                    }else{
                        $('#shelver_user_id'+row_count).show();
                        $('#shelver_user_id'+row_count).attr("required", true);
                        return false;
                    }
                });

                // var cost_price = $('#cost_price').val();
                // document.getElementById('price').value = cost_price;

                $('.add-more-invoice').on('click', function () {
                    var firstShelverTd = $('.invoice-row').first()
                    var firstShelverDiv = firstShelverTd.find('.shelver_user_id')
                    var firstShelverId = firstShelverDiv.val()
                    if(firstShelverId == ''){
                        firstShelverDiv.addClass('border border-danger')
                        firstShelverTd.find('.shelver-td span').removeClass('hide').addClass('d-block')
                        return false
                    }else{
                        firstShelverDiv.removeClass('border border-danger')
                        firstShelverTd.find('.shelver-td span').removeClass('d-block').addClass('hide')
                    }
                    addMoreButtonShowHide()
                    $('.invoice-row').first().clone(true).appendTo('table.receive-invoice-modal-table tbody').each(function () {
                        var add_card_id = $('table.receive-invoice-modal-table tbody tr').length;
                        $(this).find('.product-unit-cost').attr("id","product_variation_id_"+add_card_id);
                        $(this).find('.variation_show').attr("id","variation-show_"+add_card_id);
                        $(this).find('input.quantity').attr("id","quantity"+add_card_id);
                        $(this).find('input.unit-price').attr("id","price"+add_card_id);
                        $(this).find('td.qr').attr("id","qr_"+add_card_id)
                        $(this).find('select.shelver_user_id').attr("id","shelver_user_id"+add_card_id);
                        $(this).find('.product_type').attr("id","product_type_"+add_card_id);
                        $('#quantity'+add_card_id).val(null);
                        $('#price'+add_card_id).val(null);
                        $('#variation-show_'+add_card_id).html('No Variation');
                        $('#qr_'+add_card_id).text(null)
                        var shelver_id = $('#shelver_user_id1 option:selected').val();
                        var value_check = '#shelver_user_id'+add_card_id;
                        $('#shelver_user_id'+add_card_id).show();
                        $('#shelver_user_id'+add_card_id).attr("required", true);
                        $(value_check+" option").each(function(){
                            if($(this).val()==shelver_id){
                                $(this).attr("selected","selected");
                            }
                        });

                    })
                });
                $('table.receive-invoice-modal-table tbody').on('click','.remove-more-invoice', function () {
                    let value = $('table.receive-invoice-modal-table tbody tr').length;
                    var variationIds = []
                    if(value > 1) {
                        $(this).closest('tr').remove()
                        var variationIds = mapSelectedVariationIdToArray(variationIds)
                        var count = 1
                        $('table.receive-invoice-modal-table tbody tr').each(function(i, data){
                            $(this).find('.product-unit-cost').attr('id','product_variation_id_'+count)
                            $(this).find('.variation_show').attr("id","variation-show_"+count);
                            $(this).find('input.quantity').attr("id","quantity"+count);
                            $(this).find('input.unit-price').attr("id","price"+count);
                            $(this).find('select.shelver_user_id').attr("id","shelver_user_id"+count);
                            $(this).find('.product_type').attr("id","product_type_"+count);
                            var shelver_id = $('#shelver_user_id1 option:selected').val();
                            var value_check = '#shelver_user_id'+count;

                            $(this).find(".product-unit-cost > option").each(function(i){
                                if(variationIds.includes($(this).val()) == true){
                                    $(this).css('display','none')
                                }else{
                                    $(this).css('display','block')
                                }
                            })
                            count++
                        })
                    }else{
                        return false;
                    }
                    addMoreButtonShowHide()
                    selectAllButtonShowHide()
                });

                $(".searchbox").val($("#listBox1 :selected").val());

                $("#product_variation_id").on('change',function () {
                    if(document.getElementById('return_order_checkbox').checked) {
                        var product_variation_id = $('select[name=product_variation_id]').val();
                        var order_id = $('select[name=order_id]').val();

                        $.ajax({
                            type: 'POST',
                            url: '{{url('/get-quantity').'?_token='.csrf_token()}}',
                            data: {
                                'product_variation_id': product_variation_id, 'order_id': order_id
                            },
                            success: function (data) {
                                document.getElementById('quantity').readOnly = true;
                                document.getElementById('quantity').value = data.return_product_quantity;
                                document.getElementById('return_order_product_id').value = data.id;
                            },
                            error: function (jqXHR, exception) {

                            }
                        })
                    }else{
                        document.getElementById('quantity').readOnly = false;
                    }
                });

                $("#invoice_number").on('input', function () {
                    var invoice_number = $('input[name=invoice_number]').val();
                    if(invoice_number == ''){
                        $('#livesearch').hide();
                        return false;
                    }
                    $.ajax({
                        type:'POST',
                        url:'{{url('/invoice/number').'?_token='.csrf_token()}}',
                        data: {
                            'invoice_number' : invoice_number
                        },
                        success:function(data) {
                            $('#livesearch').show();
                            var res = '';
                            document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                            if($.trim(data)){
                                Object.keys(data).forEach(function(key,value) {
                                    Object.keys(data[value]).forEach(function(key1,value1) {
                                        res +='<option style="cursor:pointer">' + data[value][key1] +'</option' +"<br>";
                                    })
                                });
                                document.getElementById("livesearch").innerHTML=res;
                            }
                            if(!$.trim(data)){
                                document.getElementById("livesearch").innerHTML= 'no match found';
                            }
                        },
                        error: function(jqXHR, exception) {

                        }
                    });
                });
                $('#livesearch').on('click',function (event) {
                    var value = $(event.target).text();
                    $.ajax({
                        type: 'POST',
                        url: '{{url('/get-vendor').'?_token='.csrf_token()}}',
                        data: {
                            'invoice_number': value
                        },
                        success: function (data) {
                            $('select[name="vendor_id"]').find('option[value='+data.vendor_id+']').attr("selected",true);
                            //document.getElementById('vendor_id'). = 1;
                            document.getElementById("livesearch").style.border = "1px solid #A5ACB2";

                        },
                        error: function (jqXHR, exception) {

                        }
                    });
                    document.getElementById("invoice_number").value = value;
                    $('#livesearch').hide();
                    // var value = $(event.target).text();
                    // document.getElementById("invoice_number").value = value;
                    // $('#livesearch').hide();
                });
                $('select#invoice_number').on('change',function (event) {
                    var value = $(this).val();
                    $.ajax({
                        type: 'POST',
                        url: '{{url('/get-vendor').'?_token='.csrf_token()}}',
                        data: {
                            'invoice_number': value
                        },
                        success: function (data) {
                            $('select[name="vendor_id"]').find('option').attr("selected",false);
                            $('select[name="vendor_id"]').find('option[value='+data.vendor_id+']').attr("selected",true);
                            //document.getElementById('vendor_id'). = 1;
                            // document.getElementById("livesearch").style.border = "1px solid #A5ACB2";

                        },
                        error: function (jqXHR, exception) {

                        }
                    });

                    // document.getElementById("invoice_number").value = value;
                });
                $('select[name="vendor_id"]').on('change',function(){
                    var supplierId = $(this).val()
                    if(supplierId == ''){
                        alert('Please select supplier')
                    }
                    $('select[name="invoice_number"] > option').each(function(){
                        if(this.id != ''){
                            if(supplierId == this.id){
                                $("select[name='invoice_number'] option[id=" + this.id + "]").show();
                            }else{
                                $("select[name='invoice_number'] option[id=" + this.id + "]").hide();
                            }
                        }
                    })
                })
            },
            complete: function(){
                $("#ajax_loader").hide()
            }
        })
    }


    function closeReceiveInvoiceModal(e){
        $(e).closest('div.order-content').find('tr.bg-highlight').removeClass('bg-highlight')
        $('tr.bg-highlight').removeClass('bg-highlight')
        $('#receive-invoice-modal').remove()
    }


    // $(document).mouseup(function(e){
    //     var container = $("div#receive-invoice-modal")
    //     if(!container.is(e.target) && container.has(e.target).length === 0) {
    //         container.remove()
    //         $('tr.bg-highlight').removeClass('bg-highlight')
    //     }
    // });

    
    function putSelectedVariationIdToArray(variationIds){
        $('table.receive-invoice-modal-table tbody tr').each(function(i, data){
            $(this).find(".product-unit-cost > option:selected").each(function(i,v) {
                variationIds.push($(this).val())
            });
        })
        return variationIds
    }

    function mapSelectedVariationIdToArray(variationIds){
        $('table.receive-invoice-modal-table tbody tr').each(function(i, data){
            var opt = $(this).find(".product-unit-cost > option:selected").map(function(i,v) {
                variationIds.push(this.value)
            });
        })
        return variationIds
    }

    function showHideDropdownSku(variationIds){
        $('table.receive-invoice-modal-table tbody tr').each(function(i, data){
            $(this).find(".product-unit-cost > option").each(function(i){
                if(variationIds.includes($(this).val()) == true){
                    $(this).css('display','none')
                }else{
                    $(this).css('display','block')
                }
            })
        })
    }

    function addMoreButtonShowHide(){
        var totalVariation = $('span.total-variation').text()
        var count = $('table.receive-invoice-modal-table tbody tr').length;
        if(count >= totalVariation){
            $('.add-more-invoice').addClass('hide')
        }else{
            $('.add-more-invoice').removeClass('hide')
        }
    }

    function selectAllButtonShowHide(){
        var totalVariation = $('span.total-variation').text()
        var count = $('table.receive-invoice-modal-table tbody tr').length;
        if(count < totalVariation){
            $('button.receive-all-product').show()
        }else{
            $('button.receive-all-product').hide()
        }
    }
                    
    // $(".product-unit-cost").on('change',function () {
    //     let prodcut_id = $('.product-unit-cost').val();
    //     $.ajax({
    //         type: "post",
    //         url:"{{url('get-product-price-ajax')}}",
    //         data: {
    //             "_token" : "{{csrf_token()}}",
    //             "prodcut_id" : prodcut_id
    //         },
    //         success: function (response) {
    //             $('#price').val(response.data);
    //         }
    //     })
    // });
    function bulkReceiveRow(shelverId){
        let masterCatalogueId = $('#master_catalogue_id').val() ?? null
        let return_order_id = $('input[name="invoice_type"]').val() ?? null
        console.log(masterCatalogueId,return_order_id)
        $.ajax({
            type: "POST",
            url: "{{url('/get-quantity')}}",
            data: {
                "_token" : "{{csrf_token()}}",
                "master_catalogue_id" : masterCatalogueId,
                "return_order_id" : return_order_id
            },
            success: function (response) {
                var allProductInvoice = ''
                var shelverOption = ''
                $('span.total-variation').text(response.invoice_info.length)
                if(shelverId != undefined){
                    response.shelver_info.users_list.forEach(function(shelver){
                        if(shelver.id == shelverId){
                            shelverOption += '<option value="'+shelver.id+'" selected>'+shelver.name+'</option>'
                        }else{
                            shelverOption += '<option value="'+shelver.id+'">'+shelver.name+'</option>'
                        }
                    })
                }
                var variationIds = []
                var count = 1
                response.invoice_info.forEach(function(invoice){
                    console.log(invoice)
                    allProductInvoice += '<tr class="invoice-row">'
                        +'<td class="text-center" style="width: 15%; vertical-align: middle">'
                        +'<select class="form-control product-unit-cost" name="product_variation_id[]" id="product_variation_id_'+count+'" required>'
                        if(response.invoice_info.length > 1){
                            allProductInvoice += '<option value="">Select SKU</option>'
                        }
                        response.invoice_info.forEach(function(info){
                            if(info.sku === invoice.sku){
                                allProductInvoice += '<option value="'+invoice.variation_id+'" selected>'+invoice.sku+'</option>'
                            }else{
                                allProductInvoice += '<option value="'+info.variation_id+'">'+info.sku+'</option>'
                            }
                        })
                        allProductInvoice += '</select>'
                        +'</td>'
                        +'<td class="text-center" style="width: 15%; vertical-align: middle">'
                        +'<span id="variation-show_'+count+'" class="variation_show">'+invoice.variation+'</span>'
                        +'</td>'
                        if(invoice.qr){
                            allProductInvoice += '<td class="text-center qr" id="qr_'+count+'" style="width: 15%; vertical-align: middle">'+invoice.qr+'</td>'
                        }
                        allProductInvoice += '<td class="text-center qty" style="width: 15%; vertical-align: middle">'
                        +' <input type="number" id="quantity'+count+'" name="quantity[]" placeholder="" class="form-control quantity" value="'+invoice.return_qty+'" required>'
                        +'</td>'
                        +'<td class="text-center unit-cost" style="width: 15%; vertical-align: middle">'
                        +'<input type="text" id="price'+count+'" name="price[]" placeholder="" class="form-control unit-price" value="'+invoice.cost_price+'" required>'
                        +'</td>'
                        if(shelverId != undefined){
                            allProductInvoice += '<td class="shelver-td" style="width: 15%; vertical-align: middle">'
                            +'<select id="shelver_user_id'+count+'" class="form-control shelver_user_id" name="shelver_user_id[]" required>'
                            +'<option value="">Select Shelver</option>'
                            +shelverOption+
                            '</select>'
                            +'</td>'
                        }
                        allProductInvoice += '<td class="text-center" style="width: 10%; vertical-align: middle">'
                        +'<button type="button" class="btn btn-danger remove-more-invoice">Remove</button>'
                        +'</td>'
                        +'</tr>'
                        //variationIds.push(invoice.variation_id)
                        count++
                });
                $('table.receive-invoice-modal-table tbody').html(allProductInvoice)
                var variationIds = putSelectedVariationIdToArray(variationIds)
                showHideDropdownSku(variationIds)
                addMoreButtonShowHide()
                if(response != undefined){
                    $('button.receive-all-product').hide()
                }
                // $('#variation-show_'+row_count).html(data.variation);
                // $('#quantity'+row_count).val(data.quantity);
                // let exitCost = $('#price'+row_count).val()
                // $('#price'+row_count).val(exitCost != '' ? exitCost : data.cost_price);
            },
            error: function (jqXHR, exception) {

            }
        })
    }


    function invoice_modal_validation(event){
        // console.log(event)
        var shelf_count = 0
        var shelf_counter = []
        var shelver_value = []
        var unit_cost_count = 0
        var unit_cost_counter = []
        var unit_cost_value = []
        var quantity_count = 0
        var quantity_counter = []
        var quantity_value = []
        var sku_count = 0
        var sku_counter = []
        var sku_value = []
        $(event.target).find('select.shelver_user_id').each(function(){
            shelf_count++
            shelf_counter = shelf_count
            shelver_value.push($(this).val())
        })
        $(event.target).find('input.receive-invoice-modal-unit-price').each(function(){
            unit_cost_count++
            unit_cost_counter = unit_cost_count
            unit_cost_value.push($(this).val())
        })
        $(event.target).find('input.receive-invoice-modal-quantity').each(function(){
            quantity_count++
            quantity_counter = quantity_count
            quantity_value.push($(this).val())
        })
        $(event.target).find('select.product-unit-cost').each(function(){
            sku_count++
            sku_counter = sku_count
            sku_value.push($(this).val())
        })
        if(shelver_value.length == shelf_counter && unit_cost_value.length == unit_cost_counter && quantity_value.length == quantity_counter && sku_value.length == sku_counter){
            var receiveInvoiceModalBtnOrder = $('button.receiveInvoiceModalBtn_order').length
            var receiveInvoiceModalBtn = $('button.receiveInvoiceModalBtn').length
            if(receiveInvoiceModalBtnOrder > 0){
                $('button.receiveInvoiceModalBtn_order').html( 
                    `Restocking this product<span class="ml-2"><i class="fa fa-spinner fa-spin"></i></span>`
                );
                $('button.receiveInvoiceModalBtn_order').addClass('changeCatalogBTnCss');
            }
            if(receiveInvoiceModalBtn > 0){
                $('button.receiveInvoiceModalBtn').html(
                    `Stocking this product<span class="ml-2"><i class="fa fa-spinner fa-spin"></i></span>`
                );
                $('button.receiveInvoiceModalBtn_order').addClass('changeCatalogBTnCss');
            }
        }else{
            event.preventDefault()
            return false
        }
    }



    @if ($message = Session::get('new_product_success'))
        swal("{{ $message }}", "", "success");
    @endif


</script>

<!-- development version, includes helpful console warnings -->


</body>
</html>
