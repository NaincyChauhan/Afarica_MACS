$(function() {
    $('#registerform').validate({
        rules: {
            name: "required",
            address: "required",
            email: "required",
            mobile: "required",
            password: "required",
            password_confirmation: "required",
        },
        messages: {
            name: "Oops.! The name field is required.",
            address: "Oops.! The Address field is required.",
            email: "Oops.! The email field is required.",
            mobile: "Oops.! The mobile field is required.",
            password: "Oops.! The Password field is required.",
            password_confirmation: "Oops.! The Confirm Password field is required.",
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
            var btn = $('#signupnowBtn'),
                form = $('#registerform');
            btn.attr('disabled', true);
            btn.html('Requesting <i class="mdi mdi-cloud-circle"></i>');
            $.ajax({
                type: "POST",
                processData: false,
                contentType: false,
                url: form.attr('action'),
                data: new FormData(form[0]), // serializes the form's elements.
                success: function(data) {
                    if (parseInt(data.status) == 1) {
                        ajaxMessage(1, data.message);
                        if (data.type != 1) {
                            $('#verify-otp').show();
                        } else {
                            form[0].reset();
                            location.reload();
                        }
                    } else {
                        ajaxMessage(0, data.message);
                    }
                    btn.attr("disabled", false);
                    // form[0].reset();
                    btn.html('Submit');
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
                    btn.html('Add');
                }
            });

            return false;
        }
    });
});

$(function() {
    $('#LogInnowForm').validate({
        rules: {
            email: "required",
            password: "required",
        },
        messages: {
            email: "Oops.! The email field is required.",
            password: "Oops.! The Password field is required.",
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
            var btn = $('#logInnowBtn'),
                form = $('#LogInnowForm');
            btn.attr('disabled', true);
            btn.html('Requesting <i class="mdi mdi-cloud-circle"></i>');
            $.ajax({
                type: "POST",
                processData: false,
                contentType: false,
                url: form.attr('action'),
                data: new FormData(form[0]), // serializes the form's elements.
                success: function(data) {
                    if (parseInt(data.status) == 1) {
                        // ajaxMessage(1, data.message);
                        form[0].reset();
                        location.reload();
                    } else {
                        ajaxMessage(0, data.message);
                    }
                    btn.attr("disabled", false);
                    btn.html('Login');
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
                    btn.html('Add');
                }
            });

            return false;
        }
    });
});

function resendOTP($this) {
    var btn = $('#signupnowBtn'),
        form = $('#registerform');
    btn.attr('disabled', true);
    btn.html('Requesting <i class="mdi mdi-cloud-circle"></i>');
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
            btn.html('Submit');
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
            btn.html('Add');
        }
    });
}

function ShowSignUpForm() {
    $('#logInModal').modal('hide');
    $('#signUpModal').modal('show');
}
function ShowLogInForm() {
    $('#signUpModal').modal('hide');
    $('#logInModal').modal('show');
}