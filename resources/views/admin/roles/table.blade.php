<table id="shivadatatable" class="table table-bordered table-striped mb-5">
  <thead>
    <th>#</th>
    <th>Name</th>
    <th>Action</th>
  </thead>
  <tbody>
      @foreach($roles as $role)
          <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{$role->name}}</td>
              <td>
                <div class="d-flex align-items-center">
                  <a class="btn btn-success btn-sm btn-icon-text mr-3 text-white" href="{{ route('role.edit', $role->id) }}">
                    <i class="mdi mdi-table-edit"></i> Edit
                  </a>
                  <a class="btn btn-danger btn-sm btn-icon-text" onclick="event.preventDefault(); callDelete($(this))" href="{{ route('role.destroy', $role->id) }}">
                    <i class="mdi mdi-delete-variant"></i> Delete
                  </a>
                </div>
                  @if(Auth::user()->can('edit-role'))
                      <a href="{{ route('role.edit', $role->id) }}">
                          <i class='far fa-edit h4 text-primary ml-1'></i>
                      </a>
                  @endif
                  @if(Auth::user()->can('delete-role'))
                      @if($role->name != 'Super Admin' && $role->name !='Doctor')
                          <a href="" onclick="deleteRole('form{{ $loop->iteration }}')">
                              <i class='far fa-trash-alt h4 text-danger ml-1'></i>
                              <form id="form{{ $loop->iteration }}" method="post" action="{{ route('role.destroy', $role->id) }}">
                                  @csrf
                                  @method('DELETE')
                              </form>
                          </a>
                      @endif
                  @endif
              </td>
          </tr>
      @endforeach                                            
  </tbody>
  <tfoot>
      <th>#</th>
      <th>Name</th>
      <th>Role</th>
  </tfoot>
</table>
<script>
  makeDataTable();
</script>