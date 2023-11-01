<?php include_once('../../include/header.php');  ?>

<body>

    <!-- VIEW MODAL -->

    <!-- Modal Starts -->
    <div class="modal fade" id="viewTable" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="viewTableLabel">More Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="recordDetails">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Ends -->

    <!----------------------- SideBar ---------------------->
    <?php include_once('../../include/sidebar.php'); ?>

    <!----------------MAIN SECTION ----------------------------->
    <div class="main">
        <!------------- Top Search Bar ---------------------->
        <?php include_once('../../include/topsearch.php'); ?>

        <!-- Admin Content -->
        <div class="admin-content">

            <div class="content">
                <h2 class="page-title">PEST</h2>

                <!-- View button for Testing -->
                <!-- <button type="button" data-val="${row.id}" class="btn btn-primary" id="viewTableButton" data-bs-toggle="modal" data-bs-target="#viewTable">
                    <i class="fa-regular fa-eye" style="font-size: 15px;"></i> View
                </button> -->

                <!-- TABLE PART -->
                <div class="row">

                    <!-- Search For Records starts -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>Search for Records</strong>
                        </div>
                        <div class="panel-body">
                            <form method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="record" name="record"
                                        placeholder="Enter Title">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Search For Records ends -->


                    <!-- Table starts -->
                    <table class="table  table-striped">
                        <h5 style="margin: 10px;">List of Records</h5>
                        <thead>
                            <tr style=" color: #fff; background-color: #4683de;">
                                <th style="width: 45%">Title</th>
                                <th style="width: 10%">Topic</th>
                                <th style="width: 5%">Year</th>
                                <th style="width: 10%">Pestle
                                    <ul class="headItem">
                                        <li class="dropdown">
                                            <a href="#" data-bs-toggle="dropdown" class="dropdown-toggle">
                                                <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-pestle"
                                                style="padding: 0px 0px 0px 30px; overflow-y: auto; height: 250px; width: 300px;">
                                                <!-- Apply Button -->
                                                <div class="modal-footer" style="margin-top: 10px; margin-right: 10px;">
                                                    <button class="btn btn-primary btn-sm" type="submit"
                                                        id="findPestle">
                                                        Apply
                                                    </button>
                                                </div>

                                            </ul>
                                        </li>
                                    </ul>
                                </th>
                                <th style="width: 10%">Published</th>
                                <th style="width: 10%">View</th>
                            </tr>
                        </thead>

                        <tbody id="post-list">

                        </tbody>

                    </table>
                    <!-- Table Ends -->


                    <!-- Pagination -->
                    <div id="pagination_link"></div>

                </div>
            </div>

        </div>

    </div>

    <!-- Bootstrap JS Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Jquery Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Custom Script -->
    <script src="../js/script.js"></script>

    <!-- Filter Script -->
    <script src="../js/pestle.js"></script>

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