@extends('layouts.site')
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

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="idigitalgroups.com" />
<meta name="twitter:title" content="{{ config('app.name') }}" />
<meta name="twitter:description" content="" />
<meta name="twitter:image" content="{{ asset('storage/products/fabricator.jpeg') }}" />


@endsection
@section('content')
<!--=================================    About -->
    <section class="space-ptb">
        <div class="container">
          <div class="row d-flex align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
              <div class="row g-0 d-flex align-items-end mb-4 mb-sm-2">
                <div class="col-sm-8 pe-sm-2 mb-4 mb-sm-0">
                  <img class="img-fluid border-radius" src="{{asset('assets/images/about/08.jpg')}}" alt="">
                </div>
                <div class="col-sm-4">
                  <div class="counter counter-03 py-5">
                    <div class="counter-content">
                      <span class="timer" data-to="531" data-speed="1000">229</span>
                      <label>Happy Clients </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row d-flex justify-content-center">
                <div class="col-sm-6">
                  <img class="img-fluid border-radius" src="{{asset('assets/images/about/09.jpg')}}" alt="">
                </div>
              </div>
            </div>
            <div class="col-lg-6 ps-xl-5">
              <h3 class="mb-4">MACS IT Consultancy we offer advisory services that help clients access different technology strategies and, in doing so, align their technological strategies with their business or process oriented strategies</h3>
              <p class="mb-4">These services provided support to customers’ IT initiatives by providing strategic, architectural, operational and implementation planning.
                Strategic planning includes advisory services that help our clients assess their IT needs and formulate system implementation plans. </p>
              <p>Architecture planning includes advisory services that combine strategic plans and knowledge of emerging technologies to create the logical design of the system and the supporting infrastructure to meet our customer's requirements. </p>
              <p>Operational assessment/benchmarking includes services that assess the operating efficiency and capacity of our client’s IT environment. 
                Implementation planning includes services aimed at advising our customers on the roll-out and testing of new solution deployments.</p>
            </div>
          </div>
        </div>
      </section>
<!--=================================  About -->

<!--================================= About Health Consultancy -->
<section class="space-pb" id="it-consultancy-about">
	<div class="container">		
		<div class="row align-items-center">
			<div class="col-lg-6 mb-4 mb-lg-0">
				<h5 class="mb-4">What we offer is very different from IT Services. The main differences are that IT services implement solutions and provide expertise to help businesses create and improve business processes, whereas we at MACS focus on providing strategic IT advice on how to modify or improve solutions to reach the desired goal.</h5>
				<p class="mb-4"> 
					Some of the benefits you’ll derive at MACS are that you’ll save time and money, provide unique expertise, ensure you’re provided with quality work and we also ensure you’ll avoid future complications.</p>
          <p>MACS also provide all forms of IT in addition to the above mention,with the alarming rate of digitalization around the globe 🌎,it is but necessary we provide our subscribers with the best and first class information on all IT related field.Our technical and support team is working relentlessly in seeing that they can provide the thousands costumers placed under their care with an up to date information.</p>
			</div>
			<div class="col-lg-6">
				<img class="img-fluid" src="{{asset('assets/images/gallery2/4.jpeg')}}" alt="">
			</div>
		</div>
	</div>
</section>
<!--================================= About Health Consultancy -->

<!--=================================   portfolio -->
    <section class="space-pb popup-gallery overflow-hidden">
        <div class="container-fluid">
            <div class="row d-flex align-items-end">
                @for ($i = 1; $i < 23; $i++)                    
                    <div class="col-md-6 col-lg-3 mb-4 mb-lg-3">
                        <a class="portfolio-img" href="{{asset('assets/images/gallery3/'.$i.'.jpeg')}}"><img  class="img-fluid" src="{{asset('assets/images/gallery3/'.$i.'.jpeg')}}" alt=""></a>
                    </div>
                @endfor
            </div>
        </div>
      </section>
<!--=================================  portfolio -->


@endsection