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
                      <span class="timer" data-to="491" data-speed="1000">491</span>
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
              <h2 class="mb-4">MACS helps healthcare business operators around the globe  respond positively to challenges when everything is on the line</h2>
              <p class="mb-4">MACS'  global professional services  in the healthcare, cutting across both  public and private is the ideal consulting firm to provide you with up to date services  in a more  dynamic  modern day market environment. we therefore help  healthcare organizations by providing them wth the required data and technology to  permit them optimize their  existing business operations, improve clinical outcomes, and create a more result-centric healthcare experience.</p>
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
				<h5 class="mb-4">We help healthcare operators upgrade from urgent performance improvement to complex restructuring,  to accelerated transformation to suit the needs of their clients.</h5>
				<p class="mb-4"> 
					Many healthcare service providers are facing countless challenges ignited 
					by the persistent  need for  a decisive, informed,  well structured system  and more importantly, the need for more results driven  action in a more demanding modern day  global biotech, pharmaceutical and medical industries.
					To overcome such challenges, MACS is the ideal solution prover. MACS  is a reputable consulting firm in the healthcare sector. We bring data based , advanced analytics, technologies, and an arrey of  domain expertise to clients in the  healthcare sectors. </p>
          <p>MACS', diverse,  and competent global teams bring deep industry and functional expertise to  health care organizations, helping them to grow faster by  building a more  sustainable competitive advantage, by being more Purpose-driven in their operations.</p>
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
                @for ($i = 1; $i < 9; $i++)                    
                    <div class="col-md-6 col-lg-3 mb-4 mb-lg-3">
                        <a class="portfolio-img" href="{{asset('assets/images/gallery2/'.$i.'.jpeg')}}"><img  class="img-fluid" src="{{asset('assets/images/gallery2/'.$i.'.jpeg')}}" alt=""></a>
                    </div>
                @endfor
            </div>
            {{-- <div class="row">
                <div class="col-md-6 col-lg-3 mt-0 mt-lg-3">
                <a class="portfolio-img" href="images/gallery/05.jpg"><img class="img-fluid" src="images/gallery/05.jpg" alt=""></a>
                </div>
                <div class="col-md-6 col-lg-3 mt-4 mt-lg-3">
                <a class="portfolio-img" href="images/gallery/06.jpg"><img class="img-fluid w-100" src="images/gallery/06.jpg" alt=""></a>
                </div>
                <div class="col-md-6 col-lg-3 mt-4 mt-lg-3">
                <a class="portfolio-img" href="images/gallery/07.jpg"><img class="img-fluid" src="images/gallery/07.jpg" alt=""></a>
                </div>
                <div class="col-md-6 col-lg-3 mt-4 mt-lg-3">
                <a class="portfolio-img" href="images/gallery/08.jpg"><img class="img-fluid" src="images/gallery/08.jpg" alt=""></a>
                </div>
            </div> --}}
        </div>
      </section>
<!--=================================  portfolio -->


@endsection