@extends('layouts.admin')

@section('title')
Add Events
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('js')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.all.min.js"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="{{ asset('app-assets/masterX/js/custom.js') }}"></script>
    <script src="{{ asset('app-assets/masterX/js/events.js') }}"></script>
@endsection
@section('content')
<div class="row">
    <div class="col-xl-6 grid-margin stretch-card flex-column">
        <div class="d-flex align-items-baseline">
            <p class="mb-0"><a href="{{route('event.index')}}">Events</a></p>
            <i class="typcn typcn-chevron-right"></i>
            <p class="mb-0">Add Events</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Events</h4>
                <form class="forms-sample" enctype="multipart/form-data" id="addNewsForm"
                    action="{{route('event.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Title<font color="red">*</font></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="form-control" id="exampleInputName1"  placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputdescripation1">Descipation<font color="red">*</font></label>
                        <input type="text" name="desc" id="desc" value="{{ old('desc') }}" required class="form-control"
                            id="exampleInputdescripation1"  placeholder="Descipation">
                    </div>
                    <div class="form-group">
                        <label>Images upload<font color="red">*</font></label>
                        <input type="file" name="image[]" accept="image/*" multiple class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info"  disabled
                                placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content">Content<font color="red">*</font></label>
                        <textarea class="form-control" name="content" value="{{ old('content') }}" id="content"
                             rows="5"></textarea>
                    </div>
                    <button type="submit" id="addNewsBTN" class="btn btn-primary mr-2 float-right">Save <i class="mdi mdi-plus-circle-outline"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection