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
@endsection
@section('content')
<div class="page-wrapper">
    <!-- start wpo-page-title -->
    <section class="wpo-page-title">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="wpo-breadcumb-wrap">
                        <h2 class="monallesia-font">Events</h2>
                        <ol class="wpo-breadcumb-wrap">
                            <li><a href="{{route('event-home')}}">Home</a></li>
                            <li><a>Event and Decor</a></li>
                            <li>Events</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->

    <!-- start wpo-Service-section -->
    <section class="wpo-Service-section section-padding" id="Service">
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
                <!-- Pagination -->
                <div class="row">
                    <div class="pagination-outer">
                        <div class="pagination-style1">
                            {{$events->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end container -->
    </section>
    <!-- end Service-section -->
</div>
@endsection
@section('js')
@endsection