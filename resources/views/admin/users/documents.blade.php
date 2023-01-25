@extends('layouts.admin') @section('title') Users @endsection 
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('app-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('app-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('app-assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('app-assets/css/switch-toggle.css') }}">
<style>
    .userimage{
        width: 100px !important;
        height:auto !important;
        border-radius: 0px !important;
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
<!-- jquery-validation -->
<script src="{{ asset('app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script>
    $(function() {
        makeDataTable();
    });

    function makeDataTable() {
        $("#shivadatatable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#shivadatatable_wrapper .col-md-6:eq(0)');
    }
</script>
@endsection @section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row" id="headerRow">
                    <h4 class="card-title">User Docuemnts</h4>
                    <a class="btn btn-primary btn-rounded btn-fw float-right text-white" >
                        Documents
                    </a>
                </div>
                <div class="table-responsive pt-3"  id="ajax_data_table">
                    <table id="shivadatatable" class="table table-striped mb-5">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($user->image))
                                <tr>
                                    <td>#</td>
                                    <td>
                                        <div>
                                            <img class="userimage" src="{{asset('storage/users/'.$user->image)}}" title="Profile" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-success btn-sm btn-icon-text" href="{{asset('storage/users/'.$user->image)}}" target="_blank">
                                            <i class="mdi mdi-folder-image"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endif
                            @if (isset($user->singnature))
                                <tr>
                                    <td>#</td>
                                    <td><img class="userimage" src="{{asset('storage/users/'.$user->singnature)}}" title="Profile" alt=""></td>
                                    <td>                                       
                                        <a class="btn btn-success btn-sm btn-icon-text" href="{{asset('storage/users/'.$user->singnature)}}" target="_blank">
                                            <i class="mdi mdi-folder-image"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endif
                            @foreach($user->usersexprience as $exprience)
                                @if(isset($exprience->document))
                                    <tr>
                                        <td>#</td>
                                        <td>{{$exprience->company_name}}</td>
                                        <td>                                            
                                            <a class="btn btn-success btn-sm btn-icon-text" href="{{asset('storage/documents/'.$exprience->document)}}" target="_blank">
                                                <i class="mdi mdi-folder-image"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            @foreach($user->usersqualification as $qualification)
                                @if(isset($qualification->document))
                                    <tr>
                                        <td>#</td>
                                        <td>{{$qualification->name}}</td>
                                        <td>
                                            <a target="_blank" class="btn btn-success btn-sm btn-icon-text" href="{{asset('storage/documents/'.$qualification->document)}}">
                                                <i class="mdi mdi-folder-image"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>View</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection