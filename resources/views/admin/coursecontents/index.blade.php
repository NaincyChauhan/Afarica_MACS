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
    .line-through {
        text-decoration: line-through;
    }
    #backbutton{
        font-size: 23px;
        color: white;
    }
    .coursecontent-back{
        padding: 4px !important;
        height: 34px;
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
<script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('app-assets/masterX/js/custom.js') }}"></script>
<script src="{{ asset('app-assets/masterX/js/coursecontents.js') }}"></script>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row" id="headerRow">
                    <a type="button" href="{{route('course.index',['type'=>$course_type])}}" class="btn btn-danger coursecontent-back">
                        <i id="backbutton" class="typcn typcn-arrow-back btn-icon-append"></i>
                    </a> 
                    <h4 class="card-title">
                        Course Content</h4>                    
                    <a class="btn btn-primary btn-rounded btn-fw float-right text-white" data-toggle="modal"
                        data-target="#addcoursecontent">
                        <i class="mdi mdi-plus-circle-outline"></i> Course Content
                    </a>
                </div>
                <div class="table-responsive pt-3" id="ajax_data_table">
                    <table id="shivadatatable"
                        load-url="{{route('load-coursecontent-table',['course_id'=>$course_id])}}"
                        class="table table-bordered table-striped mb-5">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Duration</th>
                                <th>Video</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($coursecontents as $coursecontent)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $coursecontent->title }}</td>
                                <td>{{ $coursecontent->duration }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm btn-icon-text mr-3 text-white"
                                        onclick="event.preventDefault(); showVideo($(this))"
                                        video-id="https://www.youtube.com/embed/{{$coursecontent->video}}" video-title="{{$coursecontent->title}}">
                                        <i class="typcn typcn-video btn-icon-append"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-success btn-sm btn-icon-text mr-3 text-white"
                                        onclick="event.preventDefault(); callUpdate($(this))"
                                        href="{{ route('coursecontent.edit', $coursecontent->id) }}">
                                        Edit
                                        <i class="typcn typcn-edit btn-icon-append"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm btn-icon-text"
                                        onclick="event.preventDefault(); callDelete($(this))"
                                        href="{{ route('coursecontent.destroy', $coursecontent->id) }}">
                                        Delete
                                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Duration</th>
                                <th>Video</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add coursecontent Modal -->
<div class="modal fade" id="addcoursecontent">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header p-4">
                <h5 class="modal-title">Add Course Content</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form class="p-2" method="POST" action="{{ route('coursecontent.store') }}" id="addcoursecontentForm"
                enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="text" value="{{$course_id}}" name="course_id" hidden>
                    <div class="form-group">
                        <label for="name" class="form-label">Title (Title Must be unique)<font color="red">*</font>
                            :</label>
                        <input type="text" class="form-control" placeholder="Enter Title" name="title"
                            value="{{ old('title') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="video" class="form-label">Video <font color="red">*</font> :</label>
                        <input type="text" id="video" class="form-control" placeholder="Enter Video Id" name="video"
                            value="{{ old('video') }}">
                    </div>

                    <div class="form-group">
                        <label for="duration" class="form-label">Duration <font color="red">*</font> :</label>
                        <input type="text" id="duration" class="form-control" placeholder="Like : 45 Min."
                            name="duration" value="{{ old('duration') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="addcoursecontentBTN" type="button" type="submit"
                        onclick="$('#addcoursecontentForm').submit()" class="btn btn-primary">
                        <i class="mdi mdi-plus-circle-outline"></i> Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add coursecontent Modal-->

<!-- Edit coursecontent Modal -->
<div class="modal fade" id="editcoursecontent" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header  p-4">
                <h5 class="modal-title">Update Course Content</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div id="editData"></div>
        </div>
    </div>
</div>
<!-- End Edit coursecontent Modal-->


<!-- start coursecontent Video Modal -->
<div class="modal fade" id="watchcoursecontentvideo" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header p-4">
                <h5 class="modal-title" id="video-title">Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="p-3">
                    <iframe class="rounded" id="video-iframe" width="100%" height="350" src=
                        "https://www.youtube.com/embed/V5he1JXiQbg"
                        frameborder="0" allowfullscreen>
                        </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End coursecontent Video Modal-->
@endsection