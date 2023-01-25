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
                            <li>Gallery</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->

    <!-- start wpo-portfolio-section -->
    <section class="wpo-portfolio-section-s5 section-padding pb-0" id="gallery">
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
                    </div>
                </div>
            </div>
        </div>
        <!-- Pagination -->
        <div class="row">
            <div class="pagination-outer">
                <div class="pagination-style1">
                    {{$images->links()}}
                </div>
            </div>
        </div>
    </section>
<!-- end wpo-portfolio-section -->
</div>
@endsection