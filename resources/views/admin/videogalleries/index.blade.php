@extends('layouts.admin')
@section('title')
Video Gallery
@endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('app-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('app-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('app-assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('js')
<!-- DataTables  & Plugins -->
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
<!-- jquery-validation -->
<script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('app-assets/masterX/js/custom.js') }}"></script>
<script src="{{ asset('app-assets/masterX/js/videogalleries.js') }}"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row" id="headerRow">
                    <h4 class="card-title">Video Gallery</h4>
                    <a class="btn btn-primary btn-rounded btn-fw float-right text-white" data-toggle="modal"
                        data-target="#addImagegallery">
                        <i class="mdi mdi-plus-circle-multiple-outline"></i> Add
                    </a>
                </div>
                <div id="ajax_data_table" class="table-responsive pt-3">
                    <table id="shivadatatable" class="table table-bordered table-striped mb-5">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Thumbnail</th>
                                <th>Video</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($videogalleries as $video)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $video->title }}</td>
                                <td>
                                    <img class="rounded" src="{{ asset('storage/videogalleries/'.$video->thumbnail) }}"
                                        alt="{{ $video->title }}" style="width:100px;height:auto;">
                                </td>
                                <td>
                                    <a target="_blank" href="https://www.youtube.com/embed/{{$video->video}}"
                                        title="{{ $video->title }}">Watch</a>
                                </td>
                                <td>{{ substr($video->desc, 0, 100) }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a class="btn btn-success btn-sm btn-icon-text mr-3 text-white"
                                            onclick="event.preventDefault(); callUpdate($(this))"
                                            href="{{ route('videogallery.edit', $video->id) }}">
                                            Edit
                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm btn-icon-text"
                                            onclick="event.preventDefault(); callDelete($(this))"
                                            href="{{ route('videogallery.destroy', $video->id) }}">
                                            Delete
                                            <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Thumbnail</th>
                                <th>Video</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add Imagegallery Modal --}}
<div class="modal fade" id="addImagegallery">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Video Gallery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form method="POST" action="{{ route('videogallery.store') }}" id="request-form"
                enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="inputText" class="form-label">Title :</label>
                        <input type="text" class="form-control" name="title" value="{{ old('natitleme') }}">
                        @if($errors->has('title'))
                        <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="inputText" class="form-label">Video Id<font color="red">*</font> :</label>
                        <input type="text" class="form-control" name="video" required>
                    </div>

                    <div class="form-group">
                        <label>Thumbnail upload<font color="red">*</font></label>
                        <input type="file" name="thumbnail" required class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled
                                placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputText" class="form-label">Description :</label>
                        <textarea class="form-control" name="desc" value="">{{ old('desc') }}</textarea>
                        @if($errors->has('desc'))
                        <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                            <strong>{{ $errors->first('desc') }}</strong>
                        </p>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="request-btn" type="button" type="submit" onclick="$('#request-form').submit()"
                        class="btn btn-primary">
                        <i class="mdi mdi-plus-circle-multiple-outline"></i> Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Imagegallery Modal-->

{{-- Edit Imagegallery Modal --}}
<div class="modal fade" id="editImagegallery">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div id="editData"></div>
        </div>
    </div>
</div>
<!-- End Edit Imagegallery Modal-->
@endsection