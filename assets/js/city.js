/////////////////////// PAGINATION /////////////////////////////
load_data(query = '', page_number = 1);

function load_data(query = '', page_number = 1) {

    var form_data = new FormData();

    form_data.append('query', query);

    form_data.append('page', page_number);

    var ajax_request = new XMLHttpRequest();

    ajax_request.open('POST', '../../backend/pagination.php');

    ajax_request.send(form_data);

    ajax_request.onreadystatechange = function () {
        if (ajax_request.readyState == 4 && ajax_request.status == 200) {
            var response = JSON.parse(ajax_request.responseText);

            var html = '';

            var serial_no = 1;

            if (response.data.length > 0) {
                for (var count = 0; count < response.data.length; count++) {
                    var date = new Date(response.data[count].year);

                    var formattedDate = new Intl.DateTimeFormat('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: '2-digit',
                    }).format(date);

                    html += '<tr>';
                    html += '<td>' + response.data[count].title + '</td>';
                    html += '<td>' + response.data[count].topic + '</td>';
                    html += '<td>' + response.data[count].year + '</td>';
                    html += '<td>' + response.data[count].city + '</td>';
                    html += '<td>' + formattedDate + '</td>';
                    html += '<td>' + response.data[count].view + '</td>';
                    html += '</tr>';
                    serial_no++;
                }
            }
            else {
                html += '<tr><td colspan="3" class="text-center">No Data Found</td></tr>';
            }

            document.getElementById('post-list').innerHTML = html;

            document.getElementById('pagination_link').innerHTML = response.pagination;

        }

    }
}

/////////////////////// SEARCH BY TITLE /////////////////////////////
$(document).ready(function () {
    $('#record').keyup(function (event) {
        event.preventDefault();
        var action = 'searchRecord';
        var title = $('#record').val();

        if (record !== '') {
            $.ajax({
                url: "http://localhost/blackCoffer/api/table.php",
                method: "POST",
                dataType: "json",
                data: { action: action, title: title },
                success: function (data) {

                    if (data.status === 200) {
                        // Clear the existing list
                        $('#post-list').empty();
                        // Append the new data
                        $.each(data.data, function (index, row) {

                            const date = new Date(row.end_year);

                            const formattedDate = new Intl.DateTimeFormat('en-US', {
                                year: 'numeric',
                                month: 'long',
                                day: '2-digit',
                            }).format(date);

                            $('#post-list').append(`
                                <tr>
                                    <td>${row.title}</td>
                                    <td>${row.topic}</td>
                                    <td>${row.end_year}</td>
                                    <td>${row.city}</td>
                                    <td>${formattedDate}</td>
                                    <td>
                                        <button type="button" data-val="${row.id}" class="btn btn-secondary" id="viewTableButton" data-bs-toggle="modal" data-bs-target="#viewTable">
                                            <i class="fa-regular fa-eye" style="font-size: 15px;"></i> View
                                        </button>
                                    </td>
                                </tr>
                            `);
                        });
                    } else {
                        $('#post-list').html('<h5>Records not Found</h5>');
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error("An error occurred:", errorThrown);
                },
            });
        }
    });
});




///////////////////////////////////// FILTERING ///////////////////////////////////////
/////////////////////// FETCH CITIES /////////////////////////////
// Function to fetch city from the API
function fetchCities(callback) {
    fetch('http://localhost/blackCoffer/api/city.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        },
    })
        .then((response) => response.json())
        .then((data) => {
            callback(data);
        })
        .catch((error) => console.error('Error:', error));
}

// Function to initialize the topic dropdown
function initializeTopicDropdown(cities) {
    const topicDropdown = document.querySelector('.dropdown-menu-city');

    if (cities && cities.data && cities.data.length > 0) {
        cities.data.forEach((city) => { 
            const listItem = document.createElement('li');
            listItem.style.color = '#333';
            listItem.style.fontSize = '12px';

            const label = document.createElement('label');
            label.className = 'checkbox';

            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'city';
            checkbox.value = city.city;
            checkbox.id = 'check';

            const topicText = document.createTextNode(city.city);

            label.appendChild(checkbox);
            label.appendChild(topicText);
            listItem.appendChild(label);
            topicDropdown.appendChild(listItem);
        });
    } else {
        topicDropdown.innerHTML = 'No Data Found';
    }
}

fetchCities(initializeTopicDropdown);

/////////////////////// FETCH RECORDS BY CITIES /////////////////////////////
$(document).ready(function () {
    $('#findCity').click(function (event) {
        event.preventDefault();
        var action = 'searchCity';
        var arr = [];
        $.each($("input[name='city']:checked"), function () {
            arr.push($(this).val());
        });
        
        if (record !== '') {
            $.ajax({
                url: "http://localhost/blackCoffer/api/table.php",
                method: "POST",
                dataType: "json",
                data: { action: action, arr: arr },
                success: function (data) {
                    if (data.status === 200) {
                        // Clear the existing list
                        $('#post-list').empty();
                        // Append the new data
                        $.each(data.data, function (index, row) {

                            const date = new Date(row.end_year);

                            const formattedDate = new Intl.DateTimeFormat('en-US', {
                                year: 'numeric',
                                month: 'long',
                                day: '2-digit',
                            }).format(date);

                            $('#post-list').append(`
                                <tr>
                                    <td>${row.title}</td>
                                    <td>${row.topic}</td>
                                    <td>${row.end_year}</td>
                                    <td>${row.city}</td>
                                    <td>${formattedDate}</td>
                                    <td>
                                        <button type="button" data-val="${row.id}" class="btn btn-secondary" id="viewTableButton" data-bs-toggle="modal" data-bs-target="#viewTable">
                                            <i class="fa-regular fa-eye" style="font-size: 15px;"></i> View
                                        </button>
                                    </td>
                                </tr>
                            `);
                        });
                    } else {
                        $('#post-list').html('<h5>Records not Found</h5>');
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error("An error occurred:", errorThrown);
                },
            });
        }
    });
});