$(function () {
    $('#contactform').validate({
        rules: {
            name: "required",
            email: "required",
            mobile: "required",
            subject: "required",
            message: "required",
        },
        messages: {
            name: "Oops.! The name field is required.",
            email: "Oops.! The Email Address is required.",
            mobile: "Oops.! The  Phone is required.",
            subject: "Oops.! The  Subject is required.",
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
            $('#submitontact').attr('disabled', true);
            $('#submitontact').html('Sending...');

            $.ajax({
                type: 'POST',
                processData: false,
                contentType: false,
                url: $('#contactform').attr('action'),
                data: new FormData($('#contactform')[0]),

                success: function (data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Hurre.! 😊',
                        text: 'Your request has been recieved. We will ping you back soon.',
                    });
                    $('#submitontact').attr('disabled', false);
                    $('#submitontact').html('Submit');
                    $('#contactform')[0].reset();
                },
                error: function (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops! 😯',
                        text: 'Something went wrong.',
                    });
                    $('#submitontact').attr('disabled', false);
                    $('#submitontact').html('Submit');
                }
            });

            return false;
        }
    });
});