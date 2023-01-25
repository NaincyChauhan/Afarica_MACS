<table load-url="{{route('load-consult-table',['type'=>$type])}}" id="shivadatatable" class="table table-bordered">
    <thead>
        <tr>
            <th class="ml-5">#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Transaction Id</th>
            <th>Payment Status</th>
            <th>Company Name</th>
            <th>Designation</th>
            <th>Company Type</th>
            <th>Short_desc</th>
            <th>description</th>
            <th>Business Address</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($consults as $consult)
        <tr id="row{{ $consult->id }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{$consult->name}} </td>
            <td>{{$consult->email}} </td>
            <td>{{$consult->mobile}} </td>
            <td>{{$consult->transaction_id}} </td>
            <td>
                @if ($consult->payment_status == 1)
                    <span class="p-1 rounded text-white bg-danger">Pending</span>
                @elseif($consult->payment_status == 0)
                    <span class="p-1 rounded text-white bg-danger">Cancel</span>
                @elseif($consult->payment_status == 2)
                    <span class="p-1 rounded text-white bg-danger">Proccessing</span>
                @endif 
            </td>
            <td>{{$consult->company_type}} </td>
            <td>{{$consult->designation}} </td>
            <td>{{$consult->company_type}} </td>
            <td>{{$consult->company_type}} </td>
            <td>{{$consult->description}} </td>
            <td>{{$consult->business_address}} </td>                                    
            <td>{{ date("d/m/Y", strtotime($consult->created_at)) }}</td>
            
            <td>
                <div class="d-flex align-items-center">
                    <a class="btn btn-danger btn-sm btn-icon-text"
                        onclick="event.preventDefault(); callDelete($(this))"
                        href="{{ route('consult.destroy', $consult->id) }}">
                        Delete
                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                    </a>
                </div>                                        
            </td>
        </tr>
        @endforeach
    </tbody>
</table>