<form method="POST" action="{{ route('imagegallery.update', $imagegallery->id) }}" id="request-form-edit" enctype="multipart/form-data">
    <div class="modal-body">
      @csrf
      @method('put')
      <div class="form-group">
          <label for="inputText" class="form-label">Title :</label>
          <input type="text" class="form-control" name="title" value="{{ $imagegallery->title }}">            
          @if($errors->has('title'))
              <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                  <strong>{{ $errors->first('title') }}</strong>
              </p>
          @endif
      </div>
      <div class="form-group">
        <label for="inputText" class="form-label">Image :</label>
        <input type="file" class="form-control" name="image" accept="image/*">
        <img class="rounded mt-2" src="{{ asset('storage/gallery/'.$imagegallery->image) }}" alt="{{ $imagegallery->title }}" style="width: 100px">
        @if($errors->has('image'))
            <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                <strong>{{ $errors->first('image') }}</strong>
            </p>
        @endif
      </div>
      <div class="form-group">
        <label for="inputText" class="form-label">Description :</label>
        <textarea class="form-control" name="desc" value="">{{ $imagegallery->desc }}</textarea>
        @if($errors->has('desc'))
            <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                <strong>{{ $errors->first('desc') }}</strong>
            </p>
        @endif
      </div>
    </div>
    <div class="modal-footer">
        <button id="request-btn-edit" type="button" type="submit" onclick="$('#request-form-edit').submit()" class="btn btn-primary">
            <i class="typcn typcn-edit btn-icon-append"></i> Save
        </button>
    </div>
  </form>
  <script>
   updateValidation();
</script>