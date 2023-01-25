// Validate Apply Form
var btn = $('#apply-now-btn'),
    form = $('#apply-now-form');
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#apply-now-form').validate({
        rules: {
            name: "required",
            email: "required",
            mobile: "required",
            sort_desc: "required",
            description: "required",
        },
        messages: {
            name: "Oops.! The Name field is required.",
            email: "Oops.! The Email field is required.",
            mobile: "Oops.! The Mobile field is required.",
            sort_desc: "Oops.! The Sort Description field is required.",
            description: "Oops.! The Description field is required.",
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
            $('#applyNowModal').modal('show');
            return false;
        }
    });
});

// Validate Company Fields
$('#company_name').on('change', function(e) {
    var company_name = $('#company_name').val();
    if (company_name != "") {
        $('#designation').attr('required', true);
        $('#company_type').attr('required', true);
    } else {
        $('#designation').attr('required', false);
        $('#company_type').attr('required', false);
    }
})

// Applying Paypal Payment Getway
paypal.Buttons({
    onClick: function() {
        // Show a validation error if the Field is required
        return true;
    },

    // Sets up the transaction when a payment button is clicked
    createOrder: (data, actions) => {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: $('#form_amount').val()// Can also reference a variable or function
                }
            }]
        });
    },
    // Finalize the transaction after payer approval
    onApprove: (data, actions) => {
        return actions.order.capture().then(function(orderData) {
            // Successful capture! For dev/demo purposes:
            const transaction = orderData.purchase_units[0].payments.captures[0];
            // if (transaction.status == 'COMPLETED') {
                // Return When Payment Success
                sendApplyForm(transaction.status, transaction.id);
                $('#applyNowModal').modal('hide');
            // }
        });
    }
}).render('#paypal-button-container');

function sendApplyForm(transaction_status, transaction_id) {
    $('#transaction_status').val(transaction_status);
    $('#transaction_id').val(transaction_id);
    btn.attr('disabled', true);
    btn.html('<i class="mdi mdi-cloud-circle"></i> requesting');

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
            if (parseInt(data.status) == 1) {
                ajaxMessage(1, data.message);
            } else {
                ajaxMessage(0, data.message);
            }
            btn.attr("disabled", false);
            form[0].reset();
            btn.html('Submit <i class="fas fa-arrow-right ps-3"></i>');
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
            btn.html('Submit <i class="fas fa-arrow-right ps-3"></i>');
        }
    });
}