//validate
$(function (){
    $('#request-form').validate(
    {
        rules: {
            old_password: "required",
            new_password: "required",
            confirm_password: "required",
        },
        messages: {
            old_password: "Oops.! The old password field is required.",
            new_password: "Oops.! The new password field is required.",
            confirm_password: "Oops.! The confirm password field is required.",
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
        submitHandler: function(f) {
            var btn = $('#request-btn'), form = $('#request-form');
            btn.attr('disabled', true) ;
            btn.html('Changing <i class="mdi mdi-cloud-circle"></i>');
            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    if(parseInt(data.status) == 1)
                    {
                        ajaxMessage(1, data.message);
                    }else{
                        ajaxMessage(0, data.message);
                    }                     
                    btn.attr("disabled", false);
                    form[0].reset();                            
                    btn.html('Change Password');
                },
                error: function(data) {
                    var msg = data.responseJSON.message, error = "<ul>"; 

                    $.each(data.responseJSON.errors, function(key, value){
                        error += "<li>"+value+"</li>";
                    });
                    error += "</ul>";
                    errorsHTMLMessage(msg+"<br>"+error);
                    btn.attr("disabled", false);
                    btn.html('Change Password');
                }
            });
            return false;
        }
    });
});


//validate
$(function (){
    $('#profile-request-form').validate(
    {
        rules: {
            name: "required",
            email: "required",
            mobile: "required",
            address: "required",
        },
        messages: {
            name: "Oops.! The Name field is required.",
            email: "Oops.! The Email field is required.",
            mobile: "Oops.! The Mobile field is required.",
            address: "Oops.! The Address field is required.",
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
        submitHandler: function(f) {
            var btn = $('#profile-request-btn'), form = $('#profile-request-form');
            btn.attr('disabled', true) ;
            btn.html('Updating <i class="mdi mdi-cloud-circle"></i>');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                processData: false,
                contentType: false,
                url: form.attr('action'),
                data: new FormData(form[0]), // serializes the form's elements.
                success: function(data) {
                    if(parseInt(data.status) == 1)
                    {
                        if (data.img != "") {
                            $('#user-profile').html(data.img);
                        }
                        if (data.profileimage != "") {
                            $('#navbarDropdownProfile').html(data.profileimage);
                        }
                        ajaxMessage(1, data.message);
                    }else{
                        ajaxMessage(0, data.message);
                    }                     
                    btn.attr("disabled", false);
                    btn.html('Update');
                },
                error: function(data) {
                    var msg = data.responseJSON.message, error = "<ul>"; 

                    $.each(data.responseJSON.errors, function(key, value){
                        error += "<li>"+value+"</li>";
                    });
                    error += "</ul>";
                    errorsHTMLMessage(msg+"<br>"+error);
                    btn.attr("disabled", false);
                    btn.html('Update');
                }
            });
            return false;
        }
    });
});