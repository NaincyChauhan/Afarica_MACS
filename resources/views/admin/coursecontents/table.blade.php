<table id="shivadatatable" load-url="{{route('load-coursecontent-table',['course_id'=>$course_id])}}"
    class="table table-bordered table-striped mb-5">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Duration</th>
            <th>Video</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($coursecontents as $coursecontent)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $coursecontent->title }}</td>
            <td>{{ $coursecontent->duration }}</td>
            <td>
                <a class="btn btn-info btn-sm btn-icon-text mr-3 text-white"
                    onclick="event.preventDefault(); showVideo($(this))"
                    video-id="https://www.youtube.com/embed/{{$coursecontent->video}}" video-title="{{$coursecontent->title}}">
                    <i class="typcn typcn-video btn-icon-append"></i>
                </a>
            </td>
            <td>
                <a class="btn btn-success btn-sm btn-icon-text mr-3 text-white"
                    onclick="event.preventDefault(); callUpdate($(this))"
                    href="{{ route('coursecontent.edit', $coursecontent->id) }}">
                    Edit
                    <i class="typcn typcn-edit btn-icon-append"></i>
                </a>
                <a class="btn btn-danger btn-sm btn-icon-text" onclick="event.preventDefault(); callDelete($(this))"
                    href="{{ route('coursecontent.destroy', $coursecontent->id) }}">
                    Delete
                    <i class="typcn typcn-delete-outline btn-icon-append"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Duration</th>
            <th>Video</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>