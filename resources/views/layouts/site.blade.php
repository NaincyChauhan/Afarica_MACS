@php
$setting = App\Models\Setting::first();
if (!isset($active)) {
$active = "";
}
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="haxways.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Archivo:400,400i,500,500i,600,600i,700,700i&amp;display=swap">

    <!-- CSS Global Compulsory (Do not remove)-->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}" />

    <!-- Page CSS Implementing Plugins (Remove the plugin CSS here if site does not use that feature)-->
    <link rel="stylesheet" href="{{ asset('assets/css/owl-carousel/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/swiper/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/animate/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup/magnific-popup.css') }}" />

    <!-- Template Style -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/masterX/custom.css') }}" />
    @yield('css')
    <style>
        .footer-nav-link{    
            color: white !important;
            text-decoration: underline;
            text-underline-offset: 8px;
            text-decoration-color: #cb12cb;

        }
    </style>
</head>

<body>
    <!--================================= header -->
    <header class="header default">
        <div class="topbar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="d-block d-md-flex align-items-center text-center">
                            <div class="me-4 d-inline-block py-1">
                                <a href="#"><i
                                        class="far fa-envelope me-2 fa-flip-horizontal text-primary"></i>{{$setting->email}}</a>
                            </div>
                            <div class="me-auto d-inline-block py-1">
                                <a href="tel:1-800-555-1234"><i
                                        class="fas fa-map-marker-alt text-primary me-2"></i>{{$setting->address}}</a>
                            </div>
                            <div class="d-inline-block py-1">
                                <ul class="list-unstyled mb-0 social-icon">
                                    <li><a href="{{$setting->facebook}}" target="_blank"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="{{$setting->twitter}}" target="_blank"><i
                                                class="fab fa-twitter"></i></a></li>
                                    <li><a href="{{$setting->linkeding}}" target="_blank"><i
                                                class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="{{$setting->instagram}}" target="_blank"><i
                                                class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar bg-white navbar-static-top navbar-expand-lg">
            <div class="container-fluid">
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                    data-bs-target=".navbar-collapse"><i class="fas fa-align-left"></i></button>
                <a class="navbar-brand" href="">
                    <img class="img-fluid" style="width: 100px;height: auto;"
                        src="{{ asset('assets/images/logo1.png') }}" alt="logo">
                </a>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item {{$active == 'home' ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('home')}}" role="button" aria-haspopup="true"
                                aria-expanded="false">Home</a>
                        </li>
                        @if ($active == 'it-consultancy')
                        <li class="nav-item {{(isset($submenu) && $submenu == 'jobs') ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('it-consultancy-jobs')}}" role="button"
                                aria-haspopup="true" aria-expanded="false">Jobs</a>
                        </li>
                        <li class="nav-item {{(isset($submenu) && $submenu == 'apply-now') ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('it-consultancy-form')}}" role="button"
                                aria-haspopup="true" aria-expanded="false">Apply Now</a>
                        </li>
                        <li class="nav-item {{(isset($submenu) && $submenu == 'course') ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('it-consultancy-course')}}" role="button"
                                aria-haspopup="true" aria-expanded="false">Course</a>
                        </li>
                        @endif
                        @if ($active == 'health-consultancy')
                        <li class="nav-item {{(isset($submenu) && $submenu == 'jobs') ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('health-consultancy-jobs')}}" role="button"
                                aria-haspopup="true" aria-expanded="false">Jobs</a>
                        </li>
                        <li class="nav-item {{(isset($submenu) && $submenu == 'apply-now') ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('health-consultancy-form')}}" role="button"
                                aria-haspopup="true" aria-expanded="false">Apply Now</a>
                        </li>
                        <li class="nav-item {{(isset($submenu) && $submenu == 'course') ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('health-consultancy-course')}}" role="button"
                                aria-haspopup="true" aria-expanded="false">Course</a>
                        </li>
                        @endif
                        @if ($active == 'real-estate')
                        <li class="nav-item {{(isset($submenu) && $submenu == 'listing') ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('real-estate-listing')}}" role="button"
                                aria-haspopup="true" aria-expanded="false">Listing</a>
                        </li>
                        <li class="nav-item {{(isset($submenu) && $submenu == 'listing') ? '' : ''}}">
                            <a class="nav-link" target="_blank" href="{{route('event-home')}}" role="button"
                                aria-haspopup="true" aria-expanded="false">Event & Decor</a>
                        </li>
                        @endif
                        <li class="nav-item {{$active == 'contact' ? 'active' : ''}}">
                            <a target="_blank" href="{{route('contact')}}" class="nav-link"
                                data-bs-toggle="">Contact</a>
                        </li>
                        <li class="nav-item {{$active == 'services' ? 'active' : ''}}">
                            <a target="_blank" href="{{route('home')}}#services" class="nav-link"
                                data-bs-toggle="">Services</a>
                        </li>
                        <li class="nav-item {{$active == 'about' ? 'active' : ''}}">
                            <a target="_blank" href="{{route('about')}}" class="nav-link" data-bs-toggle="">About</a>
                        </li>
                    </ul>
                    @if ($active == 'health-consultancy' || $active == 'it-consultancy')
                    <ul class="nav navbar-nav mx-auto">
                        @if (Auth::user())
                        <li class="nav-item dropdown nav-item-my">
                            <a class="nav-link text-start" href="#" id="navbarDropdownProfile" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle"
                                    src="{{Auth::user()->image != null ? asset('storage/users/'.Auth::user()->image) : asset('assets/images/avatar/01.jpg')}}"
                                    alt="user" width="50px">
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownProfile">
                                <li><a class="dropdown-item" href="{{$active == " it-consultancy" ?
                                        route('user-course-0') : route('user-course-1')}}">My Courses<i
                                            class="fas fa-arrow-right"></i></a></li>
                                <li><a class="dropdown-item"
                                        href="{{route('user-change-password',['active' => $active])}}">Change Password<i
                                            class="fas fa-arrow-right"></i></a></li>
                                <li><a class="dropdown-item"
                                        href="{{route('user-update-profile',['active' => $active])}}">Update Profile<i
                                            class="fas fa-arrow-right"></i></a></li>
                                <li><a class="dropdown-item" onclick="$('#logout-form').submit();"
                                        type="button">Logout<i class="fas fa-arrow-right"></i></a></li>
                            </ul>
                        </li>
                        @else
                        <button class="btn btn-primary rounded" data-bs-toggle="modal"
                            data-bs-target="#logInModal">Login</button>
                        @endif
                    </ul>
                    @endif
                </div>
                {{-- <div class="d-none d-sm-flex ms-auto me-5 me-lg-0 pe-4 pe-lg-0">
                    <ul class="nav ms-1 ms-lg-2 align-self-center">
                        <li class="contact-number nav-item pe-4 ">
                            <a class="fw-bold" href="#"><i class="fab fa-whatsapp pe-2"></i>+237 659 477 016</a>
                        </li>
                    </ul>
                </div> --}}
            </div>
        </nav>
    </header>
    <!--================================= header -->

    <div>
        @yield('content')
    </div>


    <!--=================================
    footer-->
    <footer class="footer space-ptb bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6 mb-5 mb-lg-0">
                    <div class="footer-link">
                        <ul class="list-unstyled mb-3 mb-sm-0">
                            <li><h5 class="text-primary mb-2 mb-sm-4 footer-nav-link">Services</h5></li>
                            <li><a href="{{route('it-consultancy-form')}}">IT Consultancy</a></li>
                            <li><a href="{{route('health-consultancy-form')}}">Health Consultancy</a></li>
                            <li><a href="{{route('real-estate-listing')}}">Real Estate</a></li>
                            <li><a href="{{route('event-home')}}">Event & Decor</a></li>
                        </ul>
                        <ul class="list-unstyled mb-3 mb-sm-0">
                            <li><h5 class="text-info mb-2 mb-sm-4 footer-nav-link">IT Consultancy</h5></li>
                            <li><a href="{{route('it-consultancy-jobs')}}">Jobs</a></li>
                            <li><a href="{{route('it-consultancy-course')}}">Course</a></li>
                            <li><a href="{{route('it-consultancy-form')}}">Apply</a></li>
                            <li><a href="{{route('it-consultancy-about')}}">About</a></li>
                        </ul>
                        <ul class="list-unstyled mb-3 mb-sm-0">
                            <li><h5 class="text-primary mb-2 mb-sm-4 footer-nav-link">Health Consultancy</h5></li>
                            <li><a href="{{route('health-consultancy-jobs')}}">Jobs</a></li>
                            <li><a href="{{route('health-consultancy-course')}}">Course</a></li>
                            <li><a href="{{route('health-consultancy-form')}}">Apply</a></li>
                            <li><a href="{{route('health-consultancy-about')}}">About</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-5 mb-sm-0">
                    <h5 class="text-primary mb-2 mb-sm-4 footer-nav-link">Event & Decor</h5>
                    <div class="footer-link">
                        <ul class="list-unstyled mb-0">
                            <li><a href="{{route('event-home')}}">Event & Decor</a></li>
                            <li><a href="{{route('event-images')}}">Images</a></li>
                            <li><a href="{{route('event-videos')}}">Videos</a></li>
                            <li><a href="{{route('events')}}">Events</a></li>
                            <li><a href="{{route('event-contact')}}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <h5 class="text-primary mb-2 mb-sm-4 footer-nav-link">Support</h5>
                    <div class="footer-link">
                        <ul class="list-unstyled mb-0">
                            <li><a href="{{route('about')}}">About</a></li>
                            <li><a href="{{route('contact')}}">Contact Us</a></li>
                            <li><a href="{{route('terms')}}">Terms Conditions</a></li>
                            <li><a href="{{route('policy')}}">Privacy Policy</a></li>
                            <li><a href="{{route('foundation')}}">Foundation</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 mt-5">
                    <h5 class="text-primary mb-2 mb-sm-4 footer-nav-link">Social</h5>
                    <ul class="list-unstyled social-icon">
                        <li><a href="{{$setting->facebook}}"><i
                                    class="fab fa-facebook-f"></i></a></li>
                        <li><a href="{{$setting->twitter}}"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="{{$setting->linkedin}}"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="{{$setting->instagram}}"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="{{$setting->youtube}}"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                    <p class="mb-0 text-white mt-4">©Copyright 2023 <a target="_blank" href="https://haxways.com/"
                            class="text-primary footer-nav-link">Haxways</a> All Rights Reserved</p>
                </div>
                <div class="col-sm-6 mt-5">
                    <h5 class="text-primary mb-2 mr-1 mb-sm-4 footer-nav-link">Where we are</h5>
                    <div class="d-flex align-items-center mb-3">
                        <div class="ms-4">
                            <h6 class="mb-0 text-white">Address : {{$setting->address}}</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="ms-4">
                            <h6 class="mb-0 text-white">Email : {{$setting->email}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--================================= footer-->


    <!-- Sign In Popup -->
    <div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signUpModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="row">
                        <div class="col-md-6 col-lg-0 text-center gird-center">
                            <img src="{{asset('assets/images/register.png')}}" alt="" width="100%">
                        </div>
                        <div class="col-md-6">
                            <div class="custom-my">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title" id="signUpModalLabel">Register Now</h5>
                                    <button type="button" id="close-button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form class="mt-4 row" method="POST" id="registerform"
                                    action="{{route('registeruser')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3 col-12">
                                        <input type="text" class="form-control" name="name" id="exampleInputName"
                                            placeholder="Your Name">
                                    </div>
                                    <div class="mb-3 col-12">
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                            placeholder="Email Address">
                                    </div>
                                    <div class="mb-3 col-12">
                                        <input type="number" name="mobile" class="form-control" id="exampleInputLnumber"
                                            placeholder="Phone Number">
                                    </div>
                                    <div class="mb-3 col-6">
                                        <input type="password" name="password" class="form-control"
                                            id="exampleInputLPassword1" placeholder="Password">
                                    </div>
                                    <div class="mb-3 col-6">
                                        <input type="password" name="password_confirmation" class="form-control"
                                            autocomplete id="exampleInputLConfirmPassword" placeholder="Password Again">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <input type="text" name="address" class="form-control" id="exampleInputWebsite"
                                            placeholder="Address">
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12" id="verify-otp" style="display: none">
                                        <div class="form-group">
                                            <a href="#" style="float:right"
                                                onclick="event.preventDefault(); resendOTP($('#sumitregister'), 0)">Resend
                                                OTP?</a><br>
                                            <label>OTP Verification</label>
                                            <input class="form-control" name="otp" required autocomplete="OTP"
                                                type="text" placeholder="OTP">
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 ">
                                        <button type="submit" id="signupnowBtn"
                                            class="btn btn-primary rounded">Register</button>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <p class="text-center">already have an account <a class="text-primary curson-p"
                                        onclick="ShowLogInForm();">Log In </a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Sign In Popup -->
    <!-- Log In Popup -->
    <div class="modal fade" id="logInModal" tabindex="-1" role="dialog" aria-labelledby="logInModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="row">
                        <div class="col-md-6 col-lg-0 text-center gird-center">
                            <img src="{{asset('assets/images/login.png')}}" alt="" width="100%">
                        </div>
                        <div class="col-md-6">
                            <button type="button" id="close-button" class="btn-close login-close"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="custom-my" style="margin: 85px 11px;">
                                <div class="text-center">
                                    <h5 class="modal-title" id="logInModalLabel">Login</h5>
                                </div>
                                <div class="loginBox">
                                    <form class="mt-4 row" method="POST" id="LogInnowForm"
                                        action="{{ route('loginuser') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3 col-12">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control"
                                                id="exampleInputEmail2" placeholder="Email Address">
                                        </div>
                                        <div class="mb-3 col-12">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="exampleInputLPassword2" placeholder="Password">
                                        </div>
                                        <div class="d-grid gap-2 ">
                                            <button type="submit" id="logInnowBtn"
                                                class="btn btn-primary rounded">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div>
                                <p class="text-center">Don't have any account <a class="text-primary curson-p"
                                        onclick="ShowSignUpForm();">Sign up </a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ url('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    <!-- /Log In Popup -->

    <!--=================================
    Back To Top-->
    <div id="back-to-top" class="back-to-top">up</div>
    <!--=================================
    Back To Top-->

    <!-- COMMON SCRIPTS -->
    {{--
    <script src="{{ asset('assets/js/common_scripts.js') }}"></script>
    <script src="{{ asset('assets/js/functions.js') }}"></script> --}}

    <!-- JS Global Compulsory (Do not remove)-->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>

    <!-- Page JS Implementing Plugins (Remove the plugin script here if site does not use that feature)-->
    <script src="{{ asset('assets/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('assets/js/swiper/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiperanimation/SwiperAnimation.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/jquery.countTo.js') }}"></script>
    <script src="{{ asset('assets/js/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/horizontal-timeline/horizontal-timeline.js') }}"></script>
    <script src="{{ asset('assets/js/shuffle/shuffle.min.js') }}"></script>
    <script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <!-- Template Scripts (Do not remove)-->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/masterX/authentication.js') }}"></script>

    @yield('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.all.min.js"></script>
    <script>
        @if (Session:: has('success'))
        Swal.fire({
            icon: 'success',
            title: 'Thank You 😊',
            text: '{{Session::get('success')}}',
        });
        @endif
        @if (Session:: has('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops! 😯',
            text: '{{Session::get('error')}}'',
        });
        @endif

        @if ($errors -> any())
            var data = '<ul>';
        @foreach($errors -> all() as $error)
        data += '<li>{{$error}}</li>';
        @endforeach
        data += '</ul>';
        Swal.fire({
            icon: 'error',
            title: 'Oops! 😯',
            html: data,
        });
        @endif
            function ajaxMessage(status, msg) {
            if (status == 1) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success! 😊',
                    text: msg,
                });
            }
            else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error! 😯',
                    text: msg,
                });
            }
        }

        function errorsHTMLMessage(msg) {
            Swal.fire({
                icon: 'error',
                title: 'Error! 😯',
                html: msg,
            });
        }

        function infoHTMLMessage(msg) {
            Swal.fire({
                icon: 'info',
                title: 'Info! 😐',
                showDenyButton: true,
                showCancelButton: true,
                html: msg,
                confirmButtonText: 'Yes',
                denyButtonText: 'No',
                customClass: {
                    actions: 'my-actions',
                    cancelButton: 'order-1 right-gap',
                    confirmButton: 'order-2',
                    denyButton: 'order-3',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    return true;
                } else if (result.isDenied) {
                    return false;
                }
            });
        }

    </script>

    <script>

    </script>

</body>

</html>