
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>{{ centralSettings()->title }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('uploads/settings') }}/{{ centralSettings()->favicon }}">

        <!-- App css -->
        
        <link href="{{ asset('dashboard_assets/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboard_assets/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboard_assets/assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboard_assets/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
        {{-- Inline CSS from any Page --}}
        @yield('inline-css')
        {{-- Inline Css ends here --}}

        <script src="{{ asset('dashboard_assets/assets/js/modernizr.min.js') }}"></script>
        {{-- <script src="{{ asset('frontend_assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script> --}}
        <script src="{{ asset('frontend_assets/js/trans.js') }}"></script>
        <style>
            .translated-ltr{margin-top:-40px;}
            .translated-ltr{margin-top:-40px;}
            .goog-te-banner-frame {display: none;margin-top:-20px;}
    
            .goog-logo-link {
            display:none !important;
            } 
    
            .goog-te-gadget{
            color: transparent !important;
            }
            .goog-te-gadget-simple img{
                display: none;
            }
        </style>
        {{-- Top Scripts goes here --}}
        @yield('top-script')
        {{-- Top script ends here --}}

    </head>


    <body>
        

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="{{ url('/home') }}" class="logo">
                        <span>
                            <img src="{{ asset('uploads/settings') }}/{{ centralSettings()->logo }}" alt="" width="65" height="50">
                        </span>
                        <i>
                            <img src="{{ asset('uploads/settings') }}/{{ centralSettings()->logo }}" alt="" width="65" height="45" >
                        </i>
                    </a>
                </div>

                <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">
                      
                       

                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('uploads/users') }}/{{ Auth::user()->profile_picture }}" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small>Welcome ! {{ Auth::user()->name }}</small> </h5>
                                </div>

                                <!-- item-->
                                <a href="{{ route('users.show', Auth::id()) }}" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
                                </a>

                                <!-- item-->
                                <a href="{{ route('change.password', Auth::id()) }}" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-account-circle"></i> <span>Change password</span>
                                </a>

                                <!-- item-->
                                <a style="cursor: pointer" class="dropdown-item notify-item"  {{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                    <i class="zmdi zmdi-power"></i> <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="dripicons-menu"></i>
                            </button>
                        </li>
                        <li style="margin-top:25px; " id="google_translate_element"></li>
                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Navigation</li>
                            <li>
                                <a href="{{ url('/') }}">

                                  <i class="fa fa-globe"></i> <span> Visit Website </span>
                                   
                                </a>
                            </li>
                            <li>
                                <a class="@yield('dash-active')" href="{{ url('/customer/dashboard') }}">

                                  <i class="fa fa-home"></i> <span> Dashboard </span>
                                   
                                </a>
                            </li>
                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                 @if(!Auth::user()->personal_info && !Auth::user()->phone && !Auth::user()->country_id)
                                 <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <h5 class="text-danger">
                                        <strong>Oops !!!</strong> Your profile informations are incomplete. <a href="{{ route('users.edit', Auth::id()) }}">Click here</a> to complete your profile.
                                    
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                    </h5>
                                  </div>
                                 @endif
                                <div class="page-title-box">
                                    {{-- Dynamic Breadcrumb goes here --}}
                                    @yield('breadcrumb')
                                    {{-- Dynamic Breadcrumb ends here --}}

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        {{-- Your content goes here --}}
                        @yield('content')
                        {{-- Your content ends here --}}

                    </div> <!-- container -->
                    
                     

                </div> <!-- content -->

                <footer class="footer text-right">
                    2020 © {{ centralSettings()->title }}
                </footer>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        <!-- jQuery  -->
        
        <script src="{{ asset('dashboard_assets/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/assets/js/tether.min.js') }}"></script><!-- Tether for Bootstrap -->
        <script src="{{ asset('dashboard_assets/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/assets/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/assets/js/waves.js') }}"></script>
        <script src="{{ asset('dashboard_assets/assets/js/jquery.slimscroll.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('dashboard_assets/assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('dashboard_assets/assets/js/jquery.app.js') }}"></script>

        @yield('footer-script')

    </body>
</html>