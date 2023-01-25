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
@section('css')
<style>
    .overflow-text{
        word-wrap: break-word; 
    }
</style>
@endsection
@section('content')
@php
    $setting = App\Models\Setting::select('address','mobile','email')->first();
@endphp
<div class="page-wrapper">
    <!-- start wpo-page-title -->
    <section class="wpo-page-title">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="wpo-breadcumb-wrap">
                        <h2>Contact</h2>
                        <ol class="wpo-breadcumb-wrap">
                            <li><a href="{{route('event-home')}}">Home</a></li>
                            <li>Contact</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->
    <!-- start wpo-contact-pg-section -->
    <section class="wpo-contact-pg-section section-padding" style="margin-bottom: 200px;">
        <div class="container">
            <div class="row">
                <div class="col col-lg-10 offset-lg-1">
                    <div class="office-info">
                        <div class="row">
                            <div class="col col-xl-4 col-lg-6 col-md-6 col-12">
                                <div class="office-info-item">
                                    <div class="office-info-icon">
                                        <div class="icon">
                                            <i class="fi flaticon-maps-and-flags"></i>
                                        </div>
                                    </div>
                                    <div class="office-info-text">
                                        <h2>Address</h2>
                                        <p class="overflow-text">{{$setting->address}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-xl-4 col-lg-6 col-md-6 col-12">
                                <div class="office-info-item">
                                    <div class="office-info-icon">
                                        <div class="icon">
                                            <i class="fi flaticon-email"></i>
                                        </div>
                                    </div>
                                    <div class="office-info-text">
                                        <h2>Email Us</h2>
                                        <p class="overflow-text">{{$setting->email}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-xl-4 col-lg-6 col-md-6 col-12">
                                <div class="office-info-item">
                                    <div class="office-info-icon">
                                        <div class="icon">
                                            <i class="fi flaticon-phone-call"></i>
                                        </div>
                                    </div>
                                    <div class="office-info-text">
                                        <h2>Call Now</h2>
                                        <p class="overflow-text">{{$setting->mobile}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wpo-contact-title">
                        <h2>Have Any Question?</h2>
                        <p>It is a long established fact that a reader will be distracted
                            content of a page when looking.</p>
                    </div>
                    <div class="wpo-contact-form-area">
                        <form method="post" action="{{route('event-enquiry')}}" class="contact-validation-active"
                            id="contact-form-main1">
                            @csrf
                            <div>
                                <input type="text" required class="form-control" name="name" id="name"
                                    placeholder="Name">
                            </div>
                            <div>
                                <input class="form-control" name="mobile" required type="number" required id="mobile"
                                    placeholder="Mobile">
                            </div>
                            <div class="fullwidth">
                                <input type="email" required class="form-control" name="email" id="email"
                                    placeholder="Email">
                            </div>
                            <div class="fullwidth">
                                <textarea required name="message" class="form-control"
                                    id="exampleInputEnquiry-Description" placeholder="Message" rows="5"></textarea>
                            </div>
                            <div class="submit-area">
                                <button type="submit" id="contact-btn-main" class="theme-btn-s4">Get in Touch</button>
                                <div id="loader">
                                    <i class="ti-reload"></i>
                                </div>
                            </div>
                            <div class="clearfix error-handling-messages">
                                <div id="success">Thank you</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- end container -->
    </section>
    <!-- end wpo-contact-pg-section -->
</div>
@endsection
@section('js')
<script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{asset('assets/js/masterX/event-contact.js')}}"></script>
@endsection