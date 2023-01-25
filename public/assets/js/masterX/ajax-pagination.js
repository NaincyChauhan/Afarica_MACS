//Ajax Paginatio
$(document).one('click', '#ajaxPagination ul li a', function (e) {
    console.log("ajax pagination function is running",$(this).attr("href"),"and",$(e).attr("href"));
    e.preventDefault();
    //Add Preloader      
    $('#listing-data').hide();
    $('#loading-area').show();
    var url = $(this).attr("href")+"&"+ "type=" + $('#data_sort_filter').attr('job-type'),
        data = '';
    e.preventDefault();

    $.ajax({
        method: 'GET',
        url: url,
        data: data,
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            $('#listing-data').html(data);
            $('#loading-area').hide();
            $('#listing-data').show();
        },
        error: function (jqXhr, textStatus, errorMessage) {
            // error callback
            $('#listing-data').hide();
            $('#loading-area').show();
        }
    });
});        