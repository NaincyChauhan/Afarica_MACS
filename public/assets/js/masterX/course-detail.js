function showVideo(e) {
    $('#watchcoursecontentvideo').modal('show');
}

$(document).ready(function(){
    // Check Radio-box
    $(".ratting input:radio").attr("checked", false);

    $('.ratting input').click(function () {
        $(".ratting span").removeClass('checked');
        $(this).parent().addClass('checked');
    });

    $('input:radio').change(
    function(){
        var userratting = this.value;
        document.getElementById('ratting').value = userratting;
    }); 
});

function showRattingForm(e) {
    $('#RattingForm').show();
    $(e).hide();
}

$('#watchcoursecontentvideo').on('hidden.bs.modal', function () {
    $('#video-iframe').attr('src', $('#video-iframe').attr('src'));
})



function CheckOutForm(transaction_status, transaction_id) {
    $('#transaction_status').val(transaction_status);
    $('#transaction_id').val(transaction_id);
    $('#courseBuyForm').submit();   
}

// Getting Course Review
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "GET",
        url: window.location.origin+'/course/review/'+$('#course_id').val(),
        data: [], 
        success: function(data) {
            $('#listing-data').html(data)           
        },
        error: function(data) {
            var msg = data.responseJSON.message,
                error = "<ul>";

            $.each(data.responseJSON.errors, function(key, value) {
                error += "<li>" + value + "</li>";
            });
            error += "</ul>";
            errorsHTMLMessage(msg + "<br>" + error);
        }
    });
});


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
                    value: $('#total_price').val()
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
                CheckOutForm(transaction.status, transaction.id);
                $('#CheckOutModal').modal('hide');
            // }
        });
    }
}).render('#paypal-button-container');