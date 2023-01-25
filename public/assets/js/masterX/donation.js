var form = $('#request-form');
var btn = $('#request-btn');
form.validate({
    rules: {
        first_name: "required",
        last_name: "required",
        email: "required",
        mobile: "required",
        address: "required",
        amount: "required",
    },
    messages: {
        first_name: "Oops.! The First Name field is required.",
        last_name: "Oops.! The Last Name field is required.",
        email: "Oops.! The Email Address is required.",
        mobile: "Oops.! The  Phone is required.",
        address: "Oops.! The Address field is required.",
        amount: "Oops.! The Amount field is required.",
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
        $('#donationNowModal').modal('show');
        $('#amount_detail').html( "$" + $('#amount').val());
        return false;
    }
});

// Donation Paypal Payment Getway
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
                    value: $('#amount').val()// Can also reference a variable or function
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
                sendDonationForm(transaction.status, transaction.id);
                $('#donationNowModal').modal('hide');
            // }
        });
    }
}).render('#paypal-button-container');

function sendDonationForm(transaction_status, transaction_id) {
    $('#transaction_status').val(transaction_status);
    $('#transaction_id').val(transaction_id);
    btn.attr('disabled', true);
    btn.html('<i class="mdi mdi-cloud-circle"></i> Sending');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
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
            btn.html('Donate');
            form[0].reset();
        },
        error: function (error) {
            var msg = data.responseJSON.message,
                error = "<ul>";

            $.each(data.responseJSON.errors, function(key, value) {
                error += "<li>" + value + "</li>";
            });
            error += "</ul>";
            errorsHTMLMessage(msg + "<br>" + error);
            btn.attr('disabled', false);
            btn.html('Donate');
        }
    });     
}