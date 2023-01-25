$('.carousel').carousel({
    interval: false,
});
$(function () {
    $('#enquiryNowForm').validate({
        rules: {
            name: "required",
            email: "required",
            mobile: "required",
            address: "required",
        },
        messages: {
            name: "Oops.! The name field is required.",
            email: "Oops.! The Email Address is required.",
            mobile: "Oops.! The  Phone is required.",
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
            
            var form = $('#enquiryNowForm');
            var btn = $('#enquiryNowBtn');
            btn.attr('disabled', true);
            btn.html('Sending...');
            $.ajax({
                type: "POST",
                processData: false,
                contentType: false,
                url: form.attr('action'),
                data: new FormData(form[0]), // serializes the form's elements.
                success: function(data) {
                    if (parseInt(data.status) == 1) {
                        ajaxMessage(1, data.message);
                        $('#enquiryNowModal').modal('hide');
                    } else {
                        ajaxMessage(0, data.message);
                    }
                    btn.attr("disabled", false);
                    form[0].reset();
                    btn.html('Submit <i class="fas fa-arrow-right ps-3"></i>');
                },
                error: function (data) {
                    var msg = data.responseJSON.message,
                    error = "<ul>";
    
                    $.each(data.responseJSON.errors, function(key, value) {
                        error += "<li>" + value + "</li>";
                    });
                    error += "</ul>";
                    errorsHTMLMessage(msg + "<br>" + error);
                    btn.attr("disabled", false);
                    btn.html('Submit <i class="fas fa-arrow-right ps-3"></i>');
                }
            });

            return false;
        }
    });
});