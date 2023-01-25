@extends('layouts.admin')

@section('title')
Update Events
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
    .main-panel {
        width: calc(100% - 236px);
        min-height: auto !important;
    }
</style>
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
            <p class="mb-0">Update Events</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update Events</h4>
                <p class="card-description">
                    {{-- Basic form layout --}}
                </p>
                <form class="forms-sample" id="UpdateNewsForm" action="{{route('event.update',$events->id)}}"
                    method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="title">Title<font color="red">*</font></label>
                        <input type="text" name="title" value="{{$events->title}}" required class="form-control"
                            id="title" placeholder="Title">
                        @if($errors->has('title'))
                        <p class="text-danger">{{ $errors->first('title') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="desc">Descipation<font color="red">*</font></label>
                        <input type="text" name="desc" value="{{$events->desc}}" required class="form-control" id="desc"
                            placeholder="Descipation">
                        @if($errors->has('desc'))
                        <p class="text-danger">{{ $errors->first('desc') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Images upload<font color="red">*</font></label>
                        <input type="file" name="image[]" multiple accept="image/*" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled
                                placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                        @if($events->image != '')
                        <div id="image">
                                @foreach ($events->image as $image)                                            
                                    <img class="rounded" src="{{ asset('storage/events/'.$image) }}"
                                        alt="{{ $events->title }}" style="width: 100px">
                                @endforeach
                        </div>
                        @endif
                        @if($errors->has('image'))
                        <p class="text-danger">{{ $errors->first('image') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="content">Content<font color="red">*</font></label>
                        <textarea class="form-control" value="{{$events->content}}" name="content" id="content"
                            rows="5">{{$events->content}}</textarea>
                        @if($errors->has('content'))
                        <p class="text-danger">{{ $errors->first('content') }}</p>
                        @endif
                    </div>
                    <button type="submit" id="updateNewsBTN" class="btn btn-primary mr-2 float-right">
                        <i class="mdi mdi-plus-circle-outline"></i> Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection