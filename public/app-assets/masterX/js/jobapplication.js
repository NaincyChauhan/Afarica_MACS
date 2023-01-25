function callStatusModal($url)
{            
    $('#ChangeApplicationStatus').attr('action', $url);
    $('#statusApplication').modal('show');
}

// Validate
$(function () {
    //Status
    $('#ChangeApplicationStatus').validate(
        {
            rules: {
                status: "required",
            },
            messages: {
                status: "Oops.! The Status field is required.",
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
            submitHandler: function (f) {
                var btn = $('#request-btn-status'), form = $('#ChangeApplicationStatus');
                btn.attr('disabled', true);
                btn.html('Requesting <i class="mdi mdi-cloud-circle"></i>');                    
                $.ajax({
                    type: "POST",
                    processData: false,
                    contentType: false,
                    url: form.attr('action'),
                    data: new FormData(form[0]), // serializes the form's elements.
                    success: function (data) {
                        if (parseInt(data.status) == 1) {
                            loadAjaxTable();
                            ajaxMessage(1, data.message);
                        } else {
                            ajaxMessage(0, data.message);
                        }
                        btn.attr("disabled", false);
                        form[0].reset();
                        btn.html('<i class="mdi mdi-plus-circle-outline"></i> Update');
                        $('#statusApplication').modal('hide');
                    },
                    error: function (data) {
                        var msg = data.responseJSON.message, error = "<ul>";

                        $.each(data.responseJSON.errors, function (key, value) {
                            error += "<li>" + value + "</li>";
                        });
                        error += "</ul>";
                        errorsHTMLMessage(msg + "<br>" + error);
                        btn.attr("disabled", false);
                        btn.html('<i class="mdi mdi-plus-circle-outline"></i> Update');
                    }
                });

                return false;
            }
    });   
});

// Load Table With Ajax
function loadAjaxTable() {
    $.ajax({
        type: "GET",
        url: $('#shivadatatable').attr('load-url'),
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
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

// Delete Application With Ajax
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
                    "_token": $('meta[name="csrf-token"]').attr('content'),
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

$(".filter").on("change",function(){
    var name = $('#assignFilter').val();
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
    $.ajax({
        type:'get',
        url:$('#FilterRow').val(),
        data:{
                "_token": "{{ csrf_token() }}",
                name:name,
                from_date:from_date,
                to_date:to_date,
            },

        success:function(data) 
        {
            
            if ($.fn.DataTable.isDataTable('#shivadatatable')) {
            $('#shivadatatable').dataTable().fnClearTable();
            $('#shivadatatable').dataTable().fnDestroy();
            }
            $('#shivadatatable tbody').html(data);
            loadDataTable();
        },
        error:function(error)
        {
            ajaxMessage(0, "Something went wrong.!");
        }
    });
});