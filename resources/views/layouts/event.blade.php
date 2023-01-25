@php
$setting = App\Models\Setting::select('linkedin','twitter','facebook','instagram','email','mobile','address','logo')->first();
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
    <link href="{{asset('event-assets/css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{asset('event-assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('event-assets/css/flaticon.css')}}" rel="stylesheet">
    <link href="{{asset('event-assets/css/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{asset('event-assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('event-assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('event-assets/css/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('event-assets/css/owl.theme.css')}}" rel="stylesheet">
    <link href="{{asset('event-assets/css/slick.css')}}" rel="stylesheet">
    <link href="{{asset('event-assets/css/slick-theme.css')}}" rel="stylesheet">
    <link href="{{asset('event-assets/css/swiper.min.css')}}" rel="stylesheet">
    <link href="{{asset('event-assets/css/nice-select.css')}}" rel="stylesheet">
    <link href="{{asset('event-assets/css/owl.transitions.css')}}" rel="stylesheet">
    <link href="{{asset('event-assets/css/jquery.fancybox.css')}}" rel="stylesheet">
    <link href="{{asset('event-assets/css/odometer-theme-default.css')}}" rel="stylesheet">
    <link href="{{asset('event-assets/css/jquery-ui.css')}}" rel="stylesheet">
    <link href="{{asset('event-assets/sass/style.css')}}" rel="stylesheet">
    @yield('css')
</head>

<body>
<div class="page-wrapper">
    <!-- Start header -->
    <header id="header">
        <div class="wpo-site-header wpo-header-style-1" id="sticky-header">
            <nav class="navigation navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-3 col-3 d-lg-none d-block">
                            <div class="mobail-menu">
                                <button type="button" class="navbar-toggler open-btn">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar first-angle"></span>
                                    <span class="icon-bar middle-angle"></span>
                                    <span class="icon-bar last-angle"></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-6 d-lg-block d-none">
                            <div class="social-info">
                                
                            </div>
                        </div>
                        <div class="col-md-6 col-6 d-lg-none dl-block">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="{{route('event-home')}}"><img  style="max-width: 155px;"  src="{{asset('assets/images/logo1.png')}}"
                                        alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-1 col-1">
                            <div id="navbar" class="collapse navbar-collapse navigation-holder">
                                <button class="menu-close"><i class="ti-close"></i></button>
                                <ul class="nav navbar-nav mb-2 mb-lg-0">
                                    <li>
                                        <a class="{{$active == 'event-home' ? 'active' : ''}}" href="{{route('event-home')}}">Home</a>
                                    </li>
                                    <li>
                                        <a class="{{$active == 'event-events' ? 'active' : ''}}" href="{{route('events')}}">Events</a>                                        
                                    </li>
                                    <li>
                                        <a class="{{$active == 'event-images' ? 'active' : ''}}" href="{{route('event-images')}}">Images</a>                                        
                                    </li>
                                    <li>
                                        <a class="{{$active == 'event-videos' ? 'active' : ''}}" href="{{route('event-videos')}}">Videos</a>                                        
                                    </li>
                                    <li>
                                        <a class="{{$active == 'event-contact' ? 'active' : ''}}" href="{{route('event-contact')}}">Contact</a>                                        
                                    </li>
                                </ul>
                            </div><!-- end of nav-collapse -->
                        </div>                        
                    </div>
                </div><!-- end of container -->
            </nav>
        </div>
    </header>
    <!-- end of header -->

    <div>
        @yield('content')
    </div>


    <!-- wpo-site-footer start -->
    <div class="wpo-site-footer text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-image">
                        <a class="logo" href="{{route('event-home')}}"><img  src="{{asset('assets/images/logo1.png')}}"  style="max-width: 155px;"  alt=""></a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="footer-link">
                        <ul>
                            <li><a href="{{route('home')}}">Home Main</a></li>
                            <li><a href="{{route('event-home')}}">Home</a></li>
                            <li><a href="{{route('events')}}">Events</a></li>
                            <li><a href="{{route('event-images')}}">Images</a></li>
                            <li><a href="{{route('event-videos')}}">Videos</a></li>
                            <li><a href="{{route('event-contact')}}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="link-widget">
                        <ul>
                            <li><a href="{{$setting->facebook}}" target="_blank"><i class="ti-facebook"></i></a></li>
                            <li><a href="{{$setting->twitter}}" target="_blank"><i class="ti-twitter"></i></a></li>
                            <li><a href="{{$setting->linkeding}}" target="_blank"><i class="ti-linkedin"></i></a></li>
                            <li><a href="{{$setting->instagram}}" target="_blank"><i class="ti-instagram"></i></a></li>
                            <li><a href="{{$setting->youtube}}" target="_blank"><i class="ti-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="copyright">
                        <p>© Copyright 2023 | <a href="haxways.com">Haxways</a> | All right reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- wpo-site-footer end -->

    <!--=================================
    Back To Top-->
    <div id="back-to-top" class="back-to-top">up</div>
    <!--=================================
    Back To Top-->

    {{-- <!-- color-switcher -->
    <div class="color-switcher-wrap">
        <div class="color-switcher-item">
            <div class="color-toggle-btn">
                <i class="fa fa-cog"></i>
            </div>
            <ul id="switcher">
                <li class="btn btn1" id="Button1"></li>
                <li class="btn btn2" id="Button2"></li>
                <li class="btn btn3" id="Button3"></li>
                <li class="btn btn4" id="Button4"></li>
                <li class="btn btn5" id="Button5"></li>
                <li class="btn btn6" id="Button6"></li>
                <li class="btn btn7" id="Button7"></li>
                <li class="btn btn8" id="Button8"></li>
                <li class="btn btn9" id="Button9"></li>
                <li class="btn btn10" id="Button10"></li>
                <li class="btn btn11" id="Button11"></li>
                <li class="btn btn12" id="Button12"></li>
            </ul>
        </div>
    </div> --}}
</div>
    <!-- COMMON SCRIPTS -->
    <script src="{{asset('event-assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('event-assets/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Plugins for this template -->
    <script src="{{asset('event-assets/js/modernizr.custom.js')}}"></script>
    <script src="{{asset('event-assets/js/jquery.dlmenu.js')}}"></script>
    <script src="{{asset('event-assets/js/jquery-plugin-collection.js')}}"></script>
    <!-- Custom script for this template -->
    <script src="{{asset('event-assets/js/script.js')}}"></script>

    <script>
        $(window).on('scroll',function(event) {
            var scroll = $(window).scrollTop();
            $(".wow").each(function (index,ele) {
                $(ele).css({"visibility":"visible","animation-name":"fadeInRightSlow","animation-duration":$(ele).attr('data-wow-duration')})
            });;
        });
    </script>
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
</body>

</html>