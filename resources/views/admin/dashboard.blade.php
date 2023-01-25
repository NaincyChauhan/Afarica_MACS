@extends('layouts.admin')
@section('title')
    Dashboard
@endsection

@section('css') 
<!-- DataTables -->
    <link rel="stylesheet" href="{{asset('app-assets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('app-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <style>
        #shivadatatable td{
            white-space:initial;
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('app-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('app-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('app-assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('app-assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('app-assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('app-assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('app-assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('app-assets/masterX/js/custom.js') }}"></script>
    <script src="{{ asset('app-assets/masterX/js/messages.js') }}"></script>
@endsection


@section('content')
@if(Auth::user()->hasRole('superadmin'))
  <div class="row">
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
            <div>
              <p class="mb-2 text-md-center text-lg-left">Total User</p>
              <h1 class="mb-0">{{ $users }}</h1>
            </div>
            <i class="mdi mdi-account-multiple icon-xl text-secondary"></i>
          </div>
          <canvas id="expense-chart" height="80"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
            <div>
              <p class="mb-2 text-md-center text-lg-left">Total Job Applications</p>
              <h1 class="mb-0">{{ $applications }}</h1>
            </div>
            <i class="mdi mdi-file-check icon-xl text-secondary"></i>
          </div>
          <canvas id="budget-chart" height="80"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
            <div>
              <p class="mb-2 text-md-center text-lg-left">Total Donations</p>
              <h1 class="mb-0">{{ $donations }}</h1>
            </div>
            <i class="typcn typcn-clipboard icon-xl text-secondary"></i>
          </div>
          <canvas id="balance-chart" height="80"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>Latest Enquiries</h4>
        </div>
        <div class="p-2"> 
            <div class="table-responsive pt-3">
              <table id="shivadatatable" class="table table-bordered">
                <thead>
                  <tr>
                    <th class="ml-5">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>mobile</th>
                    <th>subject</th>
                    <th>message</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($messages as $message)
                    <tr id="row{{$message->id}}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$message->name}} </td>
                        <td>{{$message->email}} </td>
                        <td>{{$message->mobile}} </td>
                        <td>{{$message->subject}} </td>
                        <td>{{$message->message}} </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>
@else
@endif
@endsection

