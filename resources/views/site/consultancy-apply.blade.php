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
<meta property="og:url" content="https://www.idigitalgroups.com" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="idigitalgroups.com" />
<meta name="twitter:title" content="{{ config('app.name') }}" />
<meta name="twitter:description" content="" />
<meta name="twitter:image" content="{{ asset('storage/products/fabricator.jpeg') }}" />


@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/masterX/apply-now.css') }}"/>
@endsection
@section('content')
@php
    $setting = App\Models\Setting::select('it_consultancy_money','health_consultancy_money')->first();
@endphp

<!--=================================
    Action Box -->
<section class="space-ptb">
    <div class="container">
        <div class="text-center rounded px-3">
            <h2>Apply Now For {{(isset($type) && $type == 1) ? 'Health' : "It" }} Consultancy</h2>
            <h6>Have a brand problem that needs to be solved? We’d love to hear about it!</h6>
            @if (isset($type) && $type == 1)                
            <a target="_blank" href="{{route('health-consultancy-about')}}" class="btn btn-primary-round btn-round mx-0 mx-md-3">Know More About<i
                    class="fas fa-arrow-right ps-3"></i></a>
            @else
            <a target="_blank" href="{{route('it-consultancy-about')}}" class="btn btn-primary-round btn-round mx-0 mx-md-3">Know More About<i
                    class="fas fa-arrow-right ps-3"></i></a>
            @endif
        </div>
    </div>
</section>
<!--=================================
      Action Box -->

<!--=================================
      envelope -->
<section class="space-pb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="apply-box-shadow" class="p-4 p-sm-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="bg-white">
                                <h3>Need apply? please fill the form</h3>
                                <form id="apply-now-form" class="mt-4 row" method="POST" action="{{route('apply-form')}}">
                                    @csrf
                                    @if (isset($type))                                        
                                        <input type="text" hidden name="type" value="{{$type}}">
                                    @endif
                                    <input type="text" id="transaction_id" hidden name="transaction_id">
                                    <input type="text" id="transaction_status" hidden name="transaction_status">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="name" class="form-control" id="exampleInputName"
                                            placeholder="Name">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="number" name="mobile" class="form-control" id="exampleInputLname"
                                            placeholder="Mobile">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" name="email" class="form-control" id="exampleInputEmail"
                                            placeholder="Email Address">
                                    </div>
                                    <div class="col-4 mb-3">
                                        <input type="text" id="company_name" name="company_name" class="form-control" 
                                            placeholder="Company Name">
                                    </div>
                                    <div class="col-4 mb-3">
                                        <input type="text" id="designation" name="company_designation" class="form-control" 
                                            placeholder="Designation">
                                    </div>
                                    <div class="col-4 mb-3">
                                        <input type="text" id="company_type" name="company_type" class="form-control" 
                                            placeholder="Company Type">
                                    </div>
                                    <input type="text" hidden  id="form_amount" value="{{$type=='0'?$setting->it_consultancy_money:$setting->health_consultancy_money}}">
                                    <div class="col-12 mb-4">
                                        <h6 for="">Short Desc</h6>
                                        @if (isset($type) && $type==0)                                            
                                            <div class="row px-2">
                                                <div class="col-md-4">
                                                    <div class="form-check ml-2">
                                                        <input class="form-check-input" type="checkbox" name="short_desc[]" value="IT Short Courses"
                                                            id="ITflexCheckDefault1">
                                                        <label class="form-check-label" for="ITflexCheckDefault1">
                                                            IT Short Courses
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check ml-2">
                                                        <input class="form-check-input" type="checkbox" name="short_desc[]" value="IT Staffing"
                                                            id="ITflexCheckDefault2">
                                                        <label class="form-check-label" for="ITflexCheckDefault2">
                                                            IT Staffing
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check ml-2">
                                                        <input class="form-check-input" type="checkbox" name="short_desc[]" value="IT Consulting"
                                                            id="ITflexCheckDefault3">
                                                        <label class="form-check-label" for="ITflexCheckDefault3">
                                                            IT Consulting
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="row px-2">
                                                <div class="col-md-4">
                                                    <div class="form-check ml-2">
                                                        <input class="form-check-input" type="checkbox" name="short_desc[]" value="Health Short Courses"
                                                            id="HealthflexCheckDefault1">
                                                        <label class="form-check-label" for="HealthflexCheckDefault1">
                                                            Health Short Courses
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check ml-2">
                                                        <input class="form-check-input" type="checkbox" name="short_desc[]" value="Health Staffing"
                                                            id="HealthflexCheckDefault2">
                                                        <label class="form-check-label" for="HealthflexCheckDefault2">
                                                            Health Staffing
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check ml-2">
                                                        <input class="form-check-input" type="checkbox" name="short_desc[]" value="Health Consulting"
                                                            id="HealthflexCheckDefault3">
                                                        <label class="form-check-label" for="HealthflexCheckDefault3">
                                                            Health Consulting
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" id="business_address" name="business_address" class="form-control" 
                                            placeholder="Business Address">
                                    </div>
                                    <div class="col-12 mb-4">
                                        <textarea name="description" class="form-control" id="exampleInputEnquiry-Description"
                                            placeholder="Description" rows="5"></textarea>
                                    </div>
                                    <div class="col-12 mb-0">
                                        <button type="submit" id="apply-now-btn" class="btn btn-primary"> Submit <i
                                                class="fas fa-arrow-right ps-3"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================
      envelope -->

<!-- Payment Modal -->
<div class="modal fade" id="applyNowModal"  aria-labelledby="applyNowModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Apply Now</h4>
                <button id="paymentConatinerOutButton" type="button" class="btn btn-danger"  data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="paymentContainer">
                    <h6 class="text-center">For Complete this process you have to pay some Ammount 
                        <span class="alert alert-success" role="alert" > ${{$type=='0'?$setting->it_consultancy_money:$setting->health_consultancy_money}} </span>.
                        Thank You.</h6>

                    <div id="paypal-button-container"></div>                                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency={{ env('PAYPAL_CURRENCY') }}"></script>
<script src="{{ asset('assets/js/masterX/apply-now.js') }}"></script>
@endsection