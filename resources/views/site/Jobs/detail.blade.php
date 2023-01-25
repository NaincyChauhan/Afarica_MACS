@extends('layouts.site') @section('meta')
<title>{{ config('app.name') }}</title>

<meta name="title" content="{{ config('app.name') }}" />
<meta name="keywords" content="{{$job->keywords}}" />
<meta name="description" content="{{$job->description}}" />
<meta name="robots" content="all" />

<meta property="og:site_name" content="{{ config('app.name') }}" />
<meta property="og:image" content="{{ asset('storage/jobs/'.$job->image) }}" />
<meta property="og:image:width" content="180" />
<meta property="og:image:height" content="50" />

<meta property="og:type" content=website />
<meta property="og:title" content="{{ config('app.name') }}" />
<meta property="og:description" content="{{$job->description}}" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="{{config('app.url')}}" />
<meta name="twitter:title" content="{{ config('app.name') }}" />
<meta name="twitter:description" content="{{$job->description}}" />
<meta name="twitter:image" content="{{ asset('storage/jobs/'.$job->image) }}" />
@endsection
@section('css')
{{--
<link rel="stylesheet" href="{{asset('assets/css/masterX/jobs.css')}}"> --}}
@endsection
{{-- @section('js') --}}
{{--
 --}}
{{-- @endsection --}}
@section('js')
<script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{asset('assets/js/masterX/job-detail.js')}}"></script>
<script src="{{asset('assets/js/masterX/contact.js')}}"></script>
@endsection
@section('content')
<!--=================================
    Blog -->
<section class="space-ptb">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="blog-detail">
                    <div class="blog-post mb-4 mb-md-5 mb-4">
                        <div class="blog-post-image">
                            <img class="img-fluid" src="{{ asset('storage/jobs/'.$job->image) }}" alt="Job Image">
                           
                            {{-- <img class="img-fluid" src="{{ asset('assets/images/blog/01.jpg') }}" alt="Job Image"> --}}
                        </div>

                        <div class="blog-post-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="blog-post-info">
                                        <div class="blog-post-author">
                                            <a href="#"
                                                class="btn btn-light-round btn-round text-primary">{{$job->job_type}}</a>
                                        </div>
                                        <div class="blog-post-date ">
                                            <a>{{ date("M d, Y", strtotime($job->created_at)) }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#applyNowModal" class="btn btn-primary text-white w-space rounded" style="float: right;">Apply Now<i class="fas fa-address-card ps-3"></i></a>
                                </div>
                            </div>
                            <div>
                                <h4 class="blog-post-title">
                                    {{$job->title}}.
                                </h4>
                            </div>
                            <div>
                                <h6 class="mt-4 text-info">Basic Information</h6>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul class="clients-detail list-inline d-md-flex justify-content-between">
                                        <li>
                                            <strong class="text-dark d-block mb-2">Company</strong>
                                            <span>{{$job->company_name}}</span>
                                        </li>
                                        <li>
                                            <strong class="text-dark d-block mb-2">Position</strong>
                                            <span>{{$job->position}}</span>
                                        </li>
                                        <li>
                                            <strong class="text-dark d-block mb-2">Salary</strong>
                                            {{-- <span>{{$job->salary}}</span> --}}
                                            <span class="badge bg-success p-2">{{$job->salary}}</span>
                                        </li>
                                        <li>
                                            <strong class="text-dark d-block mb-2">Location</strong>
                                            <span>{{$job->location}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-1">                                
                                <div class="col-sm-12">
                                    <ul class="clients-detail list-inline d-md-flex justify-content-between">
                                        <li>
                                            <strong class="text-dark d-block mb-2">Experience</strong>
                                            <span>{{$job->experience}}</span>
                                        </li>
                                        <li>
                                            <strong class="text-dark d-block mb-2">Qualification</strong>
                                            <span>{{$job->qualification}}</span>
                                        </li>
                                        <li>
                                            <strong class="text-dark d-block mb-2">Status</strong>
                                            @if ($job->status == 1)
                                            <span class="badge bg-success p-2">Active</span>
                                            @else
                                            <span class="badge bg-danger p-2">Inactive</span>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <div class="blog-post-details">
                                <h5 class="blog-post-title">
                                    Description.
                                </h5>
                                <div class="mb-4">{!! $job->description !!}</div>
                                <div class="d-sm-flex align-items-center">
                                    <div class="social d-flex align-items-center">
                                        <p class="text-primary mb-0 pe-2">Share this post:</p>
                                        <a target="_blank"
                                            href="https://www.facebook.com/sharer.php?u={{ route('job-detail', $job->slug) }}"><i
                                                class="fab fa-facebook-f pe-3 text-light"></i></a>
                                        <a target="_blank"
                                            href="https://twitter.com/share?url={{ route('job-detail', $job->slug) }}"><i
                                                class="fab fa-twitter pe-3 text-light"></i></a>
                                        <a target="_blank"
                                            href="https://api.whatsapp.com/send?text=*{{$job->title}}*{{route('job-detail', $job->slug)}}"><i
                                                class="fab fa-whatsapp pe-3 text-light"></i></a>
                                        <a target="_blank"
                                            href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('job-detail', $job->slug) }}"><i
                                                class="fab fa-linkedin text-light"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div >
                    <hr>
                    <div class="mt-4 mt-md-5">
                        <h5 class="mb-4">Contact Now</h5>
                        <form action="{{route('send-message')}}" method="POST" id="contactform">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <input type="email" name="email" class="form-control" id="inputEmail4"
                                        placeholder="Email Address">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <input type="text" name="mobile" class="form-control" id="number" placeholder="Phone Number">
                                </div>
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

<!-- Modal -->
<div class="modal fade" id="applyNowModal" tabindex="-1" role="dialog" aria-labelledby="applyNowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="applyNowModalLabel">Apply Now</h5>
          <button type="button" id="close-button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <form class="mt-4 row" method="POST" id="applynowForm" action="{{route('submit-applycation')}}" enctype="multipart/form-data">
                @csrf
                <input type="text" hidden value="{{$job->id}}" name="job_id">
                <div class="mb-3 col-12">
                  <input type="text" class="form-control" name="name" id="exampleInputName" placeholder="Your Name">
                </div>
                <div class="mb-3 col-12">
                  <input type="email" name="email" class="form-control" id="exampleInputEmail" placeholder="Email Address">
                </div>
                <div class="mb-3 col-12">
                  <input type="number" name="mobile" class="form-control" id="exampleInputLnumber" placeholder="Phone Number">
                </div>
                <div class="mb-3 col-6">
                  <input type="number" name="current_sallry" class="form-control" id="exampleInputLcurrent_sallry" placeholder="Current Sallry">
                </div>
                <div class="mb-3 col-6">
                  <input type="number" name="expected_sallry" class="form-control" id="exampleInputLexpected_sallry" placeholder="Expected Sallry">
                </div>
                <div class="mb-3 col-12">
                  <input type="number" name="total_experience" class="form-control" id="exampleInputexperience" placeholder="Total Experience">
                </div>
                <div class="col-lg-12 mb-3">
                  <input type="file" name="resume" class="form-control" id="exampleInputLcompany" placeholder="Resume">
                </div>
                <div class="col-lg-12 mb-3">
                  <input type="text" name="address" class="form-control" id="exampleInputWebsite" placeholder="Address">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" id="applynowBtn" class="btn btn-primary">Submit</button>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection