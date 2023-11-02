document.addEventListener('DOMContentLoaded', function () {
    // Function to make an AJAX request to fetch data
    function fetchData(action, callback) {
        fetch('http://localhost/blackCoffer/api/chart.php?action=' + action, {
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

    // Function to initialize charts using the fetched data
    function initializeCharts(data) {

        /////////////////// Intensity Graph ///////////////////
        if (data.action === 'intensities') {

            const startYears = data.start_years;
            const intensity = data.intensity;

            const intensityChart = document.getElementById('intensity');
            new Chart(intensityChart, {
                type: 'bar',
                data: {
                    labels: startYears,
                    datasets: [{
                        label: 'Intensity',
                        data: intensity,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        /////////////////// Relevance Graph ///////////////////
        if (data.action === 'relevance') {

            const endYears = data.end_years;
            const relevance = data.relevance;

            const relevanceChart = document.getElementById('relevance');
            new Chart(relevanceChart, {
                type: 'bar',
                data: {
                    labels: endYears,
                    datasets: [{
                        label: 'Relevance',
                        data: relevance,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        /////////////////// Likelihood Graph ///////////////////
        if (data.action === 'likelihood') {

            const topics = data.topics;
            const likelihood = data.likelihood;

            const likelihoodChart = document.getElementById('likelihood');

            new Chart(likelihoodChart, {
                type: 'line',
                data: {
                    labels: topics,
                    datasets: [{
                        label: 'Likelihood',
                        data: likelihood,
                        fill: false,
                        borderColor: 'rgb(54, 162, 235)',
                        tension: 0.1
                    }]
                },
            });
        }

        /////////////////// City Chart ///////////////////

        if (data.action === 'cities') {

            const cities = [];
            const cityCounts = [];

            if (data.city && data.city.length > 0) {
                data.city.forEach(cityData => {
                    cities.push(cityData.city);
                    cityCounts.push(cityData.count);
                });
            }

            const cityChart = document.getElementById('cities');

            new Chart(cityChart, {
                type: 'pie',
                data: {
                    labels: cities,
                    datasets: [{
                        label: 'Cities',
                        data: cityCounts,
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(153, 102, 255)',
                            'rgb(255, 159, 64)',
                            'rgb(201, 203, 207)',
                            'rgb(255, 0, 0)',
                            'rgb(0, 128, 0)',
                            'rgb(0, 0, 255)',
                            'rgb(128, 0, 128)'
                        ],
                        hoverOffset: 4
                    }]
                },
            });

        }

        /////////////////// Region Chart ///////////////////
        if (data.action === 'regions') {

            const regions = [];
            const regionCounts = [];

            if (data.region && data.region.length > 0) {

                data.region.forEach(regionData => {
                    regions.push(regionData.region);
                    regionCounts.push(regionData.count);
                });

            }

            const regionChart = document.getElementById('regions');

            new Chart(regionChart, {
                type: 'pie',
                data: {
                    labels: regions,
                    datasets: [{
                        label: 'Cities',
                        data: regionCounts,
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(153, 102, 255)',
                            'rgb(255, 159, 64)',
                            'rgb(201, 203, 207)',
                            'rgb(255, 0, 0)',
                            'rgb(0, 128, 0)',
                            'rgb(0, 0, 255)',
                            'rgb(128, 0, 128)'
                        ],
                        hoverOffset: 4
                    }]
                },
            });
        }

        /////////////////// Country Map ///////////////////
        if (data.action === 'countries') {

            try {

                const countries = data.country;

                const countriesData = [];

                for (const key in countries) {
                    if (countries.hasOwnProperty(key)) {
                        countriesData.push(countries[key]);
                    }
                }

                var myGeoJSONPath = 'mymap.geo.json';

                var map = L.map('map');

                $.getJSON(myGeoJSONPath, function (geojsonData) {
                    // var map = L.map('map').setView([39.74739, -105], 4);

                    var geoJsonLayer = L.geoJson(geojsonData, {
                        clickable: false,
                        style: function (feature) {

                            const countryName = feature.properties.sovereignt;

                            if (countriesData.includes(countryName)) {
                                return {
                                    fillColor: 'grey',
                                    fillOpacity: 0.4,
                                    weight: 2,
                                    color: 'grey'
                                };
                            } else {
                                return {
                                    fillColor: '#fff',
                                    fillOpacity: 1,
                                    stroke: false,
                                };
                            }
                        },
                    }).addTo(map);

                    // Calculate the bounding box
                    var bounds = geoJsonLayer.getBounds();

                    // Set the initial view to cover the entire bounding box
                    map.fitBounds(bounds);
                })


            } catch (error) {
                console.log('error')
            }

        }
    }

    // Fetch data and initialize charts
    fetchData('intensities', initializeCharts);
    fetchData('relevance', initializeCharts);
    fetchData('likelihood', initializeCharts);
    fetchData('cities', initializeCharts);
    fetchData('regions', initializeCharts);
    fetchData('countries', initializeCharts);

});
