<!DOCTYPE html>
<html class="loading" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="author" content="MYPCOTINFOTECH">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Admin</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('backend/img/logo.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/mypcot.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/fonts/feather/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/fonts/simple-line-icons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/vendors/css/perfect-scrollbar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/vendors/css/prism.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/vendors/css/switchery.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/themes/layout-dark.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/plugins/switchery.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/css/datatables/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/vendors/css/daterangepicker/daterangepicker.css')}}">
    <!-- added by nikunj -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/flatpickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/datepicker.css')}}">
    <script src="{{asset('backend/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('backend/vendors/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/vendors/js/vendors.min.js')}}"></script>
    <script src="{{asset('backend/vendors/js/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/vendors/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/js/bootbox.min.js')}}"></script>
    <!-- added by nikunj -->
    <script src="{{asset('backend/vendors/js/datepicker.min.js')}}"></script>

    <script src="{{asset('backend/js/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('backend/js/daterangepicker/daterangepicker.min.js')
}}"></script>
    <script src="{{ asset('backend/vendors/js/flatpickr.min.js') }}"></script>
</head>
<body class="vertical-layout vertical-menu 2-columns" data-menu="vertical-menu" data-col="2-columns" id="container">
    <div class="loader-overlay">
        <div class="loader mx-auto"></div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light header-navbar navbar-fixed mt-2">
        <div class="container-fluid navbar-wrapper">
            <div class="navbar-header d-flex pull-left">
                <div class="navbar-toggle menu-toggle d-xl-none d-block float-left align-items-center justify-content-center" data-toggle="collapse"><i class="ft-menu font-medium-3"></i></div>
                <li class="nav-item mr-2 d-none d-lg-block">
                    {{-- <a class="nav-link apptogglefullscreen" id="navbar-fullscreen" href="javascript:;">
                        <i class="ft-maximize font-medium-3" style="color:black !important"></i>
                    </a> --}}
                </li>
                <h5 class="translateLable padding-top-sm padding-left-sm pt-1"  data-translate="welcome_to_admin_panel">Welcome {{session('data')['name']}}</h5>
            </div>
            <div class="navbar-container pull-right">
                <div class="collapse navbar-collapse d-block" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <div class="d-none d-xl-block">
                            <div class="col-sm-12">
                                <a href="{{route('profile')}}" class="mr-1"><span class="mr-1" style="font-size: 24px; color: #aaa;">|</span><i title="Manage Profile" class="fa fa-user-circle-o fa-lg" style="color:brown;"></i></a>

                                <a href="{{route('updatePassword')}}"><span class="mr-1" style="font-size: 24px; color: #aaa;">|</span><i title="Change Password" class="fa fa-key fa-lg" style="color:brown;"></i></a>

                                <a href="{{route('logout')}}"><span class="mr-1" style="font-size: 24px; color: #aaa;">|</span><i title="Logout" class="fa fa-power-off fa-lg" style="color:brown;"></i></a>
                            </div>
                        </div>
                        <li class="dropdown nav-item d-xl-none d-block"><a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle"><i class="ft-user font-medium-3 blue-grey darken-4"></i>
                            <div class="dropdown-menu text-left dropdown-menu-right m-0 pb-0 dropdownBasic3Content" aria-labelledby="dropdownBasic2">
                                <a class="dropdown-item" href="{{route('profile')}}">
                                    <div class="d-flex align-items-center"><i class="ft-edit mr-2"></i><span>Edit Profile</span></div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('updatePassword')}}">
                                    <div class="d-flex align-items-center"><i class="ft-edit mr-2"></i><span>Update Password</span></div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('logout')}}">
                                    <div class="d-flex align-items-center"><i class="ft-power mr-2"></i><span>Logout</span></div>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="wrapper">
        <div class="app-sidebar menu-fixed" style="background-image: url({{asset('backend/img/side_nav_bg.png')}}); background-size: cover; background-position: top left;">
            <div class="sidebar-header">
                <div class="logo clearfix">
                    <a class="logo-text float-left" href="dashboard">
                        <div class="logo-img">
                            <img id="sidebar-logo" src="{{asset('backend/img/logo_side.png')}}" style="width: 100px;" alt="Logo"/>
                        </div>
                    </a>
                    <a class="nav-toggle d-none d-lg-none d-xl-block is-active" id="sidebarToggle" href="javascript:;"><i class="toggle-icon ft-toggle-right" data-toggle="collapsed"></i></a>
                    <a class="nav-close d-block d-lg-block d-xl-none" id="sidebarClose" href="javascript:;"><i class="ft-x"></i></a>
                </div>
            </div>
            <div class="sidebar-content main-menu-content scroll">
                @php
                //$lastParam =  last(request()->segments());
                //GET OATH :: Request::path()
                    $lastParam =  Request::segment(2);
                    $permissions = Session::get('permissions');
                    $count = count($permissions);
                    $permission_array = array();
                @endphp
                @for($i=0; $i<$count; $i++)
                    @php
                        $permission_array[$i] = $permissions[$i]->codename;
                    @endphp
                @endfor

                <div class="nav-container">
                    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                        <li class="nav-item {{ $lastParam ==  'dashboard' ? 'active' : ''  }}">
                            <a href="dashboard"><i class="ft-home"></i><span class="menu-title" data-i18n="Documentation">Dashboard</span></a>
                        </li>
                        @if(session('data')['role_id'] == 1 || in_array('question', $permission_array) || in_array('category', $permission_array) || in_array('contest', $permission_array) || in_array('location', $permission_array) || in_array('banner', $permission_array))
                        <li class="has-sub nav-item">
                            <a href="javascript:;" class="dropdown-parent"><i class="fa fa-archive"></i><span data-i18n="" class="menu-title">Master</span></a>
                            <ul class="menu-content">
                                @if(in_array('category', $permission_array) || session('data')['role_id'] == 1)
                                    <li class="nav-item {{ $lastParam ==  'category' ? 'active' : ''  }}">
                                        <a href="{{route('category')}}"><i class="fa fa-th-large" aria-hidden="true"></i><span class="menu-title" data-i18n="Documentation">Category</span></a>
                                    </li>
                                @endif
                                <!-- @if(in_array('location', $permission_array) || session('data')['role_id'] == 1)
                                    <li class="nav-item {{ $lastParam ==  'location' ? 'active' : ''  }}">
                                        <a href="{{route('location')}}"><i class="fa fa-map-marker" aria-hidden="true"></i><span class="menu-title" data-i18n="Documentation">Location</span></a>
                                    </li>
                                @endif -->
                                @if(in_array('question', $permission_array) || session('data')['role_id'] == 1)
                                    <li class="nav-item {{ $lastParam ==  'question' ? 'active' : ''  }}">
                                        <a href="{{route('question')}}"><i class="fa fa-question" aria-hidden="true"></i><span class="menu-title" data-i18n="Documentation">Question Set</span></a>
                                    </li>
                                @endif
                                @if(in_array('contest', $permission_array) || session('data')['role_id'] == 1)
                                    <li class="nav-item {{ $lastParam ==  'contest' ? 'active' : ''  }}">
                                        <a href="{{route('contest')}}"><i class="fa fa-trophy"></i><span class="menu-title" data-i18n="Documentation">Contest</span></a>
                                    </li>
                                @endif
                                @if(in_array('banner', $permission_array) || session('data')['role_id'] == 1)
                                    <li class="nav-item {{ $lastParam ==  'banner' ? 'active' : ''  }}">
                                        <a href="{{route('banner')}}"><i class="fa fa-image"></i><span class="menu-title" data-i18n="Documentation">Banner</span></a>
                                    </li>
                                @endif

                            </ul>
                        </li>
                        @endif
                        @if(in_array('customer', $permission_array) || session('data')['role_id'] == 1 || in_array('suggested_questions', $permission_array)|| in_array('enrolled_user', $permission_array))
                        <li class="has-sub nav-item">
                            <a href="javascript:;" class="dropdown-parent"><i class="icon-user-following"></i><span data-i18n="" class="menu-title">App Users</span></a>
                            <ul class="menu-content">
                                @if(in_array('customer', $permission_array) || session('data')['role_id'] == 1)
                                <li class="{{ $lastParam ==  'customer' ? 'active' : '' }}">
                                    <a href="{{route('customer')}}" class="menu-item"><i class="fa fa-list"></i>Customer List</a>
                                </li>
                                @endif
                                @if(in_array('enrolled_user', $permission_array) || session('data')['role_id'] == 1)
                                    <li class="nav-item {{ $lastParam ==  'enrolled_user' ? 'active' : ''  }}">
                                        <a href="{{route('enrolled_user')}}"><i class="fa fa-users"></i><span class="menu-title" data-i18n="Documentation">Enrolled User</span></a>
                                    </li>
                                @endif
                                @if(in_array('suggested_questions', $permission_array) || session('data')['role_id'] == 1)
                                    <li class="nav-item {{ $lastParam ==  'suggested_questions' ? 'active' : ''  }}">
                                        <a href="{{route('suggested_questions')}}"><i class="fa fa-question-circle"></i><span class="menu-title" data-i18n="Documentation">Suggested Questions</span></a>
                                    </li>
                                @endif
                                @if(in_array('enquiries', $permission_array) || session('data')['role_id'] == 1)
                                    <li class="nav-item {{ $lastParam ==  'enquiries' ? 'active' : ''  }}">
                                        <a href="{{route('enquiries')}}"><i class="fa fa-commenting" aria-hidden="true"></i><span class="menu-title" data-i18n="Documentation">Enquiries</span></a>
                                    </li>
                                @endif
                                @if(session('data')['role_id'] == 1 || in_array('notification', $permission_array))
                                    <li class="nav-item {{ $lastParam ==  'notification' ? 'active' : ''  }}">
                                        <a href="notification"><i class="fa ft-bell"></i><span class="menu-title">FCM Notification</span></a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if(in_array('faq', $permission_array) || session('data')['role_id'] == 1)
                        <li class="nav-item {{ $lastParam ==  'faq' ? 'active' : ''  }}">
                            <a href="{{route('faq')}}"><i class="fa fa-question-circle" aria-hidden="true"></i><span class="menu-title" data-i18n="Documentation">FAQs</span></a>
                        </li>
                        @endif
                        @if(session('data')['role_id'] == 1  || in_array('role', $permission_array) || in_array('staff', $permission_array))
                        <li class="has-sub nav-item">
                            <a href="javascript:;" class="dropdown-parent"><i class="fa fa-user"></i><span data-i18n="" class="menu-title">Staff</span></a>
                            <ul class="menu-content">
                                <li class="{{ $lastParam ==  'roles' ? 'active' : '' }}">
                                    <a href="{{route('roles')}}" class="menu-item"><i class="fa fa-circle fs_i"></i>Manage Roles</a>
                                </li>
                                <li class="{{ $lastParam ==  'staff' ? 'active' : '' }}">
                                    <a href="{{route('staff')}}" class="menu-item"><i class="fa fa-circle fs_i"></i>Manage Staff</a>
                                </li>
                            </ul>
                        </li>
                        @endif
{{--                        @if(in_array('winners', $permission_array) || session('data')['role_id'] == 1)--}}
{{--                        <li class="nav-item {{ $lastParam ==  'winners' ? 'active' : ''  }}">--}}
{{--                            <a href="{{route('winners')}}"><i class="fa fa-certificate" aria-hidden="true"></i><span class="menu-title" data-i18n="Documentation">Winners</span></a>--}}
{{--                        </li>--}}
{{--                        @endif--}}
                        @if(session('data')['role_id'] == 1  || in_array('general_settings', $permission_array) || in_array('about_us', $permission_array) || in_array('terms', $permission_array) || in_array('privacy_policy', $permission_array))
                        <li class="has-sub nav-item">
                            <a href="javascript:;" class="dropdown-parent"><i class="fa fa-wrench"></i><span data-i18n="" class="menu-title">General Settings</span></a>
                            <ul class="menu-content">
                                @if(session('data')['role_id'] == 1 || in_array('general_settings', $permission_array))
                                <li class="{{ $lastParam ==  'general_settings' ? 'active' : '' }}">
                                    <a href="{{route('general_settings')}}" class="menu-item"><i class="fa fa-cog" aria-hidden="true"></i>Settings</a>
                                </li>
                                @endif
                                @if(session('data')['role_id'] == 1 || in_array('about_us', $permission_array))
                                <li class="{{ $lastParam ==  'about_us' ? 'active' : '' }}">
                                    <a href="{{route('about_us')}}" class="menu-item"><i class="fa fa-info-circle"></i>About Us</a>
                                </li>
                                @endif
                                @if(session('data')['role_id'] == 1 || in_array('terms', $permission_array))
                                <li class="{{ $lastParam ==  'terms' ? 'active' : '' }}">
                                    <a href="{{route('terms')}}" class="menu-item"><i class="fa fa-file-text-o"></i>Terms and Condition</a>
                                </li>
                                @endif
                                @if(session('data')['role_id'] == 1 || in_array('privacy_policy', $permission_array))
                                <li class="{{ $lastParam ==  'privacy_policy' ? 'active' : '' }}">
                                    <a href="{{route('privacy_policy')}}" class="menu-item"><i class="fa fa-shield"></i>Privacy Policy</a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if(session('data')['role_id'] == 1  || in_array('customer_report', $permission_array)  || in_array('enrolled_report', $permission_array)  || in_array('winners_report', $permission_array))
                            <li class="has-sub nav-item">
                                <a href="javascript:;" class="dropdown-parent"><i class="fa fa-file-pdf-o"></i><span data-i18n="" class="menu-title">Report</span></a>
                                <ul class="menu-content">
                                    @if(in_array('customer_report', $permission_array) || session('data')['role_id'] == 1)
                                    <li class="{{ $lastParam ==  'customer_report' ? 'active' : '' }}">
                                        <a href="{{route('customer_report')}}" class="menu-item"><i class="fa fa-circle fs_i"></i>Customer Report</a>
                                    </li>
                                    @endif
                                    @if(in_array('enrolled_report', $permission_array) || session('data')['role_id'] == 1)
                                    <li class="{{ $lastParam ==  'enrolled_report' ? 'active' : '' }}">
                                        <a href="{{route('enrolled_report')}}" class="menu-item"><i class="fa fa-circle fs_i"></i>Enrolled User Report</a>
                                    </li>
                                    @endif
                                    @if(in_array('winners_report', $permission_array) || session('data')['role_id'] == 1)
                                    <li class="{{ $lastParam ==  'winners_report' ? 'active' : '' }}">
                                        <a href="{{route('winners_report')}}" class="menu-item"><i class="fa fa-circle fs_i"></i>Winners Report</a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        <li class="nav-item {{ $lastParam ==  'logout' ? 'active' : ''  }}">
                            <a href="logout"><i class="fa fa-power-off"></i><span class="menu-title" >Logout</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main-panel">
            @yield('content')
            <footer class="footer">
                <p class="clearfix text-muted m-0"><span>Copyright &copy; 2023 &nbsp;</span><span class="d-none d-sm-inline-block"> All rights reserved.</span></p>
            </footer>
            <button class="btn btn-primary scroll-top" type="button"><i class="ft-arrow-up"></i></button>
        </div>
        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>
    </div>
</body>
<script src="{{asset('backend/vendors/js/switchery.min.js')}}"></script>
<script src="{{asset('backend/js/core/app-menu.js')}}"></script>
<script src="{{asset('backend/js/core/app.js')}}"></script>
<script src="{{asset('backend/js/notification-sidebar.js')}}"></script>
<script src="{{asset('backend/js/customizer.js')}}"></script>
<script src="{{asset('backend/js/scroll-top.js')}}"></script>
<script src="{{asset('backend/js/scripts.js')}}"></script>
<script src="{{asset('backend/js/ajax-custom.js')}}"></script>
<script src="{{asset('backend/js/mypcot.min.js')}}"></script>
<script src="{{asset('backend/js/select2.min.js')}}"></script>
<script src="{{asset('backend/vendors/js/apexcharts.min.js')}}"></script>
</html>
