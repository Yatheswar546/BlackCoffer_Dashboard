$(document).ready(function () {
    $.ajax({
        url: "http://localhost/blackCoffer/api/countingData.php",
        method: "GET",
        dataType: "json",
        success: function (data) {

            if (data.status === 200) {
            //    console.log(data.totalcounts)
            //    console.log(typeof(data.totalcounts))

               const topicsCount = data.totalcounts.distinct_topic_count;
               const sectorsCount = data.totalcounts.distinct_sector_count;
               const regionsCount = data.totalcounts.distinct_region_count;
               const countriesCount = data.totalcounts.distinct_country_count;

                $('#Topics').text(topicsCount);
                $('#Sectors').text(sectorsCount);
                $('#Regions').text(regionsCount);
                $('#Countries').text(countriesCount);
                
            } else {
                $('#cardBox').html('<h5>Records not Found</h5>');
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            console.error("An error occurred:", errorThrown);
        },
    });
});