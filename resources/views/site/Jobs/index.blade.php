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
<section class="space-ptb">
    <div class="container">
        <div class="row py-3 ">
            <div class="d-flex justify-content-between" id="FilterSection">
                <div class="search">
                    <form action="{{(isset($type) && $type == 0) ? route('it-consultancy-jobs') : route('health-consultancy-jobs')}}" role="search">
                        <div class="d-flex justify-content-start">
                            <input name="search" class="form-control my-search-button" type="search" placeholder="Search" aria-label="Search">
                            <button class="" id="mysearchbutton" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="sorting d-flex justify-content-start">
                    <div class="px-3">
                        <select id="data_sort_filter" job-type="{{$type}}" url="{{route('ajax-search-listing')}}" class="form-select" aria-label="Default select example">
                            <option value="">All</option>
                            <option value="alphabetically_a_z">Alphabetically A to Z</option>
                            <option value="alphabetically_z_a">Alphabetically Z to A</option>
                            <option value="date_new_to_old">New to Old</option>
                            <option value="date_old_to_new">Old to New</option>
                            <option value="date_new_to_old">Latest</option>
                        </select>
                    </div>
                    <div>
                        <select id="change_data_show_number" job-type="{{$type}}" url="{{route('ajax-search-listing')}}" class="form-select" aria-label="Default select example">
                            <option value="0" >All</option>
                                <option value="8" >Show 8</option>
                                <option value="16" >Show 16</option>
                                <option value="32" >Show 32</option>
                                <option value="64" >Show 64</option>                                
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="listing-data" >
            @if (count($jobs) <= 0)
                <div class="text-center">
                    <img src="{{asset('assets/images/no-items-found.png')}}" width="35%" alt="No Items Find" srcset="">
                </div>
            @endif
            
            @foreach ($jobs as $job)                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="blog-post">
                        <div class="blog-post-image">
                            <img class="img-fluid" src="{{ asset('storage/jobs/'.$job->image) }}" alt="Job Image">
                        </div>
                        <div class="blog-post-content">
                            <div class="blog-post-info">
                                <div class="blog-post-author">
                                    <a target="_blank"  href="{{route('job-detail',['slug' => $job->slug])}}" class="btn btn-light-round btn-round text-primary">{{$job->company_name}}</a>
                                </div>
                                <div class="blog-post-date">
                                    <a target="_blank"  href="{{route('job-detail',['slug' => $job->slug])}}">{{ date("M d, Y", strtotime($job->created_at)) }}</a>
                                </div>
                            </div>
                            <div class="blog-post-details">
                                <h5 class="blog-post-title">
                                    <a target="_blank"  href="{{route('job-detail',['slug' => $job->slug])}}">{{$job->title}}</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="row">
                <div class="pagination-outer">
                    <div class="pagination-style1">
                        {{$jobs->links()}}
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
</section>
<!--================================= Job Listing End -->
@endsection