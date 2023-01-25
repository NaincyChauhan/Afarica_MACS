@extends('layouts.event')
@section('meta')
<title>{{ config('app.name') }}</title>
<meta name="title" content="{{ config('app.name') }}" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="robots" content="all" />

<meta property="og:site_name" content="{{ config('app.name') }}" />
<meta property="og:image" content="{{ asset('storage/products/fabricator.jpeg') }}" />
<meta property="og:image:width" content="180" />
<meta property="og:image:height" content="50" />

<meta property="og:type" content=website />
<meta property="og:title" content="{{ config('app.name') }}" />
<meta property="og:description" content="" />
<meta property="og:url" content="{{ config('app.url') }}" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="idigitalgroups.com" />
<meta name="twitter:title" content="{{ config('app.name') }}" />
<meta name="twitter:description" content="" />
<meta name="twitter:image" content="{{ asset('storage/products/fabricator.jpeg') }}" />
@endsection
@section('content')
<!-- start page-wrapper -->
    <!-- start of wpo-hero-section -->
        <section class="wpo-hero-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="wpo-hero-items owl-carousel">
                        @foreach ($banners as $banner)                        
                            <div class="wpo-hero-item">
                                <div class="wpo-hero-img">
                                    <img src="{{asset('storage/banners/'.$banner->image)}}" alt="Banner Image">
                                    <div class="wpo-hero-text">
                                        <h2>{{$banner->title}}</h2>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    <!-- end of wpo-hero-section-->

    <!-- start of about-section -->
        <section class="wpo-about-section section-padding">
            <div class="container">
                <div class="wpo-about-wrap">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-12">
                            <div class="wpo-about-item wow fadeInLeftSlow" data-wow-duration="1500ms" style="animation-duration: 1500ms;">
                                <div class="wpo-about-img">
                                    <img src="{{asset('event-assets/images/about/1.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-12">
                            <div class="wpo-about-text wow fadeInRightSlow" data-wow-duration="1600ms"  style="animation-duration: 1600ms;">
                                <h2>About Us</h2>
                                <h4>We Are The Best Event Planner & Decor.</h4>
                                <p>Convallis gravida odio viverra nisi, aliquam sem netus. Sed at semper at lacus.
                                    Nam integer nunc pellentesque nunc pulvinar donec scelerisque. Malesuada massa
                                    facilisis aliquam nunc ut nisl tincidunt nibh. Massa feugiat vitae habitant
                                    metus viverra. Praesent massa habitant sapien odio ac scelerisque praesent id.
                                </p>
                                <a href="" class="theme-btn">APPOINMENT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- end of about-section -->

    <!-- start Events-section -->
        <section class="wpo-Service-section section-padding pt-0" id="Service">
            <div class="container">
                <div class="wpo-section-title">
                    <h4 class="monallesia-font">Our Events</h4>
                    <h2>CAPTURE BEAUTIFUL MOMENTS</h2>
                </div>
                <div class="wpo-Service-wrap">
                    <div class="row">
                        @foreach ($events as $event)                        
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="wpo-Service-item">
                                    <div class="wpo-Service-img">
                                        <img src="{{asset('storage/events/'.$event->image[0])}}" alt="Event Image">
                                    </div>
                                    <div class="wpo-Service-text">
                                        <a href="{{route('event-detail',['slug'=>$event->slug])}}">{{$event->title}}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        <a href="{{route('events')}}" class="theme-btn rounded">more..</a>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
    <!-- end Events- section -->

    <!-- start of contact-section -->
        <section class="wpo-contact-section-s2 section-padding">
            <div class="contact-bg"><img src="{{ asset('event-assets/images/contact/img-3.jpg') }}" alt=""></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col col-xl-12 col-12">
                        <div class="wpo-contact-section-wrapper">
                            <div class="wpo-contact-form-area">
                                <div class="wpo-section-title">
                                    <h4>Lets Meet</h4>
                                    <h2>Make An Inquiry</h2>
                                </div>
                                <form method="post" action="{{route('event-enquiry')}}" class="contact-validation-active" id="contact-form-main1">
                                    @csrf
                                    <div>
                                        <input type="text" required class="form-control" name="name" id="name"
                                            placeholder="Name">
                                    </div>
                                    <div>
                                        <input type="email" required class="form-control" name="email" id="email"
                                            placeholder="Email">
                                    </div>
                                    <div>
                                        <input class="form-control" name="mobile" required  type="number" required
                                            id="mobile" placeholder="Mobile">
                                    </div>                              
                                    <div>
                                        <textarea required name="message" class="form-control" id="exampleInputEnquiry-Description"
                                            placeholder="Message" rows="5"></textarea>
                                    </div>                              
                                    <div class="submit-area">
                                        <button type="submit" id="contact-btn-main" class="theme-btn-s3">Send An Inquiry</button>
                                        <div id="c-loader">
                                            <i class="ti-reload"></i>
                                        </div>
                                    </div>
                                    <div class="clearfix error-handling-messages">
                                        <div id="success">Thank you</div>
                                    </div>
                                </form>
                            </div>
                            <div class="vector-1">
                                <img src="{{ asset('event-assets/images/contact/1.png') }}" alt="">
                            </div>
                            <div class="vector-2">
                                <img src="{{ asset('event-assets/images/contact/2.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- end of contact-section -->

    <!-- start images-section -->
        <section class="wpo-portfolio-section-s5 section-padding pb-0 pt-0" id="gallery">
            <div class="container">
                <div class="wpo-section-title">
                    <h4 class="monallesia-font">Sweet Memories</h4>
                    <h2>Our Captured Moments</h2>
                </div>
                <div class="sortable-gallery">
                    <div class="gallery-filters"></div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="portfolio-grids gallery-container clearfix">                            
                                @foreach ($images as $image)
                                <div class="grid">
                                    <div class="img-holder">
                                        <a href="{{asset('storage/gallery/'.$image->image)}}" class="fancybox"
                                            data-fancybox-group="gall-1">
                                            <img src="{{asset('storage/gallery/'.$image->image)}}" alt
                                                class="img img-responsive">
                                            <div class="hover-content">
                                                <i class="ti-plus"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>                        
                            <div class="text-left">
                                <a href="{{route('event-images')}}" class="theme-btn rounded">more..</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- end images-section -->

    <!-- start videos-section -->
    <section class="wpo-blog-pg-section section-padding">
        <div class="container">
            <div class="wpo-section-title">
                <h4 class="monallesia-font">Latest Video</h4>
            </div>
            <div class="row">
                @foreach ($videos as $video)                    
                    <div class="col col-lg-4">
                        <div class="wpo-blog-content">                        
                            <div class="post format-video">
                                <div class="entry-media video-holder">
                                    <img src="{{asset('storage/videogalleries/'.$video->thumbnail)}}" alt>
                                    <a href="https://www.youtube.com/embed/{{$video->video}}" class="video-btn"
                                        data-type="iframe">
                                        <i class="fi flaticon-play"></i>
                                    </a>
                                </div>
                                <div class="entry-details">
                                    <br>
                                    <h3 class="mb-0" style="font-size: 1.25rem;">{{$video->title}}</h3>
                                    <p style="font-size: 15px;">{{$video->desc}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach                  
            </div>
            <div class="text-center">
                <a href="{{route('event-videos')}}" class="theme-btn rounded">more videos..</a>
            </div>
        </div> 
    </section>
    <!-- end videos-section -->

<!-- end of page-wrapper -->
@endsection
@section('js')
<script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{asset('assets/js/masterX/event-contact.js')}}"></script>
@endsection