<form method="POST" action="{{ route('eventbanner.update', $eventbanner->id) }}" id="updateeventbannerForm"
    enctype="multipart/form-data">
    <div class="modal-body">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="title" class="form-label">Title<font color="red">*</font> :</label>
            <input type="text" id="title" class="form-control" placeholder="Title" name="title" value="{{ $eventbanner->title }}" required>
            @if($errors->has('title'))
            <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
            </p>
            @endif
        </div>               
        <div class="form-group">
            <label>Banner upload</label>
            <input type="file" id="eventbanner" name="image" value="{{ old('image') }}" accept="image/*" class="file-upload-default">
            <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                <span class="input-group-append">
                    <label for="eventbanner" id="eventbannerlable" class="file-upload-browse btn btn-primary" type="button">Upload</label>
                </span>
            </div>
            <img class="rounded mt-2" src="{{ asset('storage/banners/'.$eventbanner->image) }}" alt="{{ $eventbanner->title }}" style="width: 100px">
            @if($errors->has('image'))
                <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                    <strong>{{ $errors->first('image') }}</strong>
                </p>
            @endif
        </div>
    </div>
    <div class="modal-footer">
        <button id="updateeventbannerBTN" type="button" type="submit" onclick="$('#updateeventbannerForm').submit()" class="btn btn-primary">
            <i class="typcn typcn-edit btn-icon-append"></i> Update
        </button>
    </div>
</form>
<script>
    //validate
    updateValidation();
</script>