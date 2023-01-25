<form method="POST" action="{{ route('category.update', $category->id) }}" id="updatecategoryForm"
    enctype="multipart/form-data">
    <div class="modal-body">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name" class="form-label">Name<font color="red">*</font> :</label>
            <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $category->title }}"
                required>
            @if($errors->has('title'))
            <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
            </p>
            @endif
        </div>
        <div class="form-group">
            <label for="slug" class="form-label">Slug<font color="red">*</font> :</label>
            <input type="text" id="slug" class="form-control" placeholder="Slug" name="slug"
                value="{{ $category->slug }}" required>
            @if($errors->has('slug'))
            <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                <strong>{{ $errors->first('slug') }}</strong>
            </p>
            @endif
        </div>       
        <div class="form-group">
            <label>Image upload</label>
            <input type="file" id="categoryimage" name="image" value="{{ old('image') }}" accept="image/*" class="file-upload-default">
            <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                <span class="input-group-append">
                    <label for="categoryimage" id="categoryimagelable" class="file-upload-browse btn btn-primary" type="button">Upload</label>
                </span>
            </div>
            <img class="rounded mt-2" src="{{ asset('storage/categories/'.$category->image) }}" alt="{{ $category->title }}" style="width: 100px">
            @if($errors->has('image'))
                <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                    <strong>{{ $errors->first('image') }}</strong>
                </p>
            @endif
        </div>
        <div class="form-group">
            <div class="form-check form-check-flat form-check-primary">
                <label class="form-check-label">
                  <input name="is_menu" type="checkbox" style="z-index: 1000;opacity: 20;top: 4px;" class="form-check-input"  @checked($category->is_menu == 1 ? true : false)>
                  Is Menu
                </label>
              </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="updatecategoryBTN" type="button" type="submit" onclick="$('#updatecategoryForm').submit()" class="btn btn-primary">
            <i class="typcn typcn-edit btn-icon-append"></i> Update
        </button>
    </div>
</form>
<script>
    //validate
    updateValidation();
</script>