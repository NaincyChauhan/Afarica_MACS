@extends('layouts.site')
@section('meta')
<title>{{ config('app.name') }}</title>

<meta name="title" content="{{ config('app.name') }}" />
<meta name="robots" content="all" />

<meta property="og:site_name" content="{{ config('app.name') }}" />
<meta property="og:image" content="{{ asset('storage/products/fabricator.jpeg') }}" />
<meta property="og:image:width" content="180" />
<meta property="og:image:height" content="50" />

<meta property="og:type" content=website />
<meta property="og:title" content="{{ config('app.name') }}" />

<meta name="twitter:title" content="{{ config('app.name') }}" />
<meta name="twitter:image" content="{{ asset('storage/products/fabricator.jpeg') }}" />
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet"
	href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('app-assets/plugins/fontawesome-free/css/all.min.css')}}">

@endsection
@section('js')
<script>
	function ShowContactForm() {
		// $('#quick-Enquiry-dialog').show();
		document.getElementById('.quick-Enquiry-dialog').style.display = 'block';
		console.log("function is running");
	}
	$('#quick-Enquiry-dialog').magnificPopup({
		type: 'inline',
		midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
	});
</script>
@endsection
@section('css')
<style>
	.mycontainer::-webkit-scrollbar {
		display: none;
	}

	.search_mob.btn_search_mobile {
		margin-top: 10px;
	}

	header {
		z-index: 0;
	}

	/* .strip ul {
			padding: 20px 15px 0px 20px;
			border-top: none;
		} */
	/* .strip ul li:first-child {
			margin-top: 0px;
		} */
	.apply_filters::before {
		content: '' !important;
	}

	.extensionlist {
		padding: 6px !important;
		/* float: left !important; */
		font-size: 14px;
		font-weight: 600;
		cursor: pointer;
	}

	.extensionlist:hover {
		color: #004dda;
	}

	.extension-icon {
		text-align: center;
		padding-right: 12px;
		color: #004dda;
	}

	.subextension-title {
		padding-left: 20px;
		font-size: 12px;
		font-weight: 300;
	}
</style>
@endsection
@section('content')
<!--=================================    banner -->
	<section class="banner">
		<div class="swiper-container">
			<div class="swiper-wrapper h-700 h-sm-500">
				<div class="swiper-slide align-items-center d-flex responsive-overlap-md bg-overlay-black-30"
					style="background-image:url({{ asset('assets/images/slider/01.jpg') }}); background-size: cover; background-position: center center;">
					<div class="swipeinner container">
						<div class="row justify-content-center">
							<div class="col-lg-9 col-md-10 text-center position-relative">
								<h1 data-swiper-animation="fadeInUp" data-duration="1s" data-delay="0.25s">Marx Atanga
									Consultancy/Foundation</h1>
								<h6 data-swiper-animation="fadeInUp" data-duration="1s" data-delay="0.5s">IT CONSULTANCY |
									HEALTH CONSULTANCY | REAL ESTATE | FOUNDATION </h6>
							</div>
						</div>
					</div>
				</div>
				<div class="swiper-slide align-items-center d-flex responsive-overlap-md bg-overlay-black-30"
					style="background-image:url({{ asset('assets/images/slider/02.jpg') }}); background-size: cover; background-position: center center;">
					<div class="swipeinner container">
						<div class="row justify-content-center">
							<div class="col-lg-9 col-md-11 text-center position-relative">
								<h1 data-swiper-animation="fadeInUp" data-duration="1s" data-delay="0.25s">Marx Atanga
									Consultancy/Foundation</h1>
								<h6 data-swiper-animation="fadeInUp" data-duration="1s" data-delay="0.5s">IT CONSULTANCY |
									HEALTH CONSULTANCY | REAL ESTATE | FOUNDATION.</h6>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="swiper-button-prev"><i class="fas fa-arrow-left icon-btn"></i></div>
			<div class="swiper-button-next"><i class="fas fa-arrow-right icon-btn"></i></div>
		</div>
	</section>
<!--=================================  banner -->

<!--=================================  Company Services -->
	<section id="services" class="space-ptb">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-9 col-lg-10">
					<div class="section-title text-center">
						<h3>Marx Atanga Consultancy/Foundation services that help you grow.</h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-lg-3 mb-sm-5 mb-4">
					<a href="{{route('it-consultancy-form')}}">
						<div class="category-box category-box-style-02 text-center">
							<div class="category-icon">
								<i class="flaticon-electrician"></i>
								<h5 class="category-title mb-0">It Consultancy</h5>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-6 col-lg-3 mb-sm-5 mb-4">
					<a href="{{route('health-consultancy-form')}}">
						<div class="category-box category-box-style-02 text-center active">
							<div class="category-icon">
								<i class="flaticon-heart"></i>
								<h5 class="category-title mb-0">Health Consultancy</h5>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-6 col-lg-3 mb-sm-5 mb-4">
					<a href="{{route('real-estate-listing')}}">
						<div class="category-box category-box-style-02 text-center">
							<div class="category-icon">
								<i class="flaticon-support"></i>
								<h5 class="category-title mb-0">Real Estate</h5>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-6 col-lg-3 mb-sm-5 mb-4">
					<a href="{{route('foundation')}}">
						<div class="category-box category-box-style-02 text-center">
							<div class="category-icon">
								<i class="flaticon-rocket"></i>
								<h5 class="category-title mb-0">Foundation</h5>
							</div>
						</div>
					</a>
				</div>
			</div>
			<div class="row">
				{{-- <div class="col-12 d-md-flex justify-content-center align-items-center">
					<p class="mb-3 mb-md-0 mx-0 mx-md-3">Contact us to discuss the goals for your brand</p>
				</div> --}}
			</div>
		</div>
	</section>
<!--================================= Company Services -->

<!--================================= About -->
<section class="space-pb">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title mb-0">
                    <h2 class="mb-2">Highlights.</h2>
                    <h6 class="mb-2">AIMS/OBJECTIVES.</h6>
                </div>
				<div class="row">
					<div class="col-sm-12 mb-4 mb-sm-0">
					  <ul class="list list-unstyled ckeck-list">
						<li class="d-flex"><i class="fas fa-check pe-2 pt-1 text-primary"></i><span>Self empowerment amongst the youths and refugees (provide basic professional training).</span></li>
						<li class="d-flex"><i class="fas fa-check pe-2 pt-1 text-primary"></i><span>Create awareness about good health condition.(to educate each local community about the health crisis prevailing in their environment).</span></li>
						<li class="d-flex"><i class="fas fa-check pe-2 pt-1 text-primary"></i><span>To protect the right of house help, baby seaters, refugees, day watch, primary school teachers and those in the private sectors (by setting up associations with regards to the different groups).</span></li>
						<li class="d-flex"><i class="fas fa-check pe-2 pt-1 text-primary"></i><span>To protect the right of the woman in all ramifications.</span></li>
						<li class="d-flex"><i class="fas fa-check pe-2 pt-1 text-primary"></i><span>To create awareness on the prevalence of the common killer diseases.</span></li>
						<li class="d-flex"><i class="fas fa-check pe-2 pt-1 text-primary"></i><span>Promote social justice and social security.</span></li>
						<li class="d-flex"><i class="fas fa-check pe-2 pt-1 text-primary"></i><span>To give medical support to orphans, widows and widowers and refugees (buying of drugs, paying hospital bill, feeding etc as the means so permit).</span></li>
						<li class="d-flex"><i class="fas fa-check pe-2 pt-1 text-primary"></i><span>To provide disable people with means of movement and improve on their disable state.</span></li>
						<li class="d-flex"><i class="fas fa-check pe-2 pt-1 text-primary"></i><span>Organizing training of trainers workshops for leaders in this field.</span></li>
						<li class="d-flex"><i class="fas fa-check pe-2 pt-1 text-primary"></i><span>To provide orphans who are victims of either wars or other catastrophic. With basic education to university level.</span></li>
						<li class="d-flex"><i class="fas fa-check pe-2 pt-1 text-primary"></i><span>To offer scholarship to the under privilege. ( The poor, and needy) </span></li>
						<li class="d-flex"><i class="fas fa-check pe-2 pt-1 text-primary"></i><span>Stamp out traditional values, which hinder the education of the girl child (especially the Borolo’s), and human sacrifices in some communities </span></li>
						<li class="d-flex"><i class="fas fa-check pe-2 pt-1 text-primary"></i><span>Plant more tree  </span></li>
						<li class="d-flex"><i class="fas fa-check pe-2 pt-1 text-primary"></i><span>Sensitize industries and communities on the importance and ways of protecting the environment. </span></li>
					  </ul>
					</div>
				</div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-sm-6">
                        <img class="img-fluid border-radius mt-1"  src="{{ asset('assets/images/gallery3/h-3.jpeg') }}" alt="">
                        <img class="img-fluid border-radius mt-3"  src="{{ asset('assets/images/gallery3/h-2.jpeg') }}" alt="">
						<p>Preserving the health, safety and independence of older persons MACS is working in line with with this</p>
                    </div>
                    <div class="col-sm-6">
						<img class="img-fluid border-radius h-100 mb-2"  src="{{ asset('assets/images/gallery3/h-1.jpeg') }}" alt="">
                    </div>
                </div>
				<div class="row mt-3">
					<div class="col-sm-7">
						<img class="img-fluid border-radius mt-1"  src="{{ asset('assets/images/gallery3/h-4.jpeg') }}" alt="">
						<p class="img-1-text">Advocating for human rights.</p>
                    </div>
					<div class="col-sm-5">
						<div class="counter counter-03 py-5 mt-3">
							<div class="counter-content">
							  <h3 class="text-white">100%</h3>
							  <label>Perfect Work </label>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</section>
<!--=================================  About -->
@endsection