<table id="shivadatatable" class="table table-bordered">
    <thead>
        <tr>
            <th class="ml-5">#</th>
            <th>Title</th>
            <th>Image</th>
            <th>Descipation</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($events as $events)
        <tr id="row{{$events->id}}">
            <td>{{ $loop->iteration }}</td>
            <td>{{$events->title}} </td>
            <td>
                @if (isset($events->image))
                    @foreach ($events->image as $image)                                            
                        <img class="rounded" src="{{ asset('storage/events/'.$image) }}"
                            alt="{{ $events->title }}" style="width: 50px">
                    @endforeach
                @endif
            </td>
            <td>{{$events->desc}} </td>
            <td>
                <div class="d-flex align-items-center">
                    <a href="{{route('event.edit',$events->id)}}" style="color: white;">
                        <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                            Edit
                            <i class="typcn typcn-edit btn-icon-append"></i>
                        </button>
                    </a>
                    <a class="btn btn-danger btn-sm btn-icon-text"
                        onclick="event.preventDefault(); callDelete($(this))"
                        href="{{ route('event.destroy', $events->id) }}">
                        Delete
                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>