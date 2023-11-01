/////////////////////// VIEW COMPLETE DETAILS /////////////////////////////
$(document).on('click', '#viewTableButton', function () {
    var id = $(this).data('val');
    // alert(id);
    console.log(id);
    var action = 'viewRecord';

    $.ajax({
        url: 'http://localhost/blackCoffer/api/table.php',
        method: 'POST',
        data: { action: action, id: id },
        success: function (data) {
            if (data.status === 200) {
                // console.log(data.data)
                var dataList = data.data;

                var listHtml = '<ul>';
                dataList.forEach(function (item) {
                    listHtml += '<li> <h5> Title : </h5>' + item.title + '</li>';
                    listHtml += '<li> <h5> Topic : </h5>' + item.topic + '</li>';
                    listHtml += '<li> <h5> Insight : </h5>' + item.insight + '</li>';
                    listHtml += '<li> <h5> Sector : </h5>' + item.sector + '</li>';
                    listHtml += '<li> <h5> Pestle : </h5>' + item.pestle + '</li>';
                    listHtml += '<li> <h5> Timeline : </h5>' + item.start_year + ' - ' + item.end_year + '</li>';
                    listHtml += '<li> <h5> Added : </h5>' + item.added + '</li>';
                    listHtml += '<li> <h5> Published : </h5>' + item.published + '</li>';
                    listHtml += '<li> <h5> Region : </h5>' + item.region + '</li>';
                    listHtml += '<li> <h5> Country : </h5>' + item.country + '</li>';
                    listHtml += '<li> <h5> City : </h5>' + item.city + '</li>';
                    listHtml += '<li> <h5> Source : </h5>' + item.source + '</li>';
                    listHtml += '<li class="url-link"><h5>URL: <a href="' + item.url + '" target="_blank">' + item.url + '</a></h5></li>';
                    listHtml += '<li> <h5> SWOT : </h5>' + item.swot + '</li>';
                    listHtml += '<li> <h5> Impact : </h5>' + item.impact + '</li>';
                    listHtml += '<li> <h5> Relevance : </h5>' + item.relevance + '</li>';
                    listHtml += '<li> <h5> Intensity : </h5>' + item.intensity + '</li>';
                    listHtml += '<li> <h5> Likelihood : </h5>' + item.likelihood + '</li>';
                });
                listHtml += '</ul>';

                $('#recordDetails').html(listHtml);
                $('#viewTable').modal('show');
            } else {
                alert(data.message);
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            console.error("An error occurred:", errorThrown);
        },
    });
});