<table id="shivadatatable" class="table table-bordered">
    <thead>
        <tr>
            <th>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input name="select_all" onchange="selectAllToggle($(this))"
                                type="checkbox" id="select_all" class="form-check-input">
                            <i class="input-helper"></i>
                        </label>
                    </div>
                </div>
            </th>
            <th>#</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($blogtags as $blogtag)
        <tr id="row{{ $blogtag->id }}">
            <td>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input name="select_data[]" data-id="{{$blogtag->id}}" type="checkbox"
                                id="select_data{{ $blogtag->id }}"
                                class="form-check-input check-box-items all_select_rows">
                            <i class="input-helper"></i>
                        </label>
                    </div>
                </div>
            </td>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $blogtag->title }}</td>
            <td>{{ $blogtag->slug }}</td>
            <td>
                <a class="btn btn-danger btn-sm btn-icon-text"
                    onclick="event.preventDefault(); callDelete($(this))"
                    href="{{ route('blogtag.destroy', $blogtag->id) }}">
                    Delete
                    <i class="typcn typcn-delete-outline btn-icon-append"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>