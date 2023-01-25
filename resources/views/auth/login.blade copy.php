@extends('layouts.app')
@section('css')
    <style>
        .twm-explore-content-3{
            padding: 19px 70px;
        }
        .margin-high{
            margin-top: 70px;
        }
    </style>
@endsection
@section('content')
<div class="twm-home4-banner-section margin-high" >
    <div class="row">        
        <!--Left Section-->
        <div class="col-xl-6 col-lg-12 col-md-12">
            <div class="twm-right-section-panel site-bg-gray">
                <form action="{{route('login')}}" method="POST">
                    @csrf
                   <!--Basic Information-->
                    <div class="panel panel-default">
                        <div class="panel-heading wt-panel-heading p-a20">
                            <h4 class="panel-tittle m-a0"><i class="feather-log-in" style="font-weight: bold;"></i>Login</h4>
                        </div>
                        <div class="panel-body wt-panel-body p-a20 m-b30 ">
                            
                            <div class="row">
                                    <!--Job title-->            
                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <div class="ls-inputicon-box"> 
                                                <input class="form-control" name="username" type="text" required="" placeholder="Username">
                                                <i class="fs-input-icon fa fa-envelope"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Job Category--> 
                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                        <a href="{{ route('password.request') }}" style="float:right;">Forget Password?</a>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <div class="ls-inputicon-box"> 
                                                <input class="form-control" name="password" type="password" placeholder="Password">
                                                <i class="fs-input-icon fa fa-lock"></i>
                                            </div>
                                            <div class="col-8 mt-2">
                                                <div class="icheck-primary">
                                                <input type="checkbox" id="remember">
                                                <label for="remember" role="button">
                                                    Remember Me
                                                </label>
                                                </div>
                                            </div>   
                                        </div>    
                                    </div>     
                                    <div class="col-lg-12 col-md-12">                         
                                        <div class="text-left">
                                            <button type="submit" class="site-button m-r5">Login</button>
                                        </div>
                                    </div>                                                            
                            </div>
                                     
                        </div>
                    </div> 
                </form>
            </div>
        </div>

        <!--right Section-->
        <div class="col-xl-6 col-lg-12 col-md-12">
            <div class="twm-bnr-right-section anm" data-wow-delay="1000ms" data-speed-x="2" data-speed-y="2">

                <div class="twm-graphics-h3 twm-bg-line">
                    <img src="{{asset('assets/images/home-4/banner/bg-line.png')}}" alt="">
                </div>

                <div class="twm-graphics-user twm-user">
                    <img src="{{asset('assets/images/home-4/banner/user.png')}}" alt="">
                </div>

                <div class="twm-graphics-h3 twm-bg-plate">
                    <img src="{{asset('assets/images/home-4/banner/bg-plate.png')}}" alt="">
                </div>

                <div class="twm-graphics-h3 twm-checked-plate">
                    <img src="{{asset('assets/images/home-4/banner/checked-plate.png')}}" alt="">
                </div>

                <div class="twm-graphics-h3 twm-blue-block">
                    <img src="{{asset('assets/images/home-4/banner/blue-block.png')}}"')}} alt="">
                </div>

                <div class="twm-graphics-h3 twm-color-dotts">
                    <img src="{{asset('assets/images/home-4/banner/color-dotts.png')}}" alt="">
                </div>

                <div class="twm-graphics-h3 twm-card-large anm" data-speed-y="-2" data-speed-scale="-15" data-speed-opacity="50">
                    <img src="{{asset('assets/images/home-4/banner/card.png')}}" alt="">
                </div>

                <div class="twm-graphics-h3 twm-card-s1 anm" data-speed-y="2" data-speed-scale="15" data-speed-opacity="50">
                    <img src="{{asset('assets/images/home-4/banner/card-s1.png')}}" alt="">
                </div>

                <div class="twm-graphics-h3 twm-card-s2 anm" data-speed-x="-4" data-speed-scale="-25" data-speed-opacity="50">
                    <img src="{{asset('assets/images/home-4/banner/card-s2.png')}}" alt="">
                </div>

                <div class="twm-graphics-h3 twm-white-dotts">
                    <img src="{{asset('assets/images/home-4/banner/white-dotts.png')}}" alt="">
                </div>

                <div class="twm-graphics-h3 twm-top-shadow anm" data-speed-x="-16" data-speed-y="2" data-speed-scale="50" data-speed-rotate="25">
                    <img src="{{asset('assets/images/home-4/banner/top-shadow.png')}}" alt="">
                </div>

                <div class="twm-graphics-h3 twm-bottom-shadow anm" data-speed-x="16" data-speed-y="2" data-speed-scale="20" data-speed-rotate="25">
                    <img src="{{asset('assets/images/home-4/banner/bottom-shadow.png')}}" alt="">
                </div>
                

            </div>
        </div>

    </div>
    
</div>
@endsection