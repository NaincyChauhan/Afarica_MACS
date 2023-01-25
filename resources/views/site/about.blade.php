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
<!--================================= About IT Consultancy -->
<section class="space-pt" id="it-consultancy-about">
	<div class="container">		
		<div class="row align-items-center">
			<div class="col-lg-6 mb-4 mb-lg-0">
				<h5 class="text-uppercase text-primary">IT consultancy</h5>
				<h5 class="mb-4">MACS  IT consultancy services via our deep and rich  tech background has   over the years helped Large, medium and small scale business solve their IT related problems with relative ease.</h5>
				<p class="mb-4"> 
					MACS is a  reliable solution providing entity for all  your technology needs. Our highly trained  team of technicians  and consultants are fully equipped and have  the expertise cutting acros various fields in  today’s  complex technologies. With this , our services allow your organization or business to enjoy a variety of advantages, ranging from  lower cost,  improved efficiency, and untamed  success in today’s competitive markets.</p>
				<p>IT is worth noting that based on how we work, it has been confirmed by both private and public sector institutions working  with us that, MACS offer one of the most comprehensive, affordably-priced service maintenance and  IT support plans in the IT industry.</p>
			</div>
			<div class="col-lg-6">
				<img class="img-fluid" src="{{asset('assets/images/feature-info/01.jpg')}}" alt="">
			</div>
		</div>
		<div class="row">
			<p>At MACS, our services are geared towards customers' satisfaction. Acknowledging the fact that all businesses are different,  We therefore take a  more customized approach to business IT support and IT consulting.We  Select the system  that best applies to your business and see how our technology management can help your firm grow to enable you enjoy Maximum output.
				Our  support team is available 24 hours  to ensure that your system is always  up and running.</p>
			<p style="padding-top:10px;">IT consulting services equally help our clients  enjoy improved and a well monitored and  tech-driven digital business strategy, geared towards   maximizing your business  operations. Our software engineers  finish your  company's digital transformation  through careful planning and effective execution of the outlined IT strategy based on your field of operations.</p>
		</div>
	</div>
</section>
<!--================================= About IT Consultancy -->

<!--================================= About Real Estate -->
    <section class="space-pt" id="real-estate-about">
		<div class="container">
		  <div class="row align-items-center">
			<div class="col-lg-6 mb-4 mb-lg-0">
			  <img class="img-fluid" src="{{asset('assets/images/feature-info/02.jpg')}}" alt="">
			</div>
			<div class="col-lg-6">
				<h5 class="text-uppercase text-primary">Real-Estate</h5>
				<h5 class="mb-4">We are a  highly reputable and a trust worthy real estate consulting agency. Our  dedication  and zeal to delivering exceptional service is at the core of our tremendous success all these years. </h5>
				<p class="mb-4"> 
					At MACS we offer an arrey of first class real estate consulting services which permit our clients enjoy outstanding benefits from their investment.With our longevity in the real estate industry, MASC is well-known amongst clients for providing superior quality real estate solutions. Our services permit our clients stand out in a very highly competitive modern day real estate industry. We  successfully guide our clients to buy, build, occupy and invest in a variety of assets including industrial, commercial, retail, as well as residential, real estate. All our services are backed and executed by a good team of professionals.</p>
					
				</div>
			</div>
		<div class="row">
			<p>At MACS, our experienced investment team thoroughly  and critically do an in-depth  evaluation of properties to find assets that have vast potential but are currently devalued due to disengaged management. As soon as such properties are  identified, we  carefully act on acquiring and improving them, with an outstanding  management and revaluation plan.</p>
			<p>Via our  plethora of services, we help our clients turn  their critical and complex real estate challenges into opportunities for growth and income generation, by offering them  the much needed  experience, know-how, and the strategic planning that helps lead to better decision making .</p>

		  </div>
		</div>
	  </section>
<!--=================================  About Real Estate -->

<!--================================= About Health Consultancy -->
<section class="space-pt" id="it-consultancy-about" style="margin-bottom: 50px;">
	<div class="container">		
		<div class="row align-items-center">
			<div class="col-lg-6 mb-4 mb-lg-0">
				<h5 class="text-uppercase text-primary">Health consultancy</h5>
				<h5 class="mb-4">MACS helps healthcare business operators around the globe  respond positively to challenges when everything is on the line,  we help healthcare operators upgrade from urgent performance improvement to complex restructuring,  to accelerated transformation to suit the needs of their clients.</h5>
				<p class="mb-4"> 
					Many healthcare service providers are facing countless challenges ignited 
					by the persistent  need for  a decisive, informed,  well structured system  and more importantly, the need for more results driven  action in a more demanding modern day  global biotech, pharmaceutical and medical industries.
					To overcome such challenges, MACS is the ideal solution prover. MACS  is a reputable consulting firm in the healthcare sector. We bring data based , advanced analytics, technologies, and an arrey of  domain expertise to clients in the  healthcare sectors. </p>
				<p>IT is worth noting that based on how we work, it has been confirmed by both private and public sector institutions working  with us that, MACS offer one of the most comprehensive, affordably-priced service maintenance and  IT support plans in the IT industry.</p>
			</div>
			<div class="col-lg-6">
				<img class="img-fluid" src="{{asset('assets/images/gallery2/4.jpeg')}}" alt="">
			</div>
		</div>
		<div class="row">
			<p style="padding-top:10px;">MACS', diverse,  and competent global teams bring deep industry and functional expertise to  health care organizations, helping them to grow faster by  building a more  sustainable competitive advantage, by being more Purpose-driven in their operations.</p>
		</div>
	</div>
</section>
<!--================================= About Health Consultancy -->

@endsection