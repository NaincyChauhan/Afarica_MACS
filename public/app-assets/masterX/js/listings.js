$(function() {
    // Ajax CSRF Token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Summernote
    $(function() {
        $('#content').summernote({
            height: 300,
            fullscreen: false,
        });
    });

});

// Save Listing Validation
function addValidation() {
    $('#addlistingForm').validate({
        rules: {
            'image': "required",
            'title' : 'required',
            'description' : 'required',
            'map_location' : 'required',
            'city' : 'required',
            'state' : 'required',
            'country' : 'required',
            'address' : 'required',
            'content' : 'required',
            'keyword' : 'required',
            'regular_price' : 'required',
        },
        messages: {
            image: "Oops.! The Image field is required.",
            title: "Oops.! The Title field is required.",
            description: "Oops.! The Description field is required.",
            map_location: "Oops.! The Map Location field is required.",
            city: "Oops.! The City field is required.",
            state: "Oops.! The State field is required.",
            country: "Oops.! The Country field is required.",
            address: "Oops.! The Address field is required.",
            keyword: "Oops.! The Keywords field is required.",
            content: "Oops.! The Content field is required.",
            regular_price: "Oops.! The Regular Price field is required.",
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
            var btn = $('#addlistingBTN'),
                form = $('#addlistingForm');
            btn.attr('disabled', true);
            btn.html('<i class="mdi mdi-cloud-circle"></i> Saving');
            $.ajax({
                type: "POST",
                processData: false,
                contentType: false,
                url: form.attr('action'),
                data: new FormData(form[0]), // serializes the form's elements.
                success: function(data) {
                    if (parseInt(data.status) == 1) {
                        ajaxMessage(1, data.message);
                        $('#content').val();
                    } else {
                        ajaxMessage(0, data.message);
                    }
                    btn.attr("disabled", false);
                    form[0].reset();
                    $('#content').summernote('reset');
                    btn.html('<i class="mdi mdi-cloud-upload"></i> Save');
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
                    btn.html('<i class="mdi mdi-cloud-upload"></i> Save');
                }
            });

            return false;
        }
    });
}

//Update Listing Validation
function updateValidation() {
    $('#updatelistingForm').validate({
        rules: {
            'title' : 'required',
            'description' : 'required',
            'map_location' : 'required',
            'city' : 'required',
            'state' : 'required',
            'regular_price' : 'required',
            'country' : 'required',
            'address' : 'required',
            'content' : 'required',
            'keyword' : 'required',
        },
        messages: {
            title: "Oops.! The Title field is required.",
            description: "Oops.! The Description field is required.",
            map_location: "Oops.! The Map Location field is required.",
            regular_price: "Oops.! The Regular Price field is required.",
            city: "Oops.! The City field is required.",
            state: "Oops.! The State field is required.",
            country: "Oops.! The Country field is required.",
            address: "Oops.! The Address field is required.",
            keyword: "Oops.! The Keywords field is required.",
            content: "Oops.! The Content field is required.",
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
            var btn = $('#updatelistingBTN'),
                form = $('#updatelistingForm');
            btn.attr('disabled', true);
            btn.html('<i class="mdi mdi-cloud-circle"></i> Saving');
            $.ajax({
                type: "POST",
                processData: false,
                contentType: false,
                url: form.attr('action'),
                data: new FormData(form[0]), // serializes the form's elements.
                success: function(data) {
                    if (parseInt(data.status) == 1) {
                        ajaxMessage(1, data.message);
                        $('#image').html(data.img);
                    } else {
                        ajaxMessage(0, data.message);
                    }
                    btn.attr("disabled", false);
                    btn.html('<i class="mdi mdi-cloud-upload"></i> Save');
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
                    btn.html('<i class="mdi mdi-cloud-upload"></i> Save');
                }
            });
            return false;
        }
    });
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
            e.html('<i class="mdi mdi-cloud-circle"></i> Deleting');
            $.ajax({
                type: "DELETE",
                url: url,
                data: {

                },
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
        data: {

        },
        success: function(data) {
            $('#ajax_data_table').html(data);
            loadDataTable();
        },
        error: function(data) {
            ajaxMessage(0, "Something went wrong.!");
        }
    });
}

function changeStatus(e) {
    var url = e.attr('href');
    $.ajax({
        type: "put",
        url: url,
        data: {},
        success: function(data) {
            ajaxMessage(1, data.message);
        },
        error: function(data) {
            ajaxMessage(0, "Something went wrong.!");
        }
    });
}