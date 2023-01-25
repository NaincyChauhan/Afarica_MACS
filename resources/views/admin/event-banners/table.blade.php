<table id="shivadatatable" class="table table-bordered">
    <thead>
        <tr>
            <th class="ml-5">#</th>
            <th>Image</th>
            <th>Title</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($eventbanners as $eventbanner)
        <tr id="row{{ $eventbanner->id }}">
            <td>{{ $loop->iteration }}</td>
            <td>
                @if (isset($eventbanner->image))
                    <img class="rounded" src="{{ asset('storage/banners/'.$eventbanner->image) }}" style="width: 100px">
                @endif
            </td>
            <td>{{$eventbanner->title}} </td>                                        
            <td>
                <div class="d-flex align-items-center">
                    <a class="btn btn-success btn-sm btn-icon-text mr-3 text-white"
                        onclick="event.preventDefault(); callUpdate($(this))"
                        href="{{ route('eventbanner.edit', $eventbanner->id) }}">
                        Edit
                        <i class="typcn typcn-edit btn-icon-append"></i>
                    </a>
                    <a class="btn btn-danger btn-sm btn-icon-text"
                        onclick="event.preventDefault(); callDelete($(this))"
                        href="{{ route('eventbanner.destroy', $eventbanner->id) }}">
                        Delete
                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>