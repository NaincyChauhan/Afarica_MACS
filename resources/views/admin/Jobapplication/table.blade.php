<table id="shivadatatable" load-url="{{route('load-jobapplication-table')}}" class="table table-bordered">
    <thead>
        <tr>
            <th class="ml-5">#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Applied Job</th>
            <th>Address</th>
            <th>Current Sallery</th>
            <th>Expected Sallery</th>
            <th>Experience</th>
            <th>Resume</th>
            <th>Status</th>
            <th>Applied Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jobapplications as $jobapplication)
        <tr id="row{{ $jobapplication->id }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{$jobapplication->name}} </td>
            <td>{{$jobapplication->email}} </td>
            <td>{{$jobapplication->mobile}} </td>
            <td><a href="{{route('job-detail',['slug' => $jobapplication->job->slug])}}" class="text-primary" target="_blank">{{$jobapplication->job->title}}</a> </td>
            <td>{{$jobapplication->address}} </td>
            <td>{{$jobapplication->current_sallry}} </td>
            <td>{{$jobapplication->expected_sallry}} </td>
            <td>{{$jobapplication->total_experience}} </td>
            <td>
                @if (isset($jobapplication->resume))
                <a target="_blank" href="{{ asset('storage/documents/'.$jobapplication->resume) }}"
                    title="Download Resume"> Resume </a>
                @endif
            </td>
            <td>
                @if($jobapplication->status == 0)
                    <span onclick="callStatusModal('{{ route('change-jobapplication-status',['id' => $jobapplication->id]) }}')" role="button" class="p-1 rounded text-white bg-danger">Pending</span>
                @elseif($jobapplication->status == 1)
                    <span onclick="callStatusModal('{{ route('change-jobapplication-status',['id' => $jobapplication->id]) }}')" role="button" class="p-1 rounded text-white bg-success">Success</span>
                @elseif($jobapplication->status == 2)
                    <span onclick="callStatusModal('{{ route('change-jobapplication-status',['id' => $jobapplication->id]) }}')" role="button" class="p-1 rounded text-white bg-warning">Processing</span>
                @elseif($jobapplication->status == 3)
                    <span onclick="callStatusModal('{{ route('change-jobapplication-status',['id' => $jobapplication->id]) }}')" role="button" class="p-1 rounded text-white bg-danger">Cancel</span>
                @endif
            </td>
            <td>{{ date("d/m/Y", strtotime($jobapplication->created_at)) }}</td>
            
            <td>
                <div class="d-flex align-items-center">
                    <a class="btn btn-danger btn-sm btn-icon-text"
                        onclick="event.preventDefault(); callDelete($(this))"
                        href="{{ route('jobapplication.destroy', $jobapplication->id) }}">
                        Delete
                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>