//validate
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#addcoursecontentForm').validate({
        rules: {
            title: "required",
            video: "required",
            duration: "required",
        },
        messages: {
            title: "Oops.! The Title field is required.",
            video: "Oops.! The Video field is required.",
            duration: "Oops.! The Duration field is required.",
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(f) {
            var btn = $('#addcoursecontentBTN'),
                form = $('#addcoursecontentForm');
            btn.attr('disabled', true);
            btn.html('Saving <i class="mdi mdi-cloud-circle"></i>');
            $.ajax({
                type: "POST",
                processData: false,
                contentType: false,
                url: form.attr('action'),
                data: new FormData(form[0]), // serializes the form's elements.
                success: function(data) {
                    if (parseInt(data.status) == 1) {
                        ajaxMessage(1, data.message);
                        loadAjaxTable();
                    } else {
                        ajaxMessage(0, data.message);
                    }
                    btn.attr("disabled", false);
                    form[0].reset();
                    btn.html('<i class="mdi mdi-plus-circle-outline"></i> Save');
                    $('#addcoursecontent').modal('hide');
                },
                error: function(data) {
                    var msg = data.responseJSON.message,
                        error = "<ul>";

                    $.each(data.responseJSON.errors, function(key, value) {
                        error += "<li>" + value + "</li>";
                    });
                    error += "</ul>";
                    errorsHTMLMessage(msg + "<br>" + error);
                    btn.attr("disabled", false);
                    btn.html('<i class="mdi mdi-plus-circle-outline"></i> Save');
                }
            });

            return false;
        }
    });
});


function updateValidation() {
    $('#updatecoursecontentForm').validate({
        rules: {
            title: "required",
            video: "required",
            duration: "required",
        },
        messages: {
            title: "Oops.! The Title field is required.",
            video: "Oops.! The Video field is required.",
            duration: "Oops.! The Duration field is required.",
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
            var btn = $('#updatecoursecontentBTN'),
                form = $('#updatecoursecontentForm');
            btn.attr('disabled', true);
            btn.html('Saving <i class="mdi mdi-cloud-circle"></i>');
            $.ajax({
                type: "POST",
                processData: false,
                contentType: false,
                url: form.attr('action'),
                data: new FormData(form[0]), // serializes the form's elements.
                success: function(data) {
                    if (parseInt(data.status) == 1) {
                        ajaxMessage(1, data.message);
                        loadAjaxTable();
                    } else {
                        ajaxMessage(0, data.message);
                    }
                    btn.attr("disabled", false);
                    form[0].reset();
                    btn.html('<i class="mdi mdi-plus-circle-outline"></i> update');
                    $('#editcoursecontent').modal('hide');
                },
                error: function(data) {
                    var msg = data.responseJSON.message,
                        error = "<ul>";

                    $.each(data.responseJSON.errors, function(key, value) {
                        error += "<li>" + value + "</li>";
                    });
                    error += "</ul>";
                    errorsHTMLMessage(msg + "<br>" + error);
                    btn.attr("disabled", false);
                    btn.html('<i class="mdi mdi-plus-circle-outline"></i> update');
                }
            });

            return false;
        }
    });
}

function callUpdate(e) {
    var url = e.attr('href');
    e.html('Requesting <i class="mdi mdi-cloud-circle"></i>');
    $.ajax({
        type: "GET",
        url: url,
        data: {},
        success: function(data) {
            $('#editData').html(data);
            $('#editcoursecontent').modal('show');
            e.html('Edit <i class="typcn typcn-edit btn-icon-append"></i>');
        },
        error: function(data) {
            ajaxMessage(0, "Something went wrong.!");
            e.html('Edit <i class="typcn typcn-edit btn-icon-append"></i>');
        }
    });
}

function showVideo(e) {
    $('#video-title').html(e.attr('video-title'));
    $('#video-iframe').attr('src',e.attr('video-id'));
    $('#watchcoursecontentvideo').modal('show');
}


function callDelete(e) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Proceed!'
    }).then((result) => {
        if (result.isConfirmed) {
            var url = e.attr('href');
            e.html('Deleting <i class="mdi mdi-cloud-circle"></i>');
            $.ajax({
                type: "DELETE",
                url: url,
                data: {},
                success: function(data) {
                    ajaxMessage(1, data.message);
                    loadAjaxTable();
                    e.html('Delete <i class="typcn typcn-delete-outline btn-icon-append"></i>');
                },
                error: function(data) {
                    ajaxMessage(0, "Something went wrong.!");
                    e.html('Delete <i class="typcn typcn-delete-outline btn-icon-append"></i>');
                }
            });
        }
    });
}

function loadAjaxTable() {
    $.ajax({
        type: "GET",
        url: $('#shivadatatable').attr('load-url'),
        data: {},
        success: function(data) {
            $('#ajax_data_table').html(data);
            loadDataTable();
        },
        error: function(data) {
            ajaxMessage(0, "Something went wrong.!");
        }
    });
}