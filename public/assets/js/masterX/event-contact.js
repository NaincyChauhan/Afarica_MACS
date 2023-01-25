    $('#contact-form-main1').validate({
        rules: {
            name: "required",
            email: "required",
            mobile: "required",
            message: "required",
        },
        messages: {
            name: "Oops.! The name field is required.",
            email: "Oops.! The Email Address is required.",
            mobile: "Oops.! The  Phone is required.",
            message: "Oops.! The Message field is required.",
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
            var form = $('#contact-form-main1');
            var btn = $('#contact-btn-main');
            btn.attr('disabled', true);
            btn.html('Sending...');

            $.ajax({
                type: 'POST',
                processData: false,
                contentType: false,
                url: form.attr('action'),
                data: new FormData(form[0]),

                success: function (data) {
                    if (parseInt(data.status) == 1) {
                        ajaxMessage(1, data.message);                        
                    } else {
                        ajaxMessage(0, data.message);
                    }
                    btn.attr('disabled', false);
                    btn.html('Submit');
                    form[0].reset();
                },
                error: function (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops! 😯',
                        text: 'Something went wrong.',
                    });
                    btn.attr('disabled', false);
                    btn.html('Submit');
                }
            });
            return false;
        }
    });