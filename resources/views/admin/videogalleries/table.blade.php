<table id="shivadatatable" class="table table-bordered table-striped mb-5">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Thumbnail</th>
            <th>Video</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($videogalleries as $video)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $video->title }}</td>
            <td>
                <img class="rounded" src="{{ asset('storage/videogalleries/'.$video->thumbnail) }}"
                    alt="{{ $video->title }}" style="width:100px;height:auto;">
            </td>
            <td>
                <a target="_blank" href="https://www.youtube.com/embed/{{$video->video}}"
                    title="{{ $video->title }}">Watch</a>
            </td>
            <td>{{ substr($video->desc, 0, 100) }}</td>
            <td>
                <div class="d-flex align-items-center">
                    <a class="btn btn-success btn-sm btn-icon-text mr-3 text-white"
                        onclick="event.preventDefault(); callUpdate($(this))"
                        href="{{ route('videogallery.edit', $video->id) }}">
                        Edit
                        <i class="typcn typcn-edit btn-icon-append"></i>
                    </a>
                    <a class="btn btn-danger btn-sm btn-icon-text"
                        onclick="event.preventDefault(); callDelete($(this))"
                        href="{{ route('videogallery.destroy', $video->id) }}">
                        Delete
                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Thumbnail</th>
            <th>Video</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>