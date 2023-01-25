@extends('layouts.admin')
@section('title')
Add Course
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.all.min.js"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('app-assets/masterX/js/custom.js') }}"></script>
    <script src="{{ asset('app-assets/masterX/js/listings.js') }}"></script>
    <script>
        addValidation();
    </script>
@endsection
@section('content')
<div class="row">
    <div class="col-xl-6 grid-margin stretch-card flex-column">
        <div class="d-flex align-items-baseline">
            <p class="mb-0"><a href="{{route('listing.index')}}">Listings</a></p>
            <i class="typcn typcn-chevron-right"></i>
            <p class="mb-0">Add Listing</p>
        </div>
    </div>
</div>
<form class="forms-sample" action="{{route('listing.store')}}" method="POST" id="addlistingForm"
    enctype="multipart/form-data">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Basic Details</h4>
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Title<font color="red">*</font></label>
                        <input type="text" name="title" value="{{ old('title') }}" required class="form-control" placeholder="Title">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputKeywords1">Keywords<font color="red">*</font></label>
                        <input type="text" name="keyword" value="{{ old('keyword') }}" required class="form-control" placeholder="Keywords" >
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputregular_price_1">Regular Price<font color="red">*</font></label>
                                <input type="number" name="regular_price" value="{{ old('regular_price') }}"  class="form-control" placeholder="Regular Price" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputsell_price_1">Sell Price</label>
                                <input type="number" name="sell_price" value="{{ old('sell_price') }}"  class="form-control" placeholder="Sell Price" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Images upload<font color="red">*</font></label>
                        <input type="file" name="image[]" accept="image/*" multiple class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button" ">Upload</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputMapLocation1">Map Location<font color="red">*</font></label>
                        <input type="text" name="map_location" value="{{ old('map_location') }}" required class="form-control" placeholder="Map Location" >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Address</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputName1">City<font color="red">*</font></label>
                                <input type="text" name="city" value="{{ old('city') }}" required class="form-control" placeholder="City">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputName1">State<font color="red">*</font></label>
                                <input type="text" name="state" value="{{ old('state') }}" required class="form-control" placeholder="State">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputName1">Country<font color="red">*</font></label>
                                <input type="text" name="country" value="{{ old('country') }}" required class="form-control" placeholder="Country">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputName1">Address<font color="red">*</font></label>
                                <input type="text" name="address" value="{{ old('address') }}" required class="form-control" placeholder="Address">
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
                        <label for="exampleInputdescripation1">Description<font color="red">*</font></label>
                        <input type="text" name="description" value="{{ old('description') }}" required class="form-control" placeholder="Desciption" >
                    </div>

                    <div class="form-group">
                        <label for="content">Content<font color="red">*</font></label>
                        <textarea class="form-control" name="content" id="content" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 float-right" id="addlistingBTN" >
                        <i class="mdi mdi-cloud-upload"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection