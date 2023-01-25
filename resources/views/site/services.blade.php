@extends('layouts.site')
@section('meta')
<title>Services - {{ config('app.name') }}</title>

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
<meta property="og:url" content="https://www.idigitalgroups.com" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="idigitalgroups.com" />
<meta name="twitter:title" content="{{ config('app.name') }}" />
<meta name="twitter:description" content="" />
<meta name="twitter:image" content="{{ asset('storage/products/fabricator.jpeg') }}" />


@endsection
@section('content')
<!--=================================
    Header Inner -->
<section class="header-inner bg-overlay-black-50" style="background-image: url('{{asset('assets/images/header-inner/18.jpg')}}');">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="header-inner-title text-center position-relative">
                    <h1 class="text-white fw-normal">Digital Marketing Services</h1>
                    <p class="text-white mb-0">Award-winning website design & creative digital agency services</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================
      Header Inner -->

<!--=================================
      Category -->
<section class="space-ptb">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-info feature-info-style-02 h-100">
                    <div class="feature-info-icon">
                        <i class="flaticon-data"></i>
                        <h5 class="mb-0 ms-4 feature-info-title">Best Logo Design, Posters</h5>
                    </div>
                    <div class="feature-info-content">
                        <p class="mb-0">Start good day for new font! present to you, Bright! Bright is a stylish font It has both modern and retro look - clear, modern and fun. Helps to create layout design in 60s or 70s design projects.</p>
                        <a href="service-detail.html" class="icon-btn"><i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                    <div class="feature-info-bg-img" style="background-image: url('{{asset('assets/images/feature-info/01.jpg')}}');"></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-info feature-info-style-02 h-100">
                    <div class="feature-info-icon">
                        <i class="flaticon-author"></i>
                        <h5 class="mb-0 ms-4 feature-info-title">Flyer & Business Cards</h5>
                    </div>
                    <div class="feature-info-content">
                        <p class="mb-0">A business card is a small, printed, usually credit-card-sized paper card that holds your business details, such as name, contact details and brand logo.</p>
                        <a href="service-detail.html" class="icon-btn"><i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                    <div class="feature-info-bg-img" style="background-image: url('{{asset('assets/images/feature-info/02.jpg')}}');"></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-info feature-info-style-02 h-100">
                    <div class="feature-info-icon">
                        <i class="flaticon-icon-149196"></i>
                        <h5 class="mb-0 ms-4 feature-info-title">Complimentary Cards</h5>
                    </div>
                    <div class="feature-info-content">
                        <p class="mb-0">Business cards are cards bearing business information about a company or individual.....</p>
                        <a href="service-detail.html" class="icon-btn"><i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                    <div class="feature-info-bg-img" style="background-image: url('{{asset('assets/images/feature-info/03.jpg')}}');"></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="feature-info feature-info-style-02 h-100">
                    <div class="feature-info-icon">
                        <i class="flaticon-chart"></i>
                        <h5 class="mb-0 ms-4 feature-info-title">Products Labels</h5>
                    </div>
                    <div class="feature-info-content">
                        <p class="mb-0">It must come from within as the natural product of your desire to achieve
                            something and your belief that you are capable to succeed at your goal.</p>
                        <a href="service-detail.html" class="icon-btn"><i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                    <div class="feature-info-bg-img" style="background-image: url('{{asset('assets/images/feature-info/04.jpg')}}');"></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="feature-info feature-info-style-02 h-100">
                    <div class="feature-info-icon">
                        <i class="flaticon-design"></i>
                        <h5 class="mb-0 ms-4 feature-info-title">Marketing Video Creation</h5>
                    </div>
                    <div class="feature-info-content">
                        <p class="mb-0">There is really no magic to it and it’s not reserved only for a select few
                            people. As such, success really has nothing to do with luck,</p>
                        <a href="service-detail.html" class="icon-btn"><i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                    <div class="feature-info-bg-img" style="background-image: url('{{asset('assets/images/feature-info/05.jpg')}}');"></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-info feature-info-style-02 h-100">
                    <div class="feature-info-icon">
                        <i class="flaticon-group"></i>
                        <h5 class="mb-0 ms-4 feature-info-title">Video Animation</h5>
                    </div>
                    <div class="feature-info-content">
                        <p class="mb-0">There are basically six key areas to higher achievement. Some people will tell
                            you there are four while others may tell you there are eight.</p>
                        <a href="service-detail.html" class="icon-btn"><i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                    <div class="feature-info-bg-img" style="background-image: url('{{asset('assets/images/feature-info/06.jpg')}}');"></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-info feature-info-style-02 h-100">
                    <div class="feature-info-icon">
                        <i class="flaticon-group"></i>
                        <h5 class="mb-0 ms-4 feature-info-title">Business Adverts</h5>
                    </div>
                    <div class="feature-info-content">
                        <p class="mb-0">There are basically six key areas to higher achievement. Some people will tell
                            you there are four while others may tell you there are eight.</p>
                        <a href="service-detail.html" class="icon-btn"><i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                    <div class="feature-info-bg-img" style="background-image: url('{{asset('assets/images/feature-info/06.jpg')}}');"></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-info feature-info-style-02 h-100">
                    <div class="feature-info-icon">
                        <i class="flaticon-group"></i>
                        <h5 class="mb-0 ms-4 feature-info-title">Online Training on</h5>
                    </div>
                    <div class="feature-info-content">
                        <p class="mb-0">There are basically six key areas to higher achievement. Some people will tell
                            you there are four while others may tell you there are eight.</p>
                        <a href="service-detail.html" class="icon-btn"><i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                    <div class="feature-info-bg-img" style="background-image: url('{{asset('assets/images/feature-info/06.jpg')}}');"></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-info feature-info-style-02 h-100">
                    <div class="feature-info-icon">
                        <i class="flaticon-group"></i>
                        <h5 class="mb-0 ms-4 feature-info-title">Graphics & Video Creation</h5>
                    </div>
                    <div class="feature-info-content">
                        <p class="mb-0">There are basically six key areas to higher achievement. Some people will tell
                            you there are four while others may tell you there are eight.</p>
                        <a href="service-detail.html" class="icon-btn"><i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                    <div class="feature-info-bg-img" style="background-image: url('{{asset('assets/images/feature-info/06.jpg')}}');"></div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 d-md-flex justify-content-center align-items-center">
                <p class="mb-3 mb-md-0 mx-0 mx-md-3">Start now! Your big opportunity may be right where you are!</p>
                <a href="#" class="btn btn-primary-round btn-round mx-0 mx-md-3">See All Services<i
                        class="fas fa-arrow-right ps-3"></i></a>
            </div>
        </div>
    </div>
</section>
<!--=================================
      Category -->

<!--=================================
      Action Box -->
<section class="space-pb dark-background">
    <div class="container">
        <div class="bg-dark text-center rounded py-5 px-3">
            <h2 class="text-white">Tell us about your idea, and we’ll make it happen.</h2>
            <h6 class="text-white">Have a brand problem that needs to be solved? We’d love to hear about it!</h6>
            <a href="#" class="btn btn-primary-round btn-round mx-0 mx-md-3 text-white">Let’s Get Started<i
                    class="fas fa-arrow-right ps-3"></i></a>
        </div>
    </div>
</section>
<!--=================================
      Action Box -->
@endsection