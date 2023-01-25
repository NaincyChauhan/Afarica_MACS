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
<!--=================================  envelope -->
<section class="space-pb" style="padding-top: 100px;">
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <div id="apply-box-shadow" class="p-4 p-sm-5">
                <div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="bg-white">
                                <h3>Change Password</h3>
                                <form id="request-form" class="mt-4 row" method="POST" action="{{route('update-password')}}">
                                    @csrf
                                    <div class="col-md-12 mb-3">
                                        <input type="password" name="old_password" class="form-control" id="exampleInputPassword1"
                                            placeholder="Old Password">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <input type="password" name="new_password" class="form-control" id="exampleInputPassword2"
                                            placeholder="New Password">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword3"
                                            placeholder="Confirm Password">
                                    </div>
                                    
                                    
                                    <div class="col-12 mb-0">
                                        <button type="submit" id="request-btn" class="btn btn-primary"> Change Password <i
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
</div>
</section>
<!--=================================  envelope -->
@endsection

@section('js')
<script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/masterX/users.js') }}"></script>
@endsection