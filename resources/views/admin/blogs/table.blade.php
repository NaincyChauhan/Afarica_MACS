<table id="shivadatatable" class="table table-bordered">
    <thead>
        <tr>
            <th class="ml-5">#</th>
            <th>Category</th>
            <th>Title</th>
            <th>Image</th>
            <th>Keyword</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($blogs as $blog)
        <tr id="row{{ $blog->id }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{$blog->blogcategory->title}} </td>
            <td>{{$blog->title}} </td>
            <td>
                @if (isset($blog->image))
                <img class="rounded" src="{{ asset('storage/blogs/'.$blog->image) }}"
                    alt="{{ $blog->title }}" style="width: 50px">
                @endif
            </td>
            <td>{{$blog->keyword}} </td>
            
            <td>
                <div class="d-flex align-items-center">
                    <a href="{{route('blog.edit',$blog->id )}}" style="color: white;">
                        <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                            Edit<i class="typcn typcn-edit btn-icon-append"></i>
                        </button>
                    </a>
                    <a class="btn btn-danger btn-sm btn-icon-text"
                        onclick="event.preventDefault(); callDelete($(this))"
                        href="{{ route('blog.destroy', $blog->id) }}">
                        Delete
                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>