<table id="shivadatatable" class="table table-bordered table-striped mb-5">
    <thead>
    <tr>
      <th>#</th>
      <th>Title</th>
      <th>Description</th>
      <th>Image</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach($imagegalleries as $imagegallery)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $imagegallery->title }}</td>
            <td>{{ substr($imagegallery->desc, 0, 100) }}</td>
            <td>
              <img class="rounded" src="{{ asset('storage/gallery/'.$imagegallery->image) }}" alt="{{ $imagegallery->title }}" style="width: 50px">
            </td>
            <td>
              <div class="d-flex align-items-center">
                <a class="btn btn-success btn-sm btn-icon-text mr-3 text-white"
                    onclick="event.preventDefault(); callUpdate($(this))"
                    href="{{ route('imagegallery.edit', $imagegallery->id) }}">
                    Edit
                    <i class="typcn typcn-edit btn-icon-append"></i>
                </a>
                <a class="btn btn-danger btn-sm btn-icon-text"
                    onclick="event.preventDefault(); callDelete($(this))"
                    href="{{ route('imagegallery.destroy', $imagegallery->id) }}">
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
      <th>Description</th>
      <th>Image</th>
      <th>Action</th>
    </tr>
    </tfoot>
  </table>