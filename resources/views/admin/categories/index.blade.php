@extends('layouts.admin')

@section('title')
Categories
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
<!-- jquery-validation -->
<script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('app-assets/masterX/js/custom.js') }}"></script>
<script src="{{ asset('app-assets/masterX/js/categories.js') }}"></script>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row" id="headerRow">
                    <h4 class="card-title">Categories</h4>
                    <a class="btn btn-primary btn-rounded btn-fw float-right text-white" data-toggle="modal"
                        data-target="#addcategory">
                        <i class="mdi mdi-plus-circle-outline"></i> Category
                    </a>
                </div>
                <div class="table-responsive pt-3"  id="ajax_data_table">
                        <table id="shivadatatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="ml-5">#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Is Menu</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr id="row{{ $category->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if (isset($category->image))
                                            <img class="rounded" src="{{ asset('storage/categories/'.$category->image) }}" style="width: 50px">
                                        @endif
                                    </td>
                                    <td>{{$category->title}} </td>
                                    <td>  
                                        <span class="badge badge-{{$category->is_menu == 1 ? 'success' : 'danger'}}">{{$category->is_menu == 1 ? 'Menu' : 'Not Menu'}}</span>                             
                                    </td>    
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a class="btn btn-success btn-sm btn-icon-text mr-3 text-white"
                                                onclick="event.preventDefault(); callUpdate($(this))"
                                                href="{{ route('category.edit', $category->id) }}">
                                                Edit
                                                <i class="typcn typcn-edit btn-icon-append"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm btn-icon-text"
                                                onclick="event.preventDefault(); callDelete($(this))"
                                                href="{{ route('category.destroy', $category->id) }}">
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

{{-- Add category Modal --}}
<div class="modal fade" id="addcategory" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form method="POST" action="{{ route('category.store') }}" id="addcategoryForm"
                enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">Name<font color="red">*</font> :</label>
                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}"
                            required>
                        @if($errors->has('name'))
                        <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="slug" class="form-label">Slug (Leave blank for auto-generate) :</label>
                        <input type="text" id="slug" class="form-control" placeholder="Slug" name="slug"
                            value="{{ old('slug') }}">
                        @if($errors->has('slug'))
                        <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                            <strong>{{ $errors->first('slug') }}</strong>
                        </p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Image : </label>
                        <input type="file" placeholder="Image" name="image" value="{{ old('image') }}" accept="image/*"
                            class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled
                                placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                        @if($errors->has('image'))
                        <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                            <strong>{{ $errors->first('image') }}</strong>
                        </p>
                        @endif
                    </div>
                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input name="is_menu" type="checkbox" class="form-check-input">
                            Is Menu
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="addcategoryBTN" type="button" type="submit" onclick="$('#addcategoryForm').submit()"
                        class="btn btn-primary">
                        <i class="mdi mdi-plus-circle-outline"></i> Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add category Modal-->

{{-- Edit category Modal --}}
<div class="modal fade" id="editcategory" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div id="editData"></div>
        </div>
    </div>
</div>
<!-- End Edit category Modal-->
@endsection