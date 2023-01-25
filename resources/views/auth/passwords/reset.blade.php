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
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
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
                                    <div class="form-group">
                                        <label>Password</label>
                                        <div class="ls-inputicon-box"> 
                                            <input  id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                            <i class="fs-input-icon fa fa-lock "></i>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Password Confirmation</label>
                                        <div class="ls-inputicon-box"> 
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            <i class="fs-input-icon fa fa-lock "></i>
                                        </div>
                                        @error('password_confirmation')
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
