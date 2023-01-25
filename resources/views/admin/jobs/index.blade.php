@extends('layouts.admin')

@section('title')
Jobs
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
    <script src="{{ asset('app-assets/masterX/js/custom.js') }}"></script>
    <script src="{{ asset('app-assets/masterX/js/jobs.js') }}"></script>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row" id="headerRow">
                    <h4 class="card-title">Jobs</h4>
                    <a href="{{route('job.create',['type'=>$type])}}" style="color: white;">
                        <button type="button" style="float: right;" class="btn btn-primary btn-rounded btn-fw">
                            <i class="mdi mdi-plus-circle-outline"></i> Job
                        </button>
                    </a>
                </div>
                <div class="table-responsive pt-3" id="ajax_data_table">
                        <table id="shivadatatable" load-url="{{route('load-job-table',['type' => $type])}}" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="ml-5">#</th>
                                    <th>Title</th>
                                    <th>Location</th>
                                    <th>Image</th>
                                    <th>Company Name</th>
                                    <th>Position</th>
                                    <th>Job Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobs as $job)
                                <tr id="row{{ $job->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$job->title}} </td>
                                    <td>{{$job->location}} </td>
                                    <td>
                                        @if (isset($job->image))
                                        <img class="rounded" src="{{ asset('storage/jobs/'.$job->image) }}"
                                            alt="{{ $job->title }}" style="width: 50px">
                                        @endif
                                    </td>
                                    <td>{{$job->company_name}} </td>
                                    <td>{{$job->position}} </td>
                                    <td>{{$job->job_type}} </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" onchange="changeStatus($(this))" href="{{ route('change-job-status', $job->id) }}" {{ $job->status == 1 ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td> 
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="{{route('job.edit',$job->id )}}" style="color: white;">
                                                <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                                    Edit<i class="typcn typcn-edit btn-icon-append"></i>
                                                </button>
                                            </a>
                                            <a class="btn btn-danger btn-sm btn-icon-text"
                                                onclick="event.preventDefault(); callDelete($(this))"
                                                href="{{ route('job.destroy', $job->id) }}">
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