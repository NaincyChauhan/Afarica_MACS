<form method="POST" action="{{ route('staff.update', $staff->id) }}" id="request-form-edit" enctype="multipart/form-data">
    <div class="modal-body">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name" class="">Name<font color="red">*</font> :</label>
                    <input type="text" class="form-control" name="name" placeholder="Name"  value="{{ $staff->name }}"> 
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="email" class="">Email<font color="red">*</font> :</label>
                    <input type="email" class="form-control" name="email" placeholder="Email"   value="{{ $staff->email }}">
                </div>
            </div> 
            <div class="col-md-12">
                <div class="form-group">
                    <label for="mobile" class="">Mobile<font color="red">*</font> :</label>
                    <input type="text" class="form-control" name="mobile" placeholder="Mobile"  value="{{ $staff->mobile }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="role_id" class="">Select Role<font color="red">*</font> :</label>
                    <select class="form-control" name="role_id"  >
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}"  @if($staff->user->roles()->exists()) {{ $staff->user->roles()->first()->id == $role->id ? 'selected' : '' }} @endif>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="form-group">
                    <label for="password" class="">Password :</label>
                    <input type="text" class="form-control" name="password" placeholder="Password"  >
                </div>
            </div> 
        </div>
    </div>
    <div class="modal-footer">
        <button id="request-btn-edit" type="button" type="submit" onclick="$('#request-form-edit').submit()" class="btn btn-primary">
      <i class="mdi mdi-plus-circle-outline"></i> Update
    </button>
    </div>
</form>

<script>
    updateValidation();
</script>