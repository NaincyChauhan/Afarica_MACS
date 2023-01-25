@extends('layouts.admin')

@section('title')
Update Blog
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
        updateValidation();
    </script>
@endsection
@section('content')

<div class="row">
    <div class="col-xl-6 grid-margin stretch-card flex-column">
        <div class="d-flex align-items-baseline">
            <p class="mb-0"><a href="{{route('blog.index')}}">Blogs</a></p>
            <i class="typcn typcn-chevron-right"></i>
            <p class="mb-0">Update Blog</p>
        </div>
    </div>
</div>
<form class="forms-sample" enctype="multipart/form-data" id="updateBlogForm" action="{{route('blog.update',$blog->id)}}"
    method="POST">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Basic Details</h4>
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <div>
                            <label>Select Category<font color="red">*</font></label>
                        </div>
                        <select name="blogcategory_id" required class="js-example-basic-single w-100"
                            style="width: 100%;">
                            @foreach ($categories as $cate_)
                            @if ($blog->blogcategory_id == $cate_->id)
                            <option selected value="{{$cate_->id}}">{{$cate_->title}}</option>
                            @else
                            <option value="{{$cate_->id}}">{{$cate_->title}}</option>
                            @endif
                            @endforeach
                        </select>
                        @if($errors->has('blogcategory_id'))
                        <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                            <strong>{{ $errors->first('blogcategory_id') }}</strong>
                        </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Title<font color="red">*</font></label>
                        <input type="text" name="title" value="{{$blog->title}}" required class="form-control"
                            id="exampleInputName1"  placeholder="Title">
                        @if($errors->has('title'))
                        <p class="text-danger">{{ $errors->first('title') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputKeywords1">Keywords<font color="red">*</font></label>
                        <input type="text" name="keywords" value="{{$blog->keyword}}" required class="form-control"
                            id="exampleInputKeywords1"  placeholder="Keyword">
                        @if($errors->has('keywords'))
                        <p class="text-danger">{{ $errors->first('keywords') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="tags" class="">Tags<font color="red">*</font> :</label>
                        <input id="tags" class="form-control" name="tags" value="{{$blog->tags}}" placeholder="Add Tags"
                             data-role="tagsinput">
                        @if($errors->has('tags'))
                        <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                            <strong>{{ $errors->first('tags') }}</strong>
                        </p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>File upload<font color="red">*</font></label>
                        <input type="file" name="image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info"  disabled
                                placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                        @if($blog->image != '')
                        <div id="image">
                            <img class="rounded mt-2" src="{{ asset('storage/blogs/'.$blog->image) }}"
                                alt="{{ $blog->title }}" style="width: 50px">
                        </div>
                        @endif
                        @if($errors->has('image'))
                        <p class="text-danger">{{ $errors->first('image') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Content</h4>
                    <div class="form-group">
                        <label for="exampleInputdescripation1">Descipation<font color="red">*</font></label>
                        <input type="text" name="desc" value="{{$blog->desc}}" required class="form-control"
                            id="exampleInputdescripation1"  placeholder="Descipation">
                        @if($errors->has('desc'))
                        <p class="text-danger">{{ $errors->first('desc') }}</p>
                        @endif
                    </div>
    
                    <div class="form-group">
                        <label for="content">Content<font color="red">*</font></label>
                        <textarea class="form-control" value="{{$blog->content}}" name="content" id="content"
                            rows="5">{{$blog->content}}</textarea>
                        @if($errors->has('content'))
                        <p class="text-danger">{{ $errors->first('content') }}</p>
                        @endif
                    </div>
                    <button type="submit" id="updateBlogBTN" class="btn btn-primary mr-2 float-right">
                        <i class="mdi mdi-cloud-upload"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection