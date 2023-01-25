@extends('layouts.admin')
@section('title')
Add Blog
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('app-assets/plugins/tagsinput/jquery.tagsinput.min.css') }}">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
    div.tagsinput span.tag {
        border: 1px solid #844fc1;
        background: #844fc1;
        color: white;
    }

    div.tagsinput span.tag a {
        color: white;
    }
</style>
@endsection
@section('js')
    <script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('app-assets/plugins/tagsinput/jquery.tagsinput.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.all.min.js"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('app-assets/masterX/js/custom.js') }}"></script>
    <script src="{{ asset('app-assets/masterX/js/blogs.js') }}"></script>
    <script>
        addValidation();
    </script>
@endsection
@section('content')
<div class="row">
    <div class="col-xl-6 grid-margin stretch-card flex-column">
        <div class="d-flex align-items-baseline">
            <p class="mb-0"><a href="{{route('blog.index')}}">Blogs</a></p>
            <i class="typcn typcn-chevron-right"></i>
            <p class="mb-0">Add Blog</p>
        </div>
    </div>
</div>
<form class="forms-sample" action="{{route('blog.store')}}" method="POST" id="addBlogForm"
    enctype="multipart/form-data">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Basic Details</h4>
                    @csrf
                    <div class="form-group">
                        <div>
                            <label>Select Category<font color="red">*</font></label>
                        </div>
                        <select name="category_id" required class="js-example-basic-single w-100" style="width: 100%;" tabindex="1" autofocus>
                            <option value="" selected>Select Category</option>
                            @foreach ($categories as $cate_)
                            <option value="{{$cate_->id}}">{{$cate_->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName1">Title<font color="red">*</font></label>
                        <input type="text" name="title" value="{{ old('title') }}" required class="form-control" placeholder="Title" tabindex="2">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputKeywords1">Keywords<font color="red">*</font></label>
                        <input type="text" name="keywords" value="{{ old('keywords') }}" required class="form-control" placeholder="Keywords" tabindex="3">
                    </div>

                    <div class="form-group">
                        <label for="tags" class="">Tags :</label>
                        <input id="tags" class="form-control" name="tags" value="{{ old('tags') }}" placeholder="Add Tags"  data-role="tagsinput" tabindex="4">
                    </div>
                    <div class="form-group">
                        <label>File upload<font color="red">*</font></label>
                        <input type="file" name="image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button" tabindex="5">Upload</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Content</h4>
                    <div class="form-group">
                        <label for="exampleInputdescripation1">Descipation<font color="red">*</font></label>
                        <input type="text" name="desc" value="{{ old('desc') }}" required class="form-control" placeholder="Descipation" tabindex="6">
                    </div>

                    <div class="form-group">
                        <label for="content">Content<font color="red">*</font></label>
                        <textarea class="form-control" name="content" id="content" rows="5" tabindex="7"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 float-right" id="addBlogBTN" tabindex="9">
                        <i class="mdi mdi-cloud-upload"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection