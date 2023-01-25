@extends('layouts.site') @section('meta')
<title>{{ config('app.name') }}</title>

<meta name="title" content="{{ config('app.name') }}" />
<meta name="keywords" content="{{$listing->keywords}}" />
<meta name="description" content="{{$listing->description}}" />
<meta name="robots" content="all" />

<meta property="og:site_name" content="{{ config('app.name') }}" />
<meta property="og:image" content="{{ asset('storage/listings/'.$listing->image[0]) }}" />
<meta property="og:image:width" content="180" />
<meta property="og:image:height" content="50" />

<meta property="og:type" content=website />
<meta property="og:title" content="{{ config('app.name') }}" />
<meta property="og:description" content="{{$listing->description}}" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="{{config('app.url')}}" />
<meta name="twitter:title" content="{{ config('app.name') }}" />
<meta name="twitter:description" content="{{$listing->description}}" />
<meta name="twitter:image" content="{{ asset('storage/listings/'.$listing->image[0]) }}" />
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('assets/css/masterX/jobs.css')}}">
@endsection
@section('content')
<!--=================================
    Blog -->
<section class="space-ptb p-t-50">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="blog-detail">
                    <div class="blog-post mb-4 mb-md-5 mb-4">
                        <div class="blog-post-image">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($listing->image as $image)                                                
                                            <div class="carousel-item {{ $loop->iteration == 1 ? 'active' : ''  }}">
                                                <img src="{{ asset('storage/listings/'.$image) }}" class="d-block w-100" style="max-height: 370px;" alt="Listing Image">
                                            </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                          <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                          <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <h4 class="blog-post-title pt-2">
                                            {{ Str::title($listing->title)}}
                                        </h4>
                                        @if (!empty($listing->regular_price) || !empty($listing->sell_price) )
                                            @if ($listing->regular_price > 0 || $listing->sell_price > 0 )                                                
                                                <div>
                                                    @if (!empty($listing->sell_price))                        
                                                        <a target="_blank" class="pb-2"  href="{{route('listing-detail',['slug'=>$listing->slug])}}">
                                                            <span class="font-weight-bold font-20 color-black">${{$listing->regular_price}}</span> 
                                                            <span class="text-muted font-italic line-through regular-price font-17">${{$listing->sell_price}}</span>
                                                            @php
                                                                $discount = 0 ;
                                                                $discount = (($listing->regular_price - $listing->sell_price) * 100) / $listing->regular_price;
                                                            @endphp	                                                            
                                                            <span class="text-muted course-discount text-primary">{{number_format((float)$discount, 2, '.', '')}}% off</span>
                                                        </a>
                                                    @else
                                                        <a target="_blank" class="pb-2"  href="{{route('listing-detail',['slug'=>$listing->slug])}}"><span class="font-weight-bold font-20 color-black">${{$listing->regular_price}}</span> </a>
                                                    @endif
                                                </div>
                                            @endif
                                        @endif
                                        <p class="font-16">{{$listing->description}}</p>                                        
                                        <div>
                                            <p>
                                                <img class="pr-2 text-primary" src="{{asset('assets/images/location_dot.png')}}" alt="location" width="20px">
                                                <span class="total-duration address">{{$listing->address}}.</span>
                                            </p>
                                        </div>
                                        <div>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#watchlistingmaplocation" class="btn btn-success rounded mb-3 text-white">
                                                <span><i class="fas fa-location-arrow text-white total-duration-icon font-14"></i></span>View on Map</button>
                                        </div>
                                        <div class="d-grid gap-2">                                            
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#enquiryNowModal" class="btn btn-primary text-white w-space rounded width-100">Enquiry Now<i class="fas fa-address-card ps-3"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="blog-post-content">
                            <div class="blog-post-details">
                                <h5 class="blog-post-title">
                                    Content.
                                </h5>
                                <div class="mb-4">{!! $listing->content !!}</div>
                                <div class="d-sm-flex align-items-center">
                                    <div class="social d-flex align-items-center">
                                        <p class="text-primary mb-0 pe-2">Share this post:</p>
                                        <a target="_blank"
                                            href="https://www.facebook.com/sharer.php?u={{ route('listing-detail', $listing->slug) }}"><i
                                                class="fab fa-facebook-f pe-3 text-light"></i></a>
                                        <a target="_blank"
                                            href="https://twitter.com/share?url={{ route('listing-detail', $listing->slug) }}"><i
                                                class="fab fa-twitter pe-3 text-light"></i></a>
                                        <a target="_blank"
                                            href="https://api.whatsapp.com/send?text=*{{$listing->title}}*{{route('listing-detail', $listing->slug)}}"><i
                                                class="fab fa-whatsapp pe-3 text-light"></i></a>
                                        <a target="_blank"
                                            href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('listing-detail', $listing->slug) }}"><i
                                                class="fab fa-linkedin text-light"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div > 
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================  Blog -->

<!-- start map location Modal -->
<div class="modal fade" id="watchlistingmaplocation" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header p-4">
                <div>
                    <h5 class="modal-title" id="video-title">{{ Str::title($listing->title)}}</h5>
                </div>
                <button type="button" id="close-button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="map-location">
                    {!! $listing->map_location !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End map location Modal-->

<!-- Modal -->
<div class="modal fade" id="enquiryNowModal" role="dialog" aria-labelledby="enquiryNowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="enquiryNowModalLabel">Enquiry Now</h5>
          <button type="button" id="close-button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <form class="mt-4 row" method="POST" id="enquiryNowForm" action="{{route('submit-listing-enquiry')}}" enctype="multipart/form-data">
                @csrf
                <input type="text" hidden name="listing_id" value="{{$listing->id}}">
                <div class="mb-3 col-12">
                  <input type="text" class="form-control" name="name" id="exampleInputName" placeholder="Your Name">
                </div>
                <div class="mb-3 col-12">
                  <input type="email" name="email" class="form-control" id="exampleInputEmail" placeholder="Email Address">
                </div>
                <div class="mb-3 col-12">
                  <input type="number" name="mobile" class="form-control" id="exampleInputLnumber" placeholder="Phone Number">
                </div>
                <div class="col-lg-12 mb-3">
                  <input type="text" name="address" class="form-control" id="exampleInputWebsite" placeholder="Address">
                </div>
                <div class="col-lg-12 mb-3">
                    <textarea name="message" required class="form-control" id="exampleInputEnquiry-Description"
                        placeholder="Message" rows="5"></textarea>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" id="enquiryNowBtn" class="btn btn-primary">Submit</button>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency={{ env('PAYPAL_CURRENCY') }}"></script>
<script src="{{asset('assets/js/masterX/listing-detail.js')}}"></script>
@endsection