<table id="shivadatatable" load-url="{{route('load-job-table',['type' => $type])}}" class="table table-bordered">
    <thead>
        <tr>
            <th class="ml-5">#</th>
            <th>Title</th>
            <th>Location</th>
            <th>Image</th>
            <th>Company Name</th>
            <th>Position</th>
            <th>Job Type</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jobs as $job)
        <tr id="row{{ $job->id }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{$job->title}} </td>
            <td>{{$job->location}} </td>
            <td>
                @if (isset($job->image))
                <img class="rounded" src="{{ asset('storage/jobs/'.$job->image) }}"
                    alt="{{ $job->title }}" style="width: 50px">
                @endif
            </td>
            <td>{{$job->company_name}} </td>
            <td>{{$job->position}} </td>
            <td>{{$job->job_type}} </td>
            <td>
                <label class="switch">
                    <input type="checkbox" onchange="changeStatus($(this))" href="{{ route('change-job-status', $job->id) }}" {{ $job->status == 1 ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </td> 
            <td>
                <div class="d-flex align-items-center">
                    <a href="{{route('job.edit',$job->id )}}" style="color: white;">
                        <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                            Edit<i class="typcn typcn-edit btn-icon-append"></i>
                        </button>
                    </a>
                    <a class="btn btn-danger btn-sm btn-icon-text"
                        onclick="event.preventDefault(); callDelete($(this))"
                        href="{{ route('job.destroy', $job->id) }}">
                        Delete
                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>