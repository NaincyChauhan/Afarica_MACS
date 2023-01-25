<table id="shivadatatable" class="table table-bordered">
    <thead>
        <tr>
            <th class="ml-5">#</th>
            <th class="ml-5"></th>
            <th>Date</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Address</th>
            <th>Amount</th>
            <th>Transaction Status</th>
            <th>Transaction Id</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($donations as $donation)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                <input type="checkbox" class="checkbox" data-id="{{ $donation->id }}">
            </td>
            <td>{{ date("d M Y", strtotime($donation->created_at)) }}</td>
            <td>{{$donation->first_name}} {{$donation->last_name}} </td>
            <td>{{$donation->email}} </td>
            <td>{{$donation->mobile}} </td>
            <td>{{$donation->address}} </td>
            <td>${{$donation->amount}} </td>
            <td>{{$donation->transaction_status}} </td>
            <td>{{$donation->transaction_id}} </td>
            <td>
                <div class="d-flex align-items-center">                                        
                    <a class="btn btn-danger btn-sm btn-icon-text"
                        onclick="event.preventDefault(); callDelete($(this))"
                        href="{{ route('donation.destroy', $donation->id) }}">
                        Delete
                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>