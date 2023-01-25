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
    .slick-list{
        height: 492px !important; 
        overflow-y: auto;
    }
    .slick-list::-webkit-scrollbar {
        display: none;
    }
    @media (max-width: 802px) and (max-width: 638px)    {
        .slick-list {
            height: 392px !important;
        }
    }
    @media  (max-width: 638px)    {
        .slick-list {
            height: 292px !important;
        }
    }
    @media  (max-width: 444px)    {
        .slick-list {
            height: 192px !important;
        }
    }
    @media  (max-width: 280px)    {
        .slick-list {
            height: 112px !important;
        }
    }
</style>
@endsection
@section('content')
<div class="page-wrapper">
<!-- start wpo-page-title -->
        <section class="wpo-page-title">
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="wpo-breadcumb-wrap">
                            <h2>{{$event->title}}</h2>
                            <ol class="wpo-breadcumb-wrap">
                                <li><a href="{{route('event-home')}}">Home</a></li>
                                <li><a href="{{route('events')}}">Events</a></li>
                                <li>{{$event->title}}</li>
                            </ol>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>
        <!-- end page-title -->
         <!-- start wpo-shop-single-section -->
         <section class="wpo-shop-single-section section-padding" style="padding-top: 60px;">
             <div class="container">
                <div class="row">
                    <div class="col col-lg-12 col-12">
                        <div class="shop-single-slider">
                            <div class="row">
                                <div class="col-lg-3 col-3" >
                                    <div class="slider-nav">
                                        @foreach ($event->image as $image)                                            
                                            <div><img src="{{asset('storage/events/'.$image)}}" alt></div>                                        
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-9 col col-9" >
                                    <div class="slider-for">
                                        @foreach ($event->image as $image) 
                                            <div><img src="{{asset('storage/events/'.$image)}}" alt style="cursor: -webkit-grab; cursor: grab;"  ></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->

                <div class="row">
                    <div class="col col-xs-12">
                        <div class="product-info">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description"
                                        role="tab" aria-controls="Description" aria-selected="true">Description</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="Description">                                    
                                    <p>{{$event->desc}}</p>
                                    {!! $event->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end of container -->
        </section>
        <!-- end of wpo-shop-single-section -->
</div>
@endsection
@section('js')
@endsection