<form class="p-2" method="POST" action="{{ route('coursecontent.update', $coursecontent->id) }}" id="updatecoursecontentForm"
    enctype="multipart/form-data">
    <div class="modal-body">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name" class="form-label">Title (Title Must be unique)<font color="red">*</font>
                :</label>
            <input type="text" class="form-control" placeholder="Enter Title" name="title"
                value="{{ $coursecontent->title }}" required>
        </div>

        <div class="form-group">
            <label for="video" class="form-label">Video <font color="red">*</font> :</label>
            <input type="text" id="video" class="form-control" placeholder="Enter Video Id" name="video"
                value="{{ $coursecontent->video }}">
        </div>

        <div class="form-group">
            <label for="duration" class="form-label">Duration <font color="red">*</font> :</label>
            <input type="text" id="duration" class="form-control" placeholder="Like : 45 Min."
                name="duration" value="{{ $coursecontent->duration }}">
        </div>
    </div>
    <div class="modal-footer">
        <button id="updatecoursecontentBTN" type="button" type="submit" onclick="$('#updatecoursecontentForm').submit()" class="btn btn-primary">
            <i class="typcn typcn-edit btn-icon-append"></i> Update
        </button>
    </div>
</form>
<script>
    //validate
    updateValidation();
</script>