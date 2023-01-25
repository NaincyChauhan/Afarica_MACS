@extends('layouts.admin')

@section('title')
Courses
@endsection
@section('css') 
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('app-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <style>
        .line-through{
            text-decoration: line-through;
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
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('app-assets/masterX/js/custom.js') }}"></script>
    <script src="{{ asset('app-assets/masterX/js/listings.js') }}"></script>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row" id="headerRow">
                    <h4 class="card-title">Listings</h4>
                    <a href="{{route('listing.create')}}" style="color: white;">
                        <button type="button" style="float: right;" class="btn btn-primary btn-rounded btn-fw">
                            <i class="mdi mdi-plus-circle-outline"></i> Listing 
                        </button>
                    </a>
                </div>
                <div id="ajax_data_table" class="table-responsive pt-3">
                    <table id="shivadatatable" load-url="{{route('load-listing-table')}}" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="ml-5">#</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Address</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listings as $listing)
                            <tr id="row{{ $listing->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$listing->title}} </td>
                                <td>
                                    @foreach ($listing->image as $image)                                            
                                        <img class="rounded" src="{{ asset('storage/listings/'.$image) }}"
                                        alt="Images" style="width: 50px">
                                    @endforeach
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" onchange="changeStatus($(this))" href="{{ route('change-listing-status', $listing->id) }}" {{ $listing->status == 1 ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>  
                                <td>{{$listing->address}} </td>
                                @if(!empty($listing->sell_price))
                                    <td><span class="font-weight-bold">${{$listing->sell_price}} </span>  <span class="font-italic line-through ">${{$listing->regular_price}} </span></td>
                                @else
                                    <td>{{$listing->regular_price}}</td>
                                @endif
                                
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('listing.edit',$listing->id )}}" style="color: white;">
                                            <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                                Edit<i class="typcn typcn-edit btn-icon-append ml-1"></i>
                                            </button>
                                        </a>
                                        <a class="btn btn-danger btn-sm btn-icon-text"
                                            onclick="event.preventDefault(); callDelete($(this))"
                                            href="{{ route('listing.destroy', $listing->id) }}">
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