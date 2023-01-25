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
        <div class="col-8 offset-2">
            <div id="apply-box-shadow" class="p-4 p-sm-5">
                <div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="bg-white">
                                <h4 class="text-center">Update Profile</h4>
                                <div class="text-center" id="user-profile">
                                    <img src="{{$user->image != null ? asset('storage/users/'.$user->image) : asset('assets/images/avatar/01.jpg')}}" class="img-thumbnail rounded-circle user-profile-image" alt="...">
                                </div>                                  
                                <p class="text-muted text-center">Profile Preview</p>
                                <form id="profile-request-form" enctype="multipart/form-data" class="mt-4 row" method="POST" action="{{route('update-profile')}}">
                                    @csrf
                                    <div class="col-md-12 mb-3">
                                        <input  type="file" name="image" value="{{$user->image}}" class="form-control" id="exampleInputName"
                                            placeholder="Upload Profile">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <input required type="text" value="{{$user->name}}" name="name" class="form-control" id="exampleInputName"
                                            placeholder="Full Name">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <input required type="email" value="{{$user->email}}" name="email" class="form-control" id="exampleInputEmail"
                                            placeholder="Email">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <input required type="number" value="{{$user->mobile}}" name="mobile" class="form-control" id="exampleInputMobile"
                                            placeholder="Mobile">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <textarea required name="address" value="{{$user->address}}" id="address" class="form-control"  rows="3">{{$user->address}}</textarea>
                                    </div>
                                    
                                    
                                    <div class="col-12 mb-0">
                                        <button type="submit" id="profile-request-btn" class="btn btn-primary"> Update <i
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