<?php include_once('./include/header.php'); ?>


<body>

    <!----------------------- SideBar ---------------------->
    <?php include_once('./include/sidebar.php');   ?>

    <!----------------MAIN SECTION ----------------------------->
    <div class="main">

        <!------------- Top Search Bar ---------------------->
        <?php include_once('./include/topsearch.php'); ?>

        <!------------- COUNTING AREA ------------------->
        <?php include_once('./include/countingarea.php'); ?>

 
        <!-- CHARTS -->
        <div class="charts">
            <div class="chart" style="margin: 10px; width: 100%;">
                <h1 style="font-size: 25px; text-align: center; padding: 10px;">Intensity over start years</h1>
                <div>
                    <canvas id="intensity"></canvas>
                </div>
            </div>

            <div class="chart" style="margin: 10px; width: 100%;">
                <h1 style="font-size: 25px; text-align: center; padding: 10px;">Relevance over end years</h1>
                <div style="height: 300px;">
                    <canvas id="relevance"></canvas>
                </div>
            </div>

            <div class="chart" style="margin: 10px; width: 100%;">
                <h1 style="font-size: 25px; text-align: center; padding: 10px;">Likelihood over Topics</h1>
                <div>
                    <canvas id="likelihood"></canvas>
                </div>
            </div>

            <div class="chart">
                <div class="cities" style="margin: 10px;">
                    <h1 style="font-size: 25px; text-align: center; padding: 10px;">Cities</h1>
                    <canvas id="cities"></canvas>
                </div>
            </div>

            <div class="chart">
                <div class="regions" style="margin: 10px;">
                    <h1 style="font-size: 25px; text-align: center; padding: 10px;">Regions</h1>
                    <canvas id="regions"></canvas>
                </div>
            </div>

            <div class="chart countries" style="margin: 10px; margin-top: 60px; width: 100%;">
                <h1 style="font-size: 25px; text-align: center; padding: 10px;">Countries</h1>
                <div>
                    <div id="map" style="width: 100%; height: 500px"></div>
                    <!-- <div id="map"></div> -->
                </div>
            </div>

        </div>

    </div>

    <!-- Chart.js Link -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- World Map Links -->
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://cdn.leafletjs.com/leaflet-0.7.1/leaflet.js"></script>

    <!-- Custom JS Script for Charts-->
    <script src="./assets/js/charts.js"></script>

    <!-- Custom JS Script for Counting Data -->
    <script src="./assets/js/countingdata.js"></script>


    <script>
        //MenuToggle
        let toggle = document.querySelector('.toggle');
        let navigation = document.querySelector('.navigation');
        let main = document.querySelector('.main');

        toggle.onlick = function () {
            navigation.classList.toggle('active');
            main.classList.toggle('active');
        }
        // add hovered class in selected list item
        let list = document.querySelectorAll('.navigation li');
        function activelink() {
            list.forEach((item) =>
                item.classList.remove('hovered'));
            this.classList.add('hovered')
        }
        list.forEach((item) =>
            item.addEventListener('mouseover', activelink));

    </script>
</body>

</html>