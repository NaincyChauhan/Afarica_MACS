<html lang="en" class="" style="height: auto;">
@php($user = Auth::user())
@php($setting = App\Models\Setting::first())
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('meta')
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('/'.$setting->favicon) }}" type="image/x-png" />

    <link rel="stylesheet" href="{{ asset('app-assets/vendors/typicons/typicons.css') }}">

    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/vertical-layout-light/style.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <style>
        #headerRow {
            display: flex;
            justify-content: space-between;
        }
        .swal2-html-container > ul {
            list-style: none;
        }
        .btn-secondary {
            background-color: #844fc1;
            border-color: #844fc1;
        }
        .btn-secondary:hover {
            background-color: #552889;
            border-color: #552889;
        }
        table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before{
            background-color: #844fc1 !important;
        }
        a{
            text-decoration: none !important;
        }
        #shivadatatable > tbody > tr > td > i {
            color: #844fc1;
            font-size: 19px;
        }
        #categoryimagelable{
            height:45px;
        }
        .ajax_data_table{
            margin-left: 14px;
        }
    </style>
    @yield('css')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
                <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                    <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
                        <img src="{{ asset('/'.$setting->logo) }}" alt="logo" />
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">
                        <img src="{{ asset('/'.$setting->logo) }}" alt="logo" />
                    </a>
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="typcn typcn-th-menu"></span>
                    </button>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="{{ asset('app-assets/images/faces/face5.jpg') }}" alt="profile" />
                            <span class="nav-profile-name">{{Auth::user()->username}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">

                            @can('update-setting')
                                <a class="dropdown-item" href="{{ route('update-setting') }}">
                                    <i class="typcn typcn-cog-outline text-primary"></i>
                                    Settings
                                </a>
                            @endcan
                            <a class="dropdown-item"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="typcn typcn-eject text-primary"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ url('logout') }}" method="POST" class="d-none">
                                @csrf                                
                            </form>
                        </div>
                    </li>
                    <li class="nav-item nav-user-status dropdown">
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">                   
                    <li class="nav-item dropdown">
                        <a style="cursor: pointer;"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                            id="messageDropdown" data-toggle="dropdown">
                            <i class="mdi mdi-logout-variant mx-0"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="typcn typcn-th-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <nav class="navbar-breadcrumb col-xl-12 col-12 d-flex flex-row p-0">
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-left">
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item ml-0">
                        <h4 class="mb-0">Dashboard</h4>
                    </li>
                    <li class="nav-item">
                        <div class="d-flex align-items-baseline">
                            <p class="mb-0">Home</p>
                            <i class="typcn typcn-chevron-right"></i>
                            <p class="mb-0">Main Dahboard</p>
                        </div>
                    </li>
                </ul>               
            </div>
        </nav>
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="typcn typcn-device-desktop menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    
                    @can('read-banner')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('banner.index') }}">
                                <i class="typcn typcn-image menu-icon"></i>
                                <span class="menu-title">Banners</span>
                            </a>
                        </li>
                    @endcan
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('jobapplication.index') }}">
                                <i class="mdi mdi-grid menu-icon"></i>
                                <span class="menu-title">Job Application</span>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#it-consultancy" aria-expanded="false"
                                aria-controls="it-consultancy">
                                <i class="mdi mdi-library menu-icon"></i>
                                <span class="menu-title">It Consultancy</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="it-consultancy">
                                <ul class="nav flex-column sub-menu">                                        
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('it-consultancy-request')}}">Forms</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('job.index',['type'=>0])}}">Jobs</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('course.index',['type'=>0])}}">Course</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#Health-consultancy" aria-expanded="false"
                                aria-controls="Health-consultancy">
                                <i class="mdi mdi-bible menu-icon"></i>
                                <span class="menu-title">Health Consultancy</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="Health-consultancy">
                                <ul class="nav flex-column sub-menu">                                        
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('health-consultancy-request')}}">Forms</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('job.index',['type'=>1])}}">Jobs</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('course.index',['type'=>1])}}">Course</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#Real-Estate" aria-expanded="false"
                                aria-controls="Real-Estate">
                                <i class="mdi mdi-chart-bar menu-icon"></i>
                                <span class="menu-title">Real-Estate</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="Real-Estate">
                                <ul class="nav flex-column sub-menu">                                        
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('listing.index')}}">Listings</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('listing.create')}}">Add Listings</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('listingenquiry.index')}}">Listing Enquiry</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#event-decor" aria-expanded="false"
                                aria-controls="event-decor">
                                <i class="mdi mdi-image-filter-vintage menu-icon"></i>
                                <span class="menu-title">Event-Decor</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="event-decor">
                                <ul class="nav flex-column sub-menu">                                        
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('eventbanner.index')}}">Banner</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('event.index')}}">Event</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('imagegallery.index')}}">Images</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('videogallery.index')}}">Videos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('eventenquiry.index')}}">Event Enquiry</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    {{-- @can('read-Enquiry') --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('donation.index') }}">
                                <i class="mdi mdi-plus-box menu-icon"></i>
                                <span class="menu-title">Donations</span>
                            </a>
                        </li>
                    {{-- @endcan --}}

                    @can('update-setting')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('update-setting') }}">
                                <i class="mdi mdi-microsoft menu-icon"></i>
                                <span class="menu-title">Settings</span>
                            </a>
                        </li>
                    @endcan
    
                    @can('update-policy')                  
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#policy-elements" aria-expanded="false"
                                aria-controls="policy-elements">
                                <i class="mdi mdi-file-tree menu-icon"></i>
                                <span class="menu-title">Policies</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="policy-elements">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('policy.update.policy') }}">Privacy Policy</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('refund.update.policy') }}">Refund Policy</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('policy.update.term') }}">Terms & Conditions</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endcan
    
                    @can('read-Enquiry')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('message.index') }}">
                                <i class="mdi mdi-message-alert menu-icon"></i>
                                <span class="menu-title">Enquiry Management</span>
                            </a>
                        </li>
                    @endcan
                    
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('change-password') }}">
                            <i class="mdi mdi-security-network menu-icon"></i>
                            <span class="menu-title">Change Password</span>
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="mdi mdi-chart-bar menu-icon"></i>
                            <span class="menu-title">Activities</span>
                        </a>
                    </li> --}}
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©
                                    2023 <a href="" class="text-muted" target="_blank">{{ config('app.name') }}</a>. All rights
                                    reserved.</span>
                                <span
                                    class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Design
                                    & managed by <a href="https://www.haxways.com" class="text-muted"
                                        target="_blank">Haxways</a>.</span>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- container-scroller -->
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <script src="{{ asset('app-assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="{{ asset('app-assets/vendors/chart.js/Chart.min.js') }}"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('app-assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('app-assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('app-assets/js/template.js') }}"></script>
    <script src="{{ asset('app-assets/js/settings.js') }}"></script>

    <script src="{{ asset('app-assets/js/todolist.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/select2/select2.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{ asset('app-assets/js/file-upload.js') }}"></script>
    <script src="{{ asset('app-assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('app-assets/js/select2.js') }}"></script>
    {{-- Error Script --}}
    <script>
        $(function () {
            @if (!empty(Session:: get('success')))
                Swal.fire({
                    icon: 'success',
                    title: 'Success! 😊',
                    text: "{{Session::get('success')}}",
                });
            @endif

            @if (!empty(Session:: get('error')))
                Swal.fire({
                    icon: 'error',
                    title: 'Error! 😯',
                    text: "{{Session::get('error')}}",
                });
            @endif

            @if ($errors -> any())
                Swal.fire({
                    icon: 'error',
                    title: 'Error! 😯',
                    text: "@foreach($errors->all() as $error) * {{ $error }} \n @endforeach",
                });
            @endif
        });

        
    </script>

    @yield('js')
</body>

</html>