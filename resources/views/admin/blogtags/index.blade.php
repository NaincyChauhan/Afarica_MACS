@extends('layouts.admin')

@section('title')
Blog Tags
@endsection
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
    <script src="{{ asset('app-assets/masterX/js/tags.js') }}"></script>

@endsection

@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row" id="headerRow">
                    <h4 class="card-title">Tags</h4>
                    <div class="form-group">
                        <label for="select-data-action">Bulk Action</label>
                        <select data-url="{{ route('delete-all-tags') }}" class="form-control" id="select-data-action">
                            <option value="" selected>Action</option>
                            <option value="delete"><button>Delete</button></option>
                        </select>
                    </div>
                </div>
                <div  id="ajax_data_table" class="table-responsive pt-3">
                        <table id="shivadatatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input name="select_all" onchange="selectAllToggle($(this))"
                                                        type="checkbox" id="select_all" class="form-check-input">
                                                    <i class="input-helper"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blogtags as $blogtag)
                                <tr id="row{{ $blogtag->id }}">
                                    <td>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input name="select_data[]" data-id="{{$blogtag->id}}" type="checkbox"
                                                        id="select_data{{ $blogtag->id }}"
                                                        class="form-check-input check-box-items all_select_rows">
                                                    <i class="input-helper"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $blogtag->title }}</td>
                                    <td>{{ $blogtag->slug }}</td>
                                    <td>
                                        <a class="btn btn-danger btn-sm btn-icon-text"
                                            onclick="event.preventDefault(); callDelete($(this))"
                                            href="{{ route('blogtag.destroy', $blogtag->id) }}">
                                            Delete
                                            <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                        </a>
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

@endsection