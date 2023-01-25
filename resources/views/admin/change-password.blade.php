@extends('layouts.admin')

@section('title')
  Update Password
@endsection
@section('js')
    <!-- jquery-validation -->
    <script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{asset('assets/js/masterX/users.js')}}"></script>
@endsection


@section('content')
<div>        
    <div>
      <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
          <div class="d-flex align-items-baseline">
            <p class="mb-0"><a href="{{route('dashboard')}}">Dashboard</a></p>
            <i class="typcn typcn-chevron-right"></i>
            <p class="mb-0">Update Password</p>
          </div>
        </div>  
      </div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Update Password</h4>
              <p class="card-description">
                {{-- Basic form layout --}}
              </p>
              <form id="request-form" class="form-horizontal" method="POST" action="{{ route('update-password') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="old_password" class="col-sm-4 col-form-label">Old Password :</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="old_password" placeholder="Old Password" autofocus >
                            @if($errors->has('old_password'))
                                <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                                    <strong>{{ $errors->first('old_password') }}</strong>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new_password" class="col-sm-4 col-form-label">Password :</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="new_password" placeholder="Password" >
                            <div style="width: 100%;">
                                @if($errors->has('new_password'))
                                    <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="confirm_password" class="col-sm-4 col-form-label">Confirm Password :</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" >
                            @if($errors->has('confirm_password'))
                                <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                                    <strong>{{ $errors->first('confirm_password') }}</strong>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-footer" style="height: 72px;">
                    <button type="submit" id="request-btn" class="btn btn-primary float-right" >Update</button>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection



