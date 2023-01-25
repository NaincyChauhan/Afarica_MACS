@extends('layouts.site') @section('meta')
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

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="idigitalgroups.com" />
<meta name="twitter:title" content="{{ config('app.name') }}" />
<meta name="twitter:description" content="" />
<meta name="twitter:image" content="{{ asset('storage/products/fabricator.jpeg') }}" />
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('assets/css/masterX/jobs.css')}}">
@endsection
@section('js')
<script src="{{asset('assets/js/masterX/jobs.js')}}"></script>
@endsection
@section('content')
<!--=================================  contact Form -->
<section>
    <div class="px-4" >
        <div class="row justify-content-lg-around position-relative pt-5">
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="is-sticky">
                    <div class="row py-3 ">
                        <div class="px-2">
                            <h6>Filter</h6>
                            <div class="mb-4  shadow-sm p-3 mt-2 bg-body rounded">
                                <div class="w-100">
                                    <form action="{{route('real-estate-listing')}}">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="search" class="form-label  mb-0 mt-2">Search</label>
                                                <input name="search" value="{{Session::has('search') ? Session::get('search') : ''}}" id="search" class="form-control" required placeholder="Search">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="city" class="form-label  mb-0 mt-2">City</label>
                                                <input name="city" value="{{Session::has('city') ? Session::get('city') : ''}}" id="city" class="form-control" required placeholder="Enter City">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="state" class="form-label  mb-0 mt-2">State</label>
                                                <input name="state" value="{{Session::has('state') ? Session::get('state') : ''}}" id="state" class="form-control" required placeholder="Enter State">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="country" class="form-label  mb-0 mt-2">Country</label>
                                                <input name="country" value="{{Session::has('country') ? Session::get('country') : ''}}" id="country" class="form-control" required placeholder="Enter Country">
                                            </div>
                                            <div class="col-md-12">
                                                <div class="d-grid gap-2">
                                                    <button class="btn btn-primary rounded mt-4"  type="submit">Filter</button>
                                                  </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="accordion" id="accordionExample">
                            <input type="text" hidden id="search-url" value="{{route('ajax-search-real-estate-listing')}}">
                            <input type="text" hidden id="job-type" value="">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingShorting">
                                    <button class="accordion-button shadow-sm p-3 mb-2 bg-body rounded collapsed"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#ShortingCollapse"
                                        aria-expanded="false" aria-controls="ShortingCollapse">
                                        Shorting
                                    </button>                                    
                                </h2>
                                <div id="ShortingCollapse" class="accordion-collapse collapse show"
                                    aria-labelledby="headingShorting" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <input value="" class="form-check-input" type="radio" name="ShortingRadioDefault" id="ShortingRadioDefault1">
                                                <label class="form-check-label" for="ShortingRadioDefault1">
                                                    All
                                                </label>                                                
                                            </li>
                                            <li class="list-group-item">
                                                <input value="alphabetically_a_z" class="form-check-input" type="radio" name="ShortingRadioDefault" id="ShortingRadioDefault2">
                                                <label class="form-check-label" for="ShortingRadioDefault2">
                                                    Alphabetically A to Z
                                                </label>                                                
                                            </li>
                                            <li class="list-group-item">                                                
                                                <input value="alphabetically_z_a" class="form-check-input" type="radio" name="ShortingRadioDefault" id="ShortingRadioDefault3">
                                                <label class="form-check-label" for="ShortingRadioDefault3">
                                                    Alphabetically Z to A
                                                </label>
                                            </li>
                                            <li class="list-group-item">
                                                <input value="date_new_to_old" class="form-check-input" type="radio" name="ShortingRadioDefault" id="ShortingRadioDefault4">
                                                <label class="form-check-label" for="ShortingRadioDefault4">
                                                    New to Old
                                                </label>
                                            </li>
                                            <li class="list-group-item">                                                
                                                <input value="date_old_to_new" class="form-check-input" type="radio" name="ShortingRadioDefault" id="ShortingRadioDefault5">
                                                <label class="form-check-label" for="ShortingRadioDefault5">
                                                    Old to New
                                                </label>
                                            </li>
                                            <li class="list-group-item">                                                
                                                <input value="date_new_to_old" class="form-check-input" type="radio" name="ShortingRadioDefault" id="ShortingRadioDefault6">
                                                <label class="form-check-label" for="ShortingRadioDefault6">
                                                    Latest
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingShowing">
                                    <button class="accordion-button shadow-sm p-3 mb-2 bg-body rounded collapsed"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#ShowingCollapse"
                                        aria-expanded="false" aria-controls="ShowingCollapse">
                                        Show
                                    </button>
                                </h2>
                                <div id="ShowingCollapse" class="accordion-collapse collapse"
                                    aria-labelledby="headingShowing" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <input value="" class="form-check-input" type="radio" name="ShowingRadioDefault" id="ShowingRadioDefault1">
                                                <label class="form-check-label" for="ShowingRadioDefault1">
                                                    All
                                                </label>                                                
                                            </li>
                                            <li class="list-group-item">
                                                <input value="1" class="form-check-input" type="radio" name="ShowingRadioDefault" id="ShowingRadioDefault2">
                                                <label class="form-check-label" for="ShowingRadioDefault2">
                                                    Show 1
                                                </label>                                                
                                            </li>
                                            <li class="list-group-item">                                                
                                                <input value="16" class="form-check-input" type="radio" name="ShowingRadioDefault" id="ShowingRadioDefault3">
                                                <label class="form-check-label" for="ShowingRadioDefault3">
                                                    Show 16
                                                </label>
                                            </li>
                                            <li class="list-group-item">
                                                <input value="32" class="form-check-input" type="radio" name="ShowingRadioDefault" id="ShowingRadioDefault4">
                                                <label class="form-check-label" for="ShowingRadioDefault4">
                                                    Show 32
                                                </label>
                                            </li>
                                            <li class="list-group-item">                                                
                                                <input value="64" class="form-check-input" type="radio" name="ShowingRadioDefault" id="ShowingRadioDefault5">
                                                <label class="form-check-label" for="ShowingRadioDefault5">
                                                    Show 64
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="row" id="listing-data" >
                    @if (count($listings) <= 0)
                        <div class="text-center">
                            <img src="{{asset('assets/images/no-items-found.png')}}" width="35%" alt="No Items Find" srcset="">
                        </div>
                    @endif
                    
                    @foreach ($listings as $listing)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="blog-post">
                                <div class="blog-post-image">
                                    <img style="max-height: 540px" class="img-fluid" src="{{ asset('storage/listings/'.$listing->image[0]) }}" alt="Course Image">
                                    @if (!empty($listing->sell_price))                
                                        @php
                                            $discount = 0 ;
                                            $discount = (($listing->regular_price - $listing->sell_price) * 100) / $listing->regular_price;
                                        @endphp									
                                        <span class="discount-info">{{number_format((float)$discount, 2, '.', '')}}%</span>
                                    @endif
                                </div>
                                <div class="blog-post-content">
                                    <div class="blog-post-info mb-0">
                                        <div>
                                            @if (!empty($listing->sell_price))                        
                                                <a target="_blank"  href="{{route('listing-detail',['slug'=>$listing->slug])}}" class="text-primary"><span class="font-weight-bold font-17">${{$listing->sell_price}}</span> <span class="text-muted font-italic line-through regular-price">${{$listing->regular_price}}</span></a>
                                            @else
                                                <a target="_blank"  href="{{route('listing-detail',['slug'=>$listing->slug])}}" class="text-primary"><span class="font-weight-bold font-17">${{$listing->regular_price}}</span> </a>
                                            @endif
                                        </div>
                                        <div class="blog-post-date course-created-date">
                                            <a target="_blank"  href="{{route('listing-detail',['slug'=>$listing->slug])}}">{{ date("M d, Y", strtotime($listing->created_at)) }}</a>
                                        </div>
                                    </div>
                                    <div class="blog-post-details">                                        
                                        <h5 class="blog-post-title mb-0">
                                            <a target="_blank" class="course-title giveMeEllipsis"  href="{{route('listing-detail',['slug'=>$listing->slug])}}">
                                                {{$listing->title}}
                                            </a>
                                        </h5>
                                        <p class="giveMeEllipsis">
                                            {{$listing->description}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Pagination -->
                    <div class="row">
                        <div class="pagination-outer">
                            <div class="pagination-style1">
                                {{$listings->links()}}
                            </div>
                        </div>
                    </div>
                </div>
                <div id="loading-area" style="display: none;">
                    <div  class="row d-flex flex-row">
                        @for ($i = 0; $i < 6; $i++) 
                            <div class="col-md-4" >
                                <div class="row">
                                    <div id="loadingArea">
                                        <div class="content-loader">
                                            <div class="wrapper animated-background rounded" style="height: 150px;">
                                                <div class="loading"></div>
                                            </div>
                                            <div class="">
                                                <div class="row px-3">
                                                    <div class="col-md-12  wrapper animated-background" style="height: 28px;">
                                                        <div class="loading"></div>
                                                    </div>
                                                    <div class="col-md-12 wrapper animated-background" style="width: 80%;height: 17px;">
                                                        <div class="loading"></div>
                                                    </div>
                                                    <div class="col-md-12 wrapper animated-background" style="width: 71%;height: 9px;">
                                                        <div class="loading"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================  contact Form  -->
@endsection