<form method="POST" action="{{ route('videogallery.update', $videogallery->id) }}" id="request-form-edit" enctype="multipart/form-data">
    <div class="modal-body">
      @csrf
      @method('put')
      <div class="form-group">
          <label for="inputText" class="form-label">Title :</label>
          <input type="text" class="form-control" name="title" value="{{ $videogallery->title }}">            
          @if($errors->has('title'))
              <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                  <strong>{{ $errors->first('title') }}</strong>
              </p>
          @endif
      </div>
      <div class="form-group">
        <label for="inputText" class="form-label">Video Id :</label>
        <input type="text" class="form-control" value="{{$videogallery->video}}" name="video"><br>
        <iframe id="video-iframe" width="250px" height="150px" class="rounded" src="https://www.youtube.com/embed/{{$videogallery->video}}" title="{{ $videogallery->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="form-group">
        <label>Thumbnail upload<font color="red">*</font></label>
        <input type="file" name="thumbnail" class="file-upload-default">
        <div class="input-group col-xs-12">
            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
            <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" type="button" ">Upload</button>
            </span>
        </div>
        @if($videogallery->thumbnail != '')
        <div id="thumbnail">
            <img class="rounded mt-2" src="{{ asset('storage/videogalleries/'.$videogallery->thumbnail) }}"
                alt="Video Thumbnail" style="width: 100px">
        </div>
        @endif
    </div>
      <div class="form-group">
        <label for="inputText" class="form-label">Description :</label>
        <textarea class="form-control" name="desc" value="">{{ $videogallery->desc }}</textarea>
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