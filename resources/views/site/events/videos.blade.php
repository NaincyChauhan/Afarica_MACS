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
<div class="page-wrapper">
    <!-- start wpo-page-title -->
    <section class="wpo-page-title">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="wpo-breadcumb-wrap">
                        <h2 class="monallesia-font">Gallery</h2>
                        <ol class="wpo-breadcumb-wrap">
                            <li><a href="{{route('event-home')}}">Home</a></li>
                            <li><a>Event and Decor</a></li>
                            <li>Videos</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->

    <!-- start wpo-blog-pg-section -->
     <section class="wpo-blog-pg-section section-padding">
        <div class="container">
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
            <!-- Pagination -->
            <div class="row">
                <div class="pagination-outer">
                    <div class="pagination-style1">
                        {{$videos->links()}}
                    </div>
                </div>
            </div>
        </div> <!-- end container -->
    </section>
    <!-- end wpo-blog-pg-section -->
</div>
@endsection