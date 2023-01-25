@extends('layouts.site')
@section('meta')
<title>{{ config('app.name') }}</title>

<meta name="title" content="{{ config('app.name') }}" />
<meta name="robots" content="all" />

<meta property="og:site_name" content="{{ config('app.name') }}" />
<meta property="og:image" content="{{ asset('assets/images/logo1.png') }}" />
<meta property="og:image:width" content="180" />
<meta property="og:image:height" content="50" />

<meta property="og:type" content=website />
<meta property="og:title" content="{{ config('app.name') }}" />

<meta name="twitter:title" content="{{ config('app.name') }}" />
<meta name="twitter:image" content="{{ asset('assets/images/logo1.png') }}" />
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/masterX/apply-now.css') }}" />
<style>
    .img-1-text{
        font-size: 13px;
        color: #022d62;
    }
</style>
@endsection
@section('content')
<!--================================= banner -->
<section class="banner align-items-center d-flex space-ptb bg-holder h-700 h-sm-500 bg-overlay-black-70"
    data-jarallax='{"speed": 0.4}' style="background-image: url({{asset('assets/images/slider/05.jpg')}});">
    <div class="container">
        <div class="row justify-content-center position-relative">
            <div class="col-xl-8 col-lg-10 mt-lg-5 pt-lg-4">
                <div class="d-md-flex align-item-center text-center text-md-start">
                    <h2 class="text-white fw-normal">We're MACS. We help drive change with technology.</h2>
                    <div class="banner-logo">
                        <span>MACS</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================================= banner -->



<!--================================= About -->
<section class="space-ptb">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title mb-0">
                    <h6 class="mb-2">MACS Foundation is  established with a mission to expand and enhance/improve the living standards of communities  especially in Africa. It works and assist in providing housing, health and nutrition  for the most vulnerable  and marginalized people majority of whom are  older persons. </h6>
                </div>
                <p>AMACS Foundation has been  actively carrying out charitable activities in  Africa and has been working relentlessly to find  prompt solutions to address some of Africa’s biggest challenges. MACS Foundation  provides humanitarian response to most emergency, community development needs around food insecurity, health care,  lack of potable water,  insufficient energy access, and lack of basic education materials, particularly among women, youths and the aged. </p>
                <p>Since it's creation, MACS Foundation. has successfully
                    initiated and promoted programmes with the objective advancing the status, well being, safety and security of vulnerable and needy persons especially older persons, through it's community based health care services for  bedridden, vulnerable and needy older persons. MACS Foundation has equally been very active in the  educational melieu with the provision of education materials to to the needy.
                </p>
                <a href="{{route('foundation-about')}}" class="btn btn-light-round btn-round w-space">Know More About<i class="fas fa-arrow-right ps-3"></i></a>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-sm-6">
                        <img class="img-fluid border-radius mt-4"  src="{{ asset('assets/images/gallery3/f-1.jpeg') }}" alt="">
                        <p class="mb-2 img-1-text">A team of volunteers at MACS Charity Foundation who has opted to facilitate the distribution of the donated items.</p>
                        <img class="img-fluid border-radius mt-4"  src="{{ asset('assets/images/gallery3/f-2.jpeg') }}" alt="">
                        <p class="img-1-text">The founder of MACS Charity Foundation and some donors years back.</p>
                    </div>
                    <div class="col-sm-6">
                        <iframe class="border-radius mt-4 h-75" src="{{asset('assets/images/gallery3/f-3.mp4')}}" frameborder="0"></iframe>
                        <p class="img-1-text">With MACS the problem of starvation amongst the old and poor people is combat</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================  About -->


<!--================================= Contact -->
<section class="bg-dark space-pb" style="padding-bottom:50px;margin-top:100px;">
    <div class="container">
        <div class="row justify-content-center d-flex align-items-end">
            <div class="col-lg-6">
                <div class="mt-n5 mt-lg-n6 bg-white p-4 shadow">
                    <h4>Complete the form below. Donate and help us for improve.</h4>
                    <form class="mt-4 row" method="POST" action="{{route('send-donation')}}" id="request-form">
                        <input type="text" id="transaction_status" hidden name="transaction_status">
                        <input type="text" id="transaction_id" hidden name="transaction_id">
                        <div class="mb-3 col-12">
                            <input type="text" required name="first_name" class="form-control" id="exampleInputName"
                                placeholder="First Name">
                        </div>
                        <div class="mb-3 col-12">
                            <input type="text" required name="last_name" class="form-control" id="exampleInputLname"
                                placeholder="Last Name">
                        </div>
                        <div class="mb-3 col-12">
                            <input type="text" required name="email" class="form-control" id="exampleInputEmail"
                                placeholder="Email Address">
                        </div>
                        <div class="mb-3 col-12">
                            <input type="text" required name="mobile" class="form-control" id="exampleInputLnumber"
                                placeholder="Phone Number">
                        </div>
                        <div class="mb-3">
                            <input type="text" required name="address" class="form-control" id="exampleInputLAddress"
                                placeholder="Address">
                        </div>
                        <div class="mb-3">
                            <input type="number" id="amount" required name="amount" class="form-control"
                                id="exampleInputLmoney" min="10" placeholder="Amount , Max: $10">
                            @if($errors->has('amount'))
                            <div class="form-control">
                                <span class="invalid-feedback">{{ $errors->first('amount') }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="mb-0 col-12 ">
                            <div class="d-grid">
                                <button type="submit" id="request-btn" class="btn btn-primary">Donate<i
                                        class="fas fa-arrow-right ps-3"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================  Contact -->


<!--=================================   About -->
<section class="space-ptb">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="section-title text-center">
                    <h5 class="text-muted">IT consultancy services </h5>
                    <h4>MACS IT consultancy services via our deep and rich tech background has over the years helped
                        Large, medium and small scale business solve their IT related problems with relative ease. </h4>
                    <p class="mb-4">MACS is a reliable solution providing entity for all your technology needs. Our
                        highly trained team of technicians and consultants are fully equipped and have the expertise
                        cutting acros various fields in today’s complex technologies. With this , our services allow
                        your organization or business to enjoy a variety of advantages, ranging from lower cost,
                        improved efficiency, and untamed success in today’s competitive markets.</p>
                    <p> It is worth noting that based on how we work, it has been confirmed by both private and public
                        sector institutions working with us that, MACS offer one of the most comprehensive,
                        affordably-priced service maintenance and IT support plans in the IT industry.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 mb-4 mb-sm-0">
                <img class="img-fluid border-radius" src="{{ asset('assets/images/about/10.jpg') }}" alt="">
            </div>
            <div class="col-sm-6">
                <img class="img-fluid border-radius" src="{{ asset('assets/images/about/11.jpg') }}" alt="">
            </div>
        </div>
        <div class="d-flex justify-content-center pt-5">
            <a href="{{route('it-consultancy-about')}}" class="btn btn-light-round btn-round w-space">Know More About<i class="fas fa-arrow-right ps-3"></i></a>
        </div>
</section>
<!--=================================  About -->


<!-- Payment Modal -->
<div class="modal fade" id="donationNowModal" aria-labelledby="donationNowModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Apply Now</h4>
                <button id="paymentConatinerOutButton" type="button" class="btn btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="paymentContainer">
                    <h6 class="text-center">Donate
                        <span class="alert alert-success" id="amount_detail" role="alert"> </span>.
                        With Paypal Thank You.
                    </h6>

                    <div id="paypal-button-container"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script
    src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency={{ env('PAYPAL_CURRENCY') }}"></script>
<script src="{{ asset('assets/js/masterX/donation.js') }}"></script>
@endsection