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
@section('js')
<script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{asset('assets/js/masterX/course-content.js')}}"></script>
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
                                <div class="col-md-8">                                    
                                    @if (count($course->coursecontent) > 0)  
                                        <h6 class="pt-3" id="main-title-heading">{{$course->coursecontent->first()->title}}</h6>
                                        <iframe class=" rounded" id="current-video-iframe" width="100%" height="450px" src=
                                            "https://www.youtube.com/embed/{{$course->coursecontent->first()->video}}?rel=0"
                                            frameborder="0" allowfullscreen>
                                        </iframe>   
                                    @endif
                                </div>
                                <div class="col-md-4 video-content rounded" style="border: 1px solid #d1cdcd;">
                                    <h6 class="pt-3">Course Content</h6>
                                    @if (count($course->coursecontent) > 0)                                        
                                      @foreach ($course->coursecontent as $content_)                                        
                                          <a  onclick='ChangeVideo($(this),"{{$content_->video}}","{{$content_->title}}")'>
                                              <div class="card mt-3 video-card-container rounded-0" 
                                                  @if ($loop->iteration == 1) 
                                                  style="background-color:#f3f2f2;" 
                                                  @endif >
                                                  <div class="row g-0">
                                                      {{-- <div class="col-md-1 vide-box">
                                                          <p>2</p>
                                                          <img src="{{asset('assets/images/video1.png')}}" class="img-fluid rounded-start video-list-icon" alt="...">
                                                      </div> --}}
                                                      <div class="col-md-12">
                                                          <div class="p-2">
                                                              <p class="card-title color-black">{{$content_->title}}</p>
                                                              <p class="mb-0">
                                                                  <span><i class="fas fa-clock text-primary total-duration-icon font-15 p-r-0"></i></span>
                                                                  <span class="total-duration font-14 b-0">Duration : <span class="text-muted">{{$content_->duration}}</span>.</span>
                                                              </p>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </a>
                                      @endforeach                                    
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="blog-post-content">
                            <div>
                                <h5 class="blog-post-title">Description.</h5>
                            </div>
                            <div>
                                <p class="font-15">{{$course->description}}</p>
                            </div>
                            <hr>
                            <div class="blog-post-details">
                                <h5 class="blog-post-title">
                                    Content.
                                </h5>
                                <div class="mb-4">{!! $course->content !!}</div>
                                <div class="d-sm-flex align-items-center">
                                    <div class="social d-flex align-items-center">
                                        <p class="text-primary mb-0 pe-2">Share this Course:</p>
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
                </div>
            </div>
        </div>

    </div>
</section>
<!--=================================  Blog -->


{{-- <div class="container">
    <h2>Dynamic Tabs</h2>
    <p>To make the tabs toggleable, add the data-toggle="tab" attribute to each link. Then add a .tab-pane class with a unique ID for every tab and wrap them inside a div element with class .tab-content.</p>
  
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
      <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
      <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
      <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
    </ul>
  
    <div class="tab-content">
      <div id="home" class="tab-pane fade in active">
        <h3>HOME</h3>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>
  
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
  
        <div class="item active">
          <img src="https://www.w3schools.com/bootstrap/img_chania.jpg" alt="Chania" width="460" height="345">
          <div class="carousel-caption">
            <h3>Chania</h3>
            <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
          </div>
        </div>
  
        <div class="item">
          <img src="https://www.w3schools.com/bootstrap/img_chania2.jpg" alt="Chania" width="460" height="345">
          <div class="carousel-caption">
            <h3>Chania</h3>
            <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
          </div>
        </div>
      
        <div class="item">
          <img src="https://www.w3schools.com/bootstrap/img_flower.jpg" alt="Flower" width="460" height="345">
          <div class="carousel-caption">
            <h3>Flowers</h3>
            <p>Beautiful flowers in Kolymbari, Crete.</p>
          </div>
        </div>
  
        <div class="item">
          <img src="https://www.w3schools.com/bootstrap/img_flower2.jpg" alt="Flower" width="460" height="345">
          <div class="carousel-caption">
            <h3>Flowers</h3>
            <p>Beautiful flowers in Kolymbari, Crete.</p>
          </div>
        </div>
    
      </div>
  
      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
      </div>
      <div id="menu1" class="tab-pane fade">
        <h3>Menu 1</h3>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>
  
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
  
        <div class="item active">
          <img src="https://www.w3schools.com/bootstrap/img_chania.jpg" alt="Chania" width="460" height="345">
          <div class="carousel-caption">
            <h3>Chania</h3>
            <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
          </div>
        </div>
  
        <div class="item">
          <img src="https://www.w3schools.com/bootstrap/img_chania2.jpg" alt="Chania" width="460" height="345">
          <div class="carousel-caption">
            <h3>Chania</h3>
            <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
          </div>
        </div>
      
        <div class="item">
          <img src="https://www.w3schools.com/bootstrap/img_flower.jpg" alt="Flower" width="460" height="345">
          <div class="carousel-caption">
            <h3>Flowers</h3>
            <p>Beautiful flowers in Kolymbari, Crete.</p>
          </div>
        </div>
  
        <div class="item">
          <img src="https://www.w3schools.com/bootstrap/img_flower2.jpg" alt="Flower" width="460" height="345">
          <div class="carousel-caption">
            <h3>Flowers</h3>
            <p>Beautiful flowers in Kolymbari, Crete.</p>
          </div>
        </div>
    
      </div>
  
      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
      </div>
      <div id="menu2" class="tab-pane fade">
        <h3>Menu 2</h3>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
      </div>
      <div id="menu3" class="tab-pane fade">
        <h3>Menu 3</h3>
        <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
      </div>
    </div>
</div> --}}
@endsection