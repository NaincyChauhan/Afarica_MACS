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

// Save Job Validation
function addValidation() {
    $('#addJobForm').validate({
        rules: {
            title: "required",
            image: "required",
            keywords: "required",
            description: "required",
            location: "required",
            company_name: "required",
            position: "required",
            job_type: "required",
            salary: "required",
            experience: "required",
            qualification: "required",
            no_of_vacancy: "required",
            type: "required",
        },
        messages: {
            title: "Oops.! The Title field is required.",
            image: "Oops.! The Title field is required.",
            keywords: "Oops.! The Keyword field is required.",
            description: "Oops.! The Description field is required.",
            location: "Oops.! The Title Location is required.",
            company_name: "Oops.! The Company Name field is required.",
            position: "Oops.! The Position field is required.",
            job_type: "Oops.! The Job Type field is required.",
            salary: "Oops.! The Salary field is required.",
            experience: "Oops.! The Experience field is required.",
            qualification: "Oops.! The Eualification field is required.",
            no_of_vacancy: "Oops.! The Title field is required.",
            type: "Oops.! The Title No Of Vacancy is required.",
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
            var btn = $('#addJobBTN'),
                form = $('#addJobForm');
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

//Update Job Validation
function updateValidation() {
    $('#updateJobForm').validate({
        rules: {
            title: "required",
            keywords: "required",
            description: "required",
            location: "required",
            company_name: "required",
            position: "required",
            job_type: "required",
            salary: "required",
            experience: "required",
            qualification: "required",
            no_of_vacancy: "required",
            type: "required",
        },
        messages: {
            title: "Oops.! The Title field is required.",
            keywords: "Oops.! The Keyword field is required.",
            description: "Oops.! The Description field is required.",
            location: "Oops.! The Title Location is required.",
            company_name: "Oops.! The Company Name field is required.",
            position: "Oops.! The Position field is required.",
            job_type: "Oops.! The Job Type field is required.",
            salary: "Oops.! The Salary field is required.",
            experience: "Oops.! The Experience field is required.",
            qualification: "Oops.! The Eualification field is required.",
            no_of_vacancy: "Oops.! The Title field is required.",
            type: "Oops.! The Title No Of Vacancy is required.",
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
            var btn = $('#updateJobBTN'),
                form = $('#updateJobForm');
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
        url:$('#shivadatatable').attr('load-url'),
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
        type: "PUT",
        url: url,
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            ajaxMessage(1, data.message);
        },
        error: function(data) {
            ajaxMessage(0, "Something went wrong.!");
        }
    });
}