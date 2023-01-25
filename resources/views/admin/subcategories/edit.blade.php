<form method="POST" action="{{ route('subcategory.update', $category->id) }}" id="updatecategoryForm" enctype="multipart/form-data">
  <div class="modal-body">
    @csrf
    @method('put')
    <div class="form-group">
        <div>
            <label>Select Category<font color="red">*</font></label>
        </div>
        <select name="category_id" class="js-example-basic-single" style="width: 100%;" id="edit_category_id">
            <option value="{{$category->category_id}}" selected>{{$category->category->title}}</option>
            @foreach ($categories as $cat_)                        
            @if ($cat_->id != $category->category_id)                        
            <option value="{{$cat_->id}}">{{$cat_->title}}</option>
            @endif
            @endforeach
        </select>
        @if($errors->has('category_id'))                   
                <p class="text-danger">{{ $errors->first('category_id') }}</p>
        @endif
    </div>

    <div class="form-group">
        <label for="name" class="form-label">Name<font color="red">*</font> :</label>
        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $category->title }}" required>            
        @if($errors->has('title'))
            <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
            </p>
        @endif
    </div>
    <div class="form-group">
        <label for="slug" class="form-label">Slug<font color="red">*</font> :</label>
        <input type="text" id="slug" class="form-control" placeholder="Slug" name="slug" value="{{ $category->slug }}" required>            
        @if($errors->has('slug'))
            <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                <strong>{{ $errors->first('slug') }}</strong>
            </p>
        @endif
    </div>

    <div class="form-group">
        <label>Image</label>
        <input type="file" id="categoryimage" name="image" value="{{ old('image') }}" accept="image/*" class="file-upload-default">
        <div class="input-group col-xs-12">
            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
            <span class="input-group-append">
                <label for="categoryimage" id="categoryimagelable" class="file-upload-browse btn btn-primary" type="button">Upload</label>
            </span>
        </div>
        @if ($category->image)          
        <img class="rounded mt-2" src="{{ asset('storage/categories/'.$category->image) }}" alt="{{ $category->title }}" style="width: 100px">
        @endif
        @if($errors->has('image'))
            <p class="invalid-feedback text-danger" style="display:block!important;" role="alert">
                <strong>{{ $errors->first('image') }}</strong>
            </p>
        @endif
  </div>
  </div>
  <div class="modal-footer">
      <button id="updatecategoryBTN" type="button" type="submit" onclick="$('#updatecategoryForm').submit()" class="btn btn-primary">
        <i class="typcn typcn-edit btn-icon-append"></i> Update
      </button>
  </div>
</form>
<script>
    updateValidation();
</script>