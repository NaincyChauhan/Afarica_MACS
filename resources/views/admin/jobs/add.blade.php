@extends('layouts.admin')
@section('title')
Add job
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('app-assets/plugins/tagsinput/jquery.tagsinput.min.css') }}">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('app-assets/plugins/tagsinput/jquery.tagsinput.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.all.min.js"></script>
    <!-- jquery-validation -->

    <script src="{{ asset('app-assets/masterX/js/custom.js') }}"></script>
    <script src="{{ asset('app-assets/masterX/js/jobs.js') }}"></script>
    <script>
        addValidation();
    </script>
@endsection
@section('content')
<div class="row">
    <div class="col-xl-6 grid-margin stretch-card flex-column">
        <div class="d-flex align-items-baseline">
            <p class="mb-0"><a href="{{route('job.index',['type'=>$type])}}">Jobs</a></p>
            <i class="typcn typcn-chevron-right"></i>
            <p class="mb-0">Add Job</p>
        </div>
    </div>
</div>
<form class="forms-sample" action="{{route('job.store')}}" method="POST" id="addJobForm"
    enctype="multipart/form-data">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Basic Details</h4>
                    @csrf
                    <input type="text" value="{{$type}}"  name="type" hidden>
                    <div class="form-group">
                        <label for="exampleInputName1">Title<font color="red">*</font></label>
                        <input type="text" name="title" value="{{ old('title') }}" required class="form-control" placeholder="Title">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputKeywords1">Keywords<font color="red">*</font></label>
                        <input type="text" name="keywords" value="{{ old('keywords') }}" required class="form-control" placeholder="Keywords">
                    </div>
                    <div class="form-group">
                        <label>File upload<font color="red">*</font></label>
                        <input type="file" name="image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Advance Details</h4>
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputName1">Location<font color="red">*</font></label>
                                <input type="text" name="location" value="{{ old('location') }}" required class="form-control" placeholder="Location">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputName1">Company Name<font color="red">*</font></label>
                                <input type="text" name="company_name" value="{{ old('company_name') }}" required class="form-control" placeholder=" Company Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputName1">Position<font color="red">*</font></label>
                                <input type="text" name="position" value="{{ old('position') }}" required class="form-control" placeholder="Position">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputName1">Job Type<font color="red">*</font></label>
                                <input type="text" name="job_type" value="{{ old('job_type') }}" required class="form-control" placeholder="Like -: Permanent , etc.">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputName1">Salary<font color="red">*</font></label>
                                <input type="text" name="salary" value="{{ old('salary') }}" required class="form-control" placeholder="Salary">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputName1">experience<font color="red">*</font></label>
                                <input type="text" name="experience" value="{{ old('experience') }}" required class="form-control" placeholder="Experience">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputName1">Qualification<font color="red">*</font></label>
                                <input type="text" name="qualification" value="{{ old('qualification') }}" required class="form-control" placeholder="Qualification">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputName1">No Of Vacancy<font color="red">*</font></label>
                                <input type="number" name="no_of_vacancy" value="{{ old('no_of_vacancy') }}" required class="form-control" placeholder="No Of Vacancy">
                            </div>
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
                        <label for="content">Description<font color="red">*</font></label>
                        <textarea class="form-control" name="content"  required id="content" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 float-right" id="addJobBTN">
                        <i class="mdi mdi-cloud-upload"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection