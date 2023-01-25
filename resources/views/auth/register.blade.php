@extends('layouts.app')
@section('css')
    <style>
        .twm-explore-content-3{
            padding: 19px 70px;
        }
        #profile-image{
            max-width: 107px;
            border-radius: 50%;
        }
        .twm-candidate-profile-pic .upload-btn-wrapper {
            position: absolute;
            left: -22px;
            bottom: -42px;
        }
    </style>
@endsection

@section('js')
<script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script>
    function resendOTP($this)
    {
        var btn = $('#sumitregister'),
        form = $('#registerform');
        btn.attr('disabled', true);
        btn.html('Requesting <i class="mdi mdi-cloud-circle"></i>');
        $.ajax({
            type: "POST",
            processData: false,
            contentType: false,
            url: form.attr('action'),
            data: new FormData(form[0]), // serializes the form's elements.
            success: function (data) {
                if (parseInt(data.status) == 1) {
                    ajaxMessage(1, data.message);                    
                } else {
                    ajaxMessage(0, data.message);
                }
                btn.attr("disabled", false);
                // form[0].reset();
                btn.html('Submit');
            },
            error: function (data) {
                var msg = data.responseJSON.message,
                    error = "<ul>";

                $.each(data.responseJSON.errors, function (key, value) {
                    error += "<li>" + value + "</li>";
                });
                error += "</ul>";
                errorsHTMLMessage(msg + "<br>" + error);
                btn.attr("disabled", false);
                btn.html('Add');
            }
        });
    }
    $(function () {
        $('#registerform').validate({
            rules: {
                name: "required",
                gender: "required",
                email: "required",
                mobile: "required",
                password: "required",
            },
            messages: {
                name: "Oops.! The name field is required.",
                gender: "Oops.! The gender field is required.",
                email: "Oops.! The email field is required.",
                mobile: "Oops.! The mobile field is required.",
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (f) {
                var btn = $('#sumitregister'),
                    form = $('#registerform');
                btn.attr('disabled', true);
                btn.html('Requesting <i class="mdi mdi-cloud-circle"></i>');
                $.ajax({
                    type: "POST",
                    processData: false,
                    contentType: false,
                    url: form.attr('action'),
                    data: new FormData(form[0]), // serializes the form's elements.
                    success: function (data) {
                        if (parseInt(data.status) == 1) {
                            ajaxMessage(1, data.message);
                            if(data.type != 1)
                            {
                                $('#verify-otp').show();
                            }
                            else
                            {
                                form[0].reset();
                                location.reload();
                            }
                        } else {
                            ajaxMessage(0, data.message);
                        }
                        btn.attr("disabled", false);
                        // form[0].reset();
                        btn.html('Submit');
                    },
                    error: function (data) {
                        var msg = data.responseJSON.message,
                            error = "<ul>";

                        $.each(data.responseJSON.errors, function (key, value) {
                            error += "<li>" + value + "</li>";
                        });
                        error += "</ul>";
                        errorsHTMLMessage(msg + "<br>" + error);
                        btn.attr("disabled", false);
                        btn.html('Add');
                    }
                });

                return false;
            }
        });
    });
</script>
@endsection

@section('content')
<div class="section-full p-t120 p-b120 twm-for-employee-area site-bg-white">
    <div class="container">

        <div class="section-content">
            <div class="row">
                <div class="col-lg-5 col-md-12 d-flex align-items-center">
                    <div class="twm-explore-media-wrap ">
                        <div class="twm-media">
                            <img src="{{asset('assets/images/boy-large.png')}}" alt="">
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-12">
                    <div class="twm-explore-content-outer-3">
                        <div class="twm-explore-content-3">
                            <form method="POST" action="{{ route('registeruser') }}" id="registerform"  enctype="multipart/form-data">
                                @csrf
                                <!--Basic Information-->
                                <div class="panel panel-default">
                                    <div class="panel-heading wt-panel-heading p-a20">
                                        <h3 class="panel-tittle m-a0"> <i class="fa fa-users "></i> Register</h3>
                                    </div>
                                    <div class="panel-body wt-panel-body p-a20 m-b30 ">                        
                                        <div class="row">    
                                                <div class="col-xl-6 col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label>Your Name</label>
                                                        <div class="ls-inputicon-box"> 
                                                            <input class="form-control" name="name" type="text" placeholder="Enter Your Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                            <i class="fs-input-icon fa fa-user "></i>
                                                        </div>
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="col-xl-6 col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label>Gender</label>
                                                        <div class="ls-inputicon-box">  
                                                            <select class="wt-select-box selectpicker" name="gender" data-live-search="true" title="" id="gender" data-bv-field="size">
                                                                <option class="bs-title-option" value="">Gender</option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                                <option value="other">Other</option>
                                                            </select>
                                                            <i class="fs-input-icon fa fa-address-card"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label>Email Address</label>
                                                        <div class="ls-inputicon-box"> 
                                                            <input class="form-control" name="email" type="email" placeholder="Enter Your Email" value="{{ old('email') }}" required autocomplete="email">
                                                            <i class="fs-input-icon fa fa-envelope"></i>
                                                        </div>
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label>Mobile</label>
                                                        <div class="ls-inputicon-box"> 
                                                            <input class="form-control" name="mobile" type="number" placeholder="Enter Mobile Number" value="{{ old('mobile') }}" required autocomplete="mobile">
                                                            <i class="fs-input-icon fa fa-phone"></i>
                                                        </div>
                                                        @error('mobile')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                
                                                <div class="col-xl-6 col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <div class="ls-inputicon-box"> 
                                                            <input class="form-control" name="password" type="text" placeholder="Enter Your Password" required autocomplete="new-password">
                                                            <i class="fs-input-icon fas fa-key"></i>
                                                        </div>
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                
                                                <div class="col-xl-6 col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label>Confirm Password</label>
                                                        <div class="ls-inputicon-box"> 
                                                            <input class="form-control"  name="password_confirmation" required autocomplete="new-password" type="password" placeholder="Confirm Password">
                                                            <i class="fs-input-icon fas fa-lock"></i>
                                                        </div>
                                                    </div>                                                    
                                                </div>
                                                
                                                <div class="col-xl-12 col-lg-12 col-md-12" id="verify-otp" style="display: none">
                                                    <div class="form-group">                                          
                                                        <a href="#" style="float:right" onclick="event.preventDefault(); resendOTP($('#sumitregister'), 0)">Resend OTP?</a><br>
                                                        <label>Verification OTP</label>
                                                        <div class="ls-inputicon-box"> 
                                                            <input class="form-control"  name="otp" required autocomplete="OTP" type="text" placeholder="OTP">
                                                            <i class="fs-input-icon fas fa-key"></i>
                                                        </div>
                                                    </div>                                                    
                                                </div> 
                                                <div class="col-xl-12 col-lg-12 col-md-12">
                                                        <div class="d-flex flex-row"> 
                                                            <input  name="terms" required  type="checkbox">
                                                            <p class="mb-0 px-2">I agree to the <a style="text-decoration: revert;" target="_blanck" href="{{route('terms')}}">Terms & Conditions</a> and <a style="text-decoration: revert;" target="_blanck"  href="{{route('privacy')}}">Privacy Policy</a></p>
                                                        </div>
                                                </div>    
                                                <div class="col-lg-12 col-md-12 mt-4">                                   
                                                    <div class="text-center">
                                                        <button type="submit" id="sumitregister" class="site-button">Submit</button>
                                                    </div>
                                                </div> 
                                                
                                                <div class="text-center mt-4">  
                                                    Already have an account?                                                                                
                                                    <a href="{{ route('user-login-request') }}" class="text-primary">Login</a> Now.
                                                </div>
                                        </div>
                                                
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="twm-l-line-1"></div>
                        <div class="twm-l-line-2"></div>

                    </div>
                </div>

            </div>
        </div>
       
    </div>
</div>
@endsection