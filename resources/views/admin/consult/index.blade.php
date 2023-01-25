@extends('layouts.admin')

@section('title')
Consultancy Requests
@endsection
@section('css') 
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('app-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('app-assets/masterX/js/custom.js') }}"></script>
    <script src="{{ asset('app-assets/masterX/js/consult.js') }}"></script>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row" id="headerRow">
                    <h4 class="card-title">Consultancy Requests</h4>
                </div>
                <div class="table-responsive pt-3" id="ajax_data_table">
                        <table load-url="{{route('load-consult-table',['type'=>$type])}}" id="shivadatatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="ml-5">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Transaction Id</th>
                                    <th>Payment Status</th>
                                    <th>Company Name</th>
                                    <th>Designation</th>
                                    <th>Company Type</th>
                                    <th>Short Description</th>
                                    <th>Description</th>
                                    <th>Business Address</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consults as $consult)
                                <tr id="row{{ $consult->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$consult->name}} </td>
                                    <td>{{$consult->email}} </td>
                                    <td>{{$consult->mobile}} </td>
                                    <td>{{$consult->transaction_id}} </td>
                                    <td>
                                        <span class="p-1 rounded text-white bg-info">{{$consult->payment_status}}</span>                                        
                                    </td>
                                    <td>{{$consult->company_type}} </td>
                                    <td>{{$consult->designation}} </td>
                                    <td>{{$consult->company_type}} </td>
                                    <td>
                                        @foreach ($consult->short_desc as $short_desc)
                                            {{$short_desc}}, 
                                        @endforeach    
                                    </td>
                                    <td>{{$consult->description}} </td>
                                    <td>{{$consult->business_address}} </td>                                    
                                    <td>{{ date("d/m/Y", strtotime($consult->created_at)) }}</td>
                                    
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a class="btn btn-danger btn-sm btn-icon-text"
                                                onclick="event.preventDefault(); callDelete($(this))"
                                                href="{{ route('consult.destroy', $consult->id) }}">
                                                Delete
                                                <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                            </a>
                                        </div>                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection