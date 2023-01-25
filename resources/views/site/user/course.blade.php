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
<section class="space-ptb p-t-50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row" id="listing-data" >
                    {{-- {{dd($courses->course)}} --}}
                    @if (count($usercourses) <= 0)
                        <div class="text-center">
                            <img src="{{asset('assets/images/no-items-found.png')}}" width="35%" alt="No Items Find" srcset="">
                        </div>
                    @endif
                    
                    @foreach ($usercourses as $usercourse)
                        @php
                            $course = $usercourse->course;
                        @endphp
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="blog-post">
                                <div class="blog-post-image">
                                    <img style="max-height: 540px" class="img-fluid" src="{{ asset('storage/courses/'.$course->thumbnail) }}" alt="Course Thumbnail">
                                </div>
                                <div class="blog-post-content">                                    
                                    <div class="blog-post-details">
                                        @if (count($course->coursereview) > 0)                                            
                                            @php
                                                $coursereview = 0;
                                                $reviewcount = count($course->coursereview);                                            
                                                foreach ($course->coursereview as $review) {
                                                    $coursereview += $review->ratting;
                                                }
                                                $course_review_average = ($coursereview/$reviewcount);
                                            @endphp
                                            <div class="ratting-section">
                                                <span class="ratting-average font-17">{{number_format((float)$course_review_average, 1, '.', '')}}</span>
                                                @for ($i = 0; $i < number_format((float)$course_review_average, 0, '.', ''); $i++)
                                                <span> <i class="fas fa-star ratting-star"></i> </span>
                                                @endfor
                                                <span class="total-ratting">({{$reviewcount}})</span>
                                            </div>
                                        @endif
                                        <h5 class="blog-post-title mb-0">
                                            <a target="_blank" class="course-title"  href="{{route('course-detail',['slug'=>$course->slug])}}">{!! Str::limit($course->title, 80, ' ...') !!}</a>
                                        </h5>
                                        <p>
                                            {!! Str::limit($course->description, 45, ' ...') !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
        
                    <div class="row">
                        <div class="pagination-outer">
                            <div class="pagination-style1">
                                {{$usercourses->links()}}
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
<!--================================= Job Listing End -->
@endsection