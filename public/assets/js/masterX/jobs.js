$('#change_data_show_number').on('change', function() {
    ajaxFilter($(this).attr('url') + "?show=" + $(this).val() + "&type=" + $(this).attr('job-type'));
});

// Sort Listing 
$('#data_sort_filter').on('change', function() {
    ajaxFilter($(this).attr('url') + "?short_type=" + $(this).val() + "&type=" + $(this).attr('job-type'));
});


$(document).ready(function(){
    var url = $('#search-url').val();
    var Jobtype = $('#job-type').val();
    var value;
    $("input[name='RattingRadioDefault']:radio").change(function(){
        value = $("[name=RattingRadioDefault]:checked").val();
        ajaxFilter(url + "?ratting="+value+ "&type=" + Jobtype);
    });
    $("input[name='ShowingRadioDefault']:radio").change(function(){
        value = $("[name=ShowingRadioDefault]:checked").val();
        ajaxFilter(url + "?show=" + value + "&type=" + Jobtype);
    });
    $("input[name='ShortingRadioDefault']:radio").change(function(){
        value = $("[name=ShortingRadioDefault]:checked").val();
        console.log("this is value",value,$("[name=ShortingRadioDefault]:checked").val());
        ajaxFilter(url + "?short_type=" + value + "&type=" + Jobtype);
    });
});

function ajaxFilter(url, data = null) {
    //Add Preloader       
    $('#listing-data').hide();
    $('#loading-area').show();

    $.ajax({
        method: 'GET',
        url: url,
        data: data,
        contentType: "application/json; charset=utf-8",
        success: function(data) {
            // console.log("this is return data",data);
            $('#listing-data').html(data);
            $('#loading-area').hide();
            $('#listing-data').show();
        },
        error: function(jqXhr, textStatus, errorMessage) {
            // error callback
            $('#listing-data').hide();
            $('#loading-area').show();
            console.log("this is error", errorMessage);
        }
    });
}