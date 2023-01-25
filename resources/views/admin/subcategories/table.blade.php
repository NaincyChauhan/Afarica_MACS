<table id="shivadatatable" class="table table-bordered" >
    <thead>
        <tr>
            <th class="ml-5">#</th>
            <th>Category name</th>
            <th>SubCategory name</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subcategories as $category)
        <tr id="row{{ $category->id }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{$category->category->title}} </td>
            <td>{{$category->title}} </td>
            <td>
                @if (isset($category->image))
                <img class="rounded" src="{{ asset('storage/categories/'.$category->image) }}" alt="{{ $category->title }}" style="width: 50px"> @endif
            </td>

            <td>
                <div class="d-flex align-items-center">
                    <a class="btn btn-success btn-sm btn-icon-text mr-3 text-white" onclick="event.preventDefault(); callUpdate($(this))" href="{{ route('subcategory.edit', $category->id) }}">
                Edit 
                <i class="typcn typcn-edit btn-icon-append"></i>
            </a>
                    <a class="btn btn-danger btn-sm btn-icon-text" onclick="event.preventDefault(); callDelete($(this))" href="{{ route('subcategory.destroy', $category->id) }}">
                Delete 
                <i class="typcn typcn-delete-outline btn-icon-append"></i>
            </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>