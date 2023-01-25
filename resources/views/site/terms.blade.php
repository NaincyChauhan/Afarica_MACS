@extends('layouts.site')
@section('meta')
    <title>{{ config('app.name') }}</title>

    <meta name="title" content="{{ config('app.name') }}" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="robots" content="all"/>

	<meta property="og:site_name" content="{{ config('app.name') }}"/>
	<meta property="og:image" content="{{ asset('storage/products/fabricator.jpeg') }}"/>
	<meta property="og:image:width" content="180"/>
	<meta property="og:image:height" content="50"/>

	<meta property="og:type" content=website/>
	<meta property="og:title" content="{{ config('app.name') }}"/>
	<meta property="og:description" content=""/>
	<meta property="og:url" content="https://www.idigitalgroups.com"/>

	<meta name="twitter:card" content="summary_large_image"/>
	<meta name="twitter:site" content="idigitalgroups.com" />
	<meta name="twitter:title" content="{{ config('app.name') }}"/>
	<meta name="twitter:description" content=""/>
	<meta name="twitter:image" content="{{ asset('storage/products/fabricator.jpeg') }}"/>
    
    
@endsection
@section('content')
    <!--=================================
      Title -->

      <section class="space-ptb">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div class="section-title text-center mb-0">
                <h1>Terms and Conditions</h1>
                <p>Let success motivate you. Find a picture of what epitomizes success to you and then pull it out when you are in need of motivation.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

    <!--=================================
      Title -->

    <!--=================================
    Terms and conditions -->
    <section class="space-pb">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <p class="mb-20">For those of you who are serious about having more, doing more, giving more and being more, success is achievable with some understanding of what to do, some discipline around planning and execution of those plans and belief that you can achieve your desires.</p>
            <h4 class="mt-4 text-primary">Your Registration Obligations</h4>
            <p class="mb-20">The best way is to develop and follow a plan. Start with your goals in mind and then work backwards to develop the plan. What steps are required to get you to the goals? Make the plan as detailed as possible. Try to visualize and then plan for, every possible setback. Commit the plan to paper and then keep it with you at all times. Review it regularly and ensure that every step takes you closer to your Vision and Goals. If the plan doesn’t support the vision then change it!</p>
            <h4 class="mt-4 text-primary">User Account, Password, and Security</h4>
            <p class="mb-20">One of the main areas that I work on with my clients is shedding these non-supportive beliefs and replacing them with beliefs that will help them to accomplish their desires.</p>
            <h4 class="mt-4 text-primary">User Conduct</h4>
            <p class="mb-20">I truly believe Augustine’s words are true and if you look at history you know it is true. There are many people in the world with amazing talents who realize only a small percentage of their potential. We all know people who live this truth. </p>
            <ul class="ps-3 mb-20 d-block">
              <li>Making a decision to do something</li>
              <li>Focus is having the unwavering attention to complete what you set out to do.</li>
              <li>Nothing changes until something moves</li>
              <li>Commit your decision to paper</li>
              <li>Execution is the single biggest factor in achievement</li>
            </ul>
            <div class="mt-4">
              <h4 class="text-primary">International Use</h4>
              <p class="mb-0">The best way is to develop and follow a plan. Start with your goals in mind and then work backwards to develop the plan. What steps are required to get you to the goals? Make the plan as detailed as possible. Try to visualize and then plan for, every possible setback. Commit the plan to paper and then keep it with you at all times. Review it regularly and ensure that every step takes you closer to your Vision and Goals. If the plan doesn’t support the vision then change it</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=================================
    Terms-and-conditions -->
@endsection