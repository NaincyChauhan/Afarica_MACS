@extends('layouts.site') @section('meta')
<title>{{ config('app.name') }}</title>

<meta name="title" content="{{ config('app.name') }}" />
<meta name="keywords" content="{{$course->keywords}}" />
<meta name="description" content="{{$course->description}}" />
<meta name="robots" content="all" />

<meta property="og:site_name" content="{{ config('app.name') }}" />
<meta property="og:image" content="{{ asset('storage/courses/'.$course->image) }}" />
<meta property="og:image:width" content="180" />
<meta property="og:image:height" content="50" />

<meta property="og:type" content=website />
<meta property="og:title" content="{{ config('app.name') }}" />
<meta property="og:description" content="{{$course->description}}" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="{{config('app.url')}}" />
<meta name="twitter:title" content="{{ config('app.name') }}" />
<meta name="twitter:description" content="{{$course->description}}" />
<meta name="twitter:image" content="{{ asset('storage/courses/'.$course->image) }}" />
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
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#watchcoursecontentvideo" class="rounded">
                                        <img src="{{asset('assets/images/video.png')}}" class="watch-icon shadow-lg bg-white rounded-circle" width="60px" alt="watch">
                                    </a>
                                    <img class="img-fluid" style="min-height:307px;" src="{{ asset('storage/courses/'.$course->thumbnail) }}" alt="Course Thumbnail">
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <h4 class="blog-post-title pt-4">
                                            {{ Str::title($course->title)}}
                                        </h4>
                                        @if (!empty($course->regular_price) || !empty($course->sell_price) )
                                            @if ($course->regular_price > 0 || $course->sell_price > 0 )                                                
                                                <div>
                                                    @if (!empty($course->sell_price))                        
                                                        <a target="_blank" class="pb-2"  href="{{route('course-detail',['slug'=>$course->slug])}}">
                                                            <span class="font-weight-bold font-20 color-black">${{$course->regular_price}}</span> 
                                                            <span class="text-muted font-italic line-through regular-price font-17">${{$course->sell_price}}</span>
                                                            @php
                                                                $discount = 0 ;
                                                                $discount = (($course->regular_price - $course->sell_price) * 100) / $course->regular_price;
                                                            @endphp	                                                            
                                                            <span class="text-muted course-discount text-primary">{{number_format((float)$discount, 2, '.', '')}}% off</span>
                                                        </a>
                                                    @else
                                                        <a target="_blank" class="pb-2"  href="{{route('course-detail',['slug'=>$course->slug])}}"><span class="font-weight-bold font-20 color-black">${{$course->regular_price}}</span> </a>
                                                    @endif
                                                </div>
                                            @endif
                                        @endif
                                        <p class="font-16">{{$course->description}}</p>
                                        <div class="pb-2 pt-2">
                                            @if (count($course->coursereview) > 0)  
                                                <div class="ratting-section">
                                                    <span class="ratting-average font-17">{{number_format((float)$course->ratting, 1, '.', '')}}</span>
                                                    @for ($i = 0; $i < number_format((float)$course->ratting, 0, '.', ''); $i++)
                                                    <span> <i class="fas fa-star ratting-star"></i> </span>
                                                    @endfor
                                                    <span class="total-ratting">({{$course->coursereview->count()}})</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p>
                                                <span><i class="fas fa-clock text-primary total-duration-icon"></i></span>
                                                <span class="total-duration">Total Duration : {{$course->duration}}.</span>
                                            </p>
                                            @if (empty($course->regular_price) && empty($course->sell_price))
                                            <p><span class="my-badge rounded">Free</span></p>
                                            @endif
                                        </div>
                                        <div class="d-grid gap-2">
                                            @if (Auth::user())                                                
                                                @if (empty($course->regular_price) && empty($course->sell_price) )
                                                    <a href="{{route('course-content',['slug'=>$course->slug])}}" class="btn btn-primary text-white w-space rounded width-100">Watch<i class="fas fa-address-card ps-3"></i></a>
                                                @elseif ($course->usercourse->where('user_id',Auth::user()->id)->first() && $course->usercourse->where('user_id',Auth::user()->id)->first()->payment_status == 'COMPLETED')                                                    
                                                    <a href="{{route('course-content',['slug'=>$course->slug])}}" class="btn btn-primary text-white w-space rounded width-100">Watch<i class="fas fa-address-card ps-3"></i></a>
                                                @else
                                                    <a type="button" data-bs-toggle="modal" data-bs-target="#CheckOutModal" class="btn btn-primary text-white w-space rounded width-100">Enroll Now<i class="fas fa-address-card ps-3"></i></a>
                                                @endif
                                            @else
                                                <a type="button" data-bs-toggle="modal" data-bs-target="#signUpModal" class="btn btn-primary text-white w-space rounded width-100">Enroll Now<i class="fas fa-address-card ps-3"></i></a>
                                            @endif
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
                                <div class="mb-4">{!! $course->content !!}</div>
                                <div class="d-sm-flex align-items-center">
                                    <div class="social d-flex align-items-center">
                                        <p class="text-primary mb-0 pe-2">Share this post:</p>
                                        <a target="_blank"
                                            href="https://www.facebook.com/sharer.php?u={{ route('course-detail', $course->slug) }}"><i
                                                class="fab fa-facebook-f pe-3 text-light"></i></a>
                                        <a target="_blank"
                                            href="https://twitter.com/share?url={{ route('course-detail', $course->slug) }}"><i
                                                class="fab fa-twitter pe-3 text-light"></i></a>
                                        <a target="_blank"
                                            href="https://api.whatsapp.com/send?text=*{{$course->title}}*{{route('course-detail', $course->slug)}}"><i
                                                class="fab fa-whatsapp pe-3 text-light"></i></a>
                                        <a target="_blank"
                                            href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('course-detail', $course->slug) }}"><i
                                                class="fab fa-linkedin text-light"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div >
                    <hr>
                    <div class="comments mt-4 mt-md-5">
                        <h5 class="mb-4">Comments</h5>
                        <div id="listing-data">

                        </div>
                        <div id="loading-area" style="display:none;">                            
                            <div class="row" >
                                <div class="col-md-10">
                                    <div id="loadingArea">
                                        @for ($i = 0; $i < 3; $i++)                                            
                                            <div class="col-md-12 content-loader d-flex">
                                                <div class="wrapper animated-background" style="height: 70px;width: 70px;border-radius: 50%;">
                                                    <div class="loading"></div>
                                                </div>
                                                <div class="" style="width: 90%;">
                                                    <div class="row">                                                    
                                                        <div class="col-md-12 wrapper animated-background" style="width: 71%;height: 20px;">
                                                            <div class="loading"></div>
                                                        </div>
                                                        <div class="col-md-12 wrapper animated-background" style="width: 80%;height: 30px;">
                                                            <div class="loading"></div>
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
                    <div>
                        @if (Auth::user())                            
                            <button onclick="showRattingForm($(this))" class="btn btn-primary rounded">
                                Send Review
                            </button>
                        @else
                            <button data-bs-toggle="modal" data-bs-target="#logInModal" class="btn btn-primary rounded">
                                Send Review
                            </button>
                        @endif                        
                    </div>
                    <div id="RattingForm" class="mt-4 mt-md-5" style="display: none;">
                        <h5 class="mb-4">Leave Comment</h5>
                        <form action="{{route('send-review')}}" method="POST" id="reviewform">
                            @csrf
                            <input type="text" name="course_id" id="course_id" value="{{$course->id}}" hidden>
                            <div class="row">   
                                <div>
                                    <span>Your Review</span>
                                </div>
                                <div class="ratting mb-20">
                                    <span><input type="radio" name="ratting" id="str5" value="5"><label for="str5"><i class="fas fa-star"></i></label></span>
                                    <span><input type="radio" name="ratting" id="str4" value="4"><label for="str4"><i class="fas fa-star"></i></label></span>
                                    <span><input type="radio" name="ratting" id="str3" value="3"><label for="str3"><i class="fas fa-star"></i></label></span>
                                    <span><input type="radio" name="ratting" id="str2" value="2"><label for="str2"><i class="fas fa-star"></i></label></span>
                                    <span><input type="radio" name="ratting" id="str1" value="1"><label for="str1"><i class="fas fa-star"></i></label></span>
                                    <input type="text" id="ratting" name="review" hidden>
                                </div><br>
                                <div class="mb-3 col-md-12">
                                    <textarea class="form-control" name="message" rows="4" placeholder="Message"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-primary" type="submit"  id="submitontact">Submit Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!--=================================  Blog -->

<!-- start coursecontent Video Modal -->
<div class="modal fade" id="watchcoursecontentvideo" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header p-4">
                <div>
                    <p class="mb-0">Course Preview</p>
                    <h5 class="modal-title" id="video-title">{{ Str::title($course->title)}}</h5>
                </div>
                <button type="button" id="close-button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="p-3">
                    <iframe class="rounded" id="video-iframe" width="100%" height="350" src=
                        "https://www.youtube.com/embed/{{$course->preview}}"
                        frameborder="0" allowfullscreen>
                        </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End coursecontent Video Modal-->

<!-- Payment Modal Start -->
<div class="modal fade" id="CheckOutModal"  aria-labelledby="CheckOutModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Checkout Now</h4>
                <button id="paymentConatinerOutButton" type="button" class="btn btn-danger"  data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="paymentContainer" class="m-3">
                    <div id="paymentContainer-inner">
                        <h6 class="text-center mb-3">MACS is required by law to collect applicable transaction taxes for purchases made in certain tax jurisdictions.</h6>
                        <span class="mt-3">Ammount. <span class="alert alert-success total-price" role="alert" > ${{$course->sell_price}} </span> </span>                      
                        <p>Thank You.</p>
                    </div>
                    <div>
                        <div id="paypal-button-container"></div>
                    </div>                                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Payment Modal End -->
<form id="courseBuyForm" action="{{route('buy-course')}}" method="POST">
    @csrf
    <input type="text" hidden id="total_price" name="total_price" value="{{isset($course->sell_price) ? $course->sell_price : $course->regular_price}}">
    <input type="text" hidden id="course_id" name="course_id" value="{{$course->id}}">
    <input type="text" hidden id="transaction_id" name="transaction_id">
    <input type="text" hidden id="transaction_status" name="transaction_status">
    <button hidden type="submit"></button>
</form>
@endsection

@section('js')
<script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency={{ env('PAYPAL_CURRENCY') }}"></script>
<script src="{{asset('assets/js/masterX/course-detail.js')}}"></script>
@endsection