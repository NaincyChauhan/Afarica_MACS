@extends('layouts.admin')

@section('title')
Application
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
    <script src="{{ asset('app-assets/masterX/js/jobapplication.js') }}"></script>
@endsection
@section('content')
{{-- <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Filter</h4>
                <div class="row mt-3" id="FilterRow" filter-url="{{ route('ajax-user-application-data') }}">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Application</label>
                            <select class="form-control filter" id="assignFilter">
                                <option value="" selected>Select Status</option>
                                <option value="0">Pending</option>                                                                
                                <option value="2">Proccess</option>                                                                
                                <option value="1">Success</option>                                                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>From Date</label>
                        <input type="date" id="from_date" class="form-control filter">
                        </div>
                    </div> 
                    <div class="col-md-4 float-right">
                        <div class="form-group">
                        <label>To Date</label>
                        <input type="date" id="to_date" class="form-control filter">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row" id="headerRow">
                    <h4 class="card-title">Application</h4>
                </div>
                <div class="table-responsive pt-3" id="ajax_data_table">
                        <table load-url="{{route('load-jobapplication-table')}}" id="shivadatatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="ml-5">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Applied Job</th>
                                    <th>Address</th>
                                    <th>Current Sallery</th>
                                    <th>Expected Sallery</th>
                                    <th>Experience</th>
                                    <th>Resume</th>
                                    <th>Status</th>
                                    <th>Applied Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobapplications as $jobapplication)
                                <tr id="row{{ $jobapplication->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$jobapplication->name}} </td>
                                    <td>{{$jobapplication->email}} </td>
                                    <td>{{$jobapplication->mobile}} </td>
                                    <td><a href="{{route('job-detail',['slug' => $jobapplication->job->slug])}}" class="text-primary" target="_blank">{{$jobapplication->job->title}}</a> </td>
                                    <td>{{$jobapplication->address}} </td>
                                    <td>{{$jobapplication->current_sallry}} </td>
                                    <td>{{$jobapplication->expected_sallry}} </td>
                                    <td>{{$jobapplication->total_experience}} </td>
                                    <td>
                                        @if (isset($jobapplication->resume))
                                        <a target="_blank" href="{{ asset('storage/documents/'.$jobapplication->resume) }}"
                                            title="Download Resume"> Resume </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($jobapplication->status == 0)
                                            <span onclick="callStatusModal('{{ route('change-jobapplication-status',['id' => $jobapplication->id]) }}')" role="button" class="p-1 rounded text-white bg-danger">Pending</span>
                                        @elseif($jobapplication->status == 1)
                                            <span onclick="callStatusModal('{{ route('change-jobapplication-status',['id' => $jobapplication->id]) }}')" role="button" class="p-1 rounded text-white bg-success">Success</span>
                                        @elseif($jobapplication->status == 2)
                                            <span onclick="callStatusModal('{{ route('change-jobapplication-status',['id' => $jobapplication->id]) }}')" role="button" class="p-1 rounded text-white bg-warning">Processing</span>
                                        @elseif($jobapplication->status == 3)
                                            <span onclick="callStatusModal('{{ route('change-jobapplication-status',['id' => $jobapplication->id]) }}')" role="button" class="p-1 rounded text-white bg-danger">Cancel</span>
                                        @endif
                                    </td>
                                    <td>{{ date("d/m/Y", strtotime($jobapplication->created_at)) }}</td>
                                    
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a class="btn btn-danger btn-sm btn-icon-text"
                                                onclick="event.preventDefault(); callDelete($(this))"
                                                href="{{ route('jobapplication.destroy', $jobapplication->id) }}">
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

{{-- Add change Status Modal --}}
<div class="modal fade" id="statusApplication">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Application Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form method="POST" id="ChangeApplicationStatus" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="staff" class="form-label">Select Status<font color="red">*</font> :</label>
                        <select class="form-control" name="status" required>
                            <option value="" selected>Select Status</option>                                                                
                            <option value="0">Pending</option>                                                                
                            <option value="2">Proccess</option>                                                                
                            <option value="1">Success</option>                                                                
                            <option value="3">Cancel</option>                                                                
                        </select>
                    </div>                   
                </div>
                <div class="modal-footer">
                    <button id="request-btn-status" type="submit" class="btn btn-primary">
                        <i class="mdi mdi-plus-circle-outline"></i> Change
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End change status Modal-->
@endsection