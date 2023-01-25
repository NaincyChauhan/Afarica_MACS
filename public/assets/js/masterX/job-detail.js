$(function () {    
    $('#applynowForm').validate({
        rules: {
            name: "required",
            email: "required",
            mobile: "required",
            resume: "required",
            expected_sallry: "required",
            total_experience: "required",
            current_sallry: "required",
            address: "required",
        },
        messages: {
            name: "Oops.! The Name Field is required.",
            email: "Oops.! The Email Address Field is required.",
            mobile: "Oops.! The  Phone Number Field is required.",
            resume: "Oops.! The Resume Field is required.",
            expected_sallry: "Oops.! The Expected Sallry Field is required.",
            total_experience: "Oops.! The Total Experience Field is required.",
            current_sallry: "Oops.! The Current Sallry Field is required.",
            address: "Oops.! The Address Field is required.",
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {                
            var btn = $('#applynowBtn');
            var form = $('#applynowForm');
            btn.attr('disabled', true);
            btn.html('<i class="mdi mdi-cloud-circle"></i> Sending...');
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
                    $('#applyNowModal').modal('hide');
                    btn.attr("disabled", false);
                    form[0].reset();
                    btn.html('<i class="mdi mdi-cloud-upload"></i> Submit');
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
                    btn.html('<i class="mdi mdi-cloud-upload"></i> Submit');
                }
            });
            return false;
        }
    });
});