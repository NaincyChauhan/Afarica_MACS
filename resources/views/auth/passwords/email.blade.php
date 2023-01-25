{{-- @extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

<html lang="en" class="" style="height: auto;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-png" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}"><!-- BOOTSTRAP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}"><!-- FONTAWESOME STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/feather.css') }}"><!-- FEATHER ICON SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}"><!-- MAIN STYLE SHEET -->  
    <style>
        .page-wraper{
            width: 100vw;
            height: 100vh;
            display: grid;
            place-items: center;
        }
    </style>
</head>

<body>
	<div class="page-wraper">
        <div class="twm-right-section-panel site-bg-gray">
            <form method="POST" action="{{ route('forget-password') }}">
                @csrf
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h3 class="panel-tittle m-a0"> <i class="fa fa-key"></i> Password Reset </h3>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">                        
                        <div class="row">                                            
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Your Email</label>
                                        <div class="ls-inputicon-box"> 
                                            <input class="form-control" id="email" type="email"  placeholder="Enter Your Email"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            <i class="fs-input-icon fa fa-envelope "></i>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>                                               
                                <div class="col-lg-12 col-md-12">                                   
                                    <div class="text-left">
                                        <button type="submit" id="sumitregister" class="site-button">Submit</button>
                                    </div>
                                </div> 
                        </div>
                                
                    </div>
                </div>
            </form>
        </div>
 	</div>

    <!-- Javascript -->
    <script  src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script><!-- JQUERY.MIN JS -->
    <script  src="{{ asset('assets/js/popper.min.js') }}"></script><!-- POPPER.MIN JS -->
    <script  src="{{ asset('assets/js/bootstrap.min.js') }}"></script><!-- BOOTSTRAP.MIN JS -->
    <script  src="{{ asset('assets/js/jquery.scrollbar.js') }}"></script><!-- scroller -->
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.all.min.js"></script>
    {{-- Error Script --}}
    <script>
        $(function () {
            @if (!empty(Session:: get('success')))
                Swal.fire({
                    icon: 'success',
                    title: 'Success! 😊',
                    text: "{{Session::get('success')}}",
                });
            @endif
            @if (!empty(Session:: get('status')))
                Swal.fire({
                    icon: 'success',
                    title: 'Success! 😊',
                    text: "{{Session::get('status')}}",
                });
            @endif

            @if (!empty(Session:: get('error')))
                Swal.fire({
                    icon: 'error',
                    title: 'Error! 😯',
                    text: "{{Session::get('error')}}",
                });
            @endif

            @if ($errors -> any())
                Swal.fire({
                    icon: 'error',
                    title: 'Error! 😯',
                    text: "@foreach($errors->all() as $error) * {{ $error }} \n @endforeach",
                });
            @endif
        });
    </script>
</body>

</html>
