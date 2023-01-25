<table id="shivadatatable" class="table table-bordered">
    <thead>
        <tr>
            <th class="ml-5">#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Is Menu</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr id="row{{ $category->id }}">
            <td>{{ $loop->iteration }}</td>
            <td>
                @if (isset($category->image))
                    <img class="rounded" src="{{ asset('storage/categories/'.$category->image) }}" style="width: 50px">
                @endif
            </td>
            <td>{{$category->title}} </td>
            <td>  
                <span class="badge badge-{{$category->is_menu == 1 ? 'success' : 'danger'}}">{{$category->is_menu == 1 ? 'Menu' : 'Not Menu'}}</span>                             
            </td>    
            <td>
                <div class="d-flex align-items-center">
                    <a class="btn btn-success btn-sm btn-icon-text mr-3 text-white"
                        onclick="event.preventDefault(); callUpdate($(this))"
                        href="{{ route('category.edit', $category->id) }}">
                        Edit
                        <i class="typcn typcn-edit btn-icon-append"></i>
                    </a>
                    <a class="btn btn-danger btn-sm btn-icon-text"
                        onclick="event.preventDefault(); callDelete($(this))"
                        href="{{ route('category.destroy', $category->id) }}">
                        Delete
                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>