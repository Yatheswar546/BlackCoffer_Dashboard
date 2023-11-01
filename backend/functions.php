<?php

    include_once('../database/database.php');

    ///////////////////////// COUNTING AREA DATA ////////////////////////// 
    function countingData(){

        global $conn;

        try{
            $query = "SELECT COUNT(DISTINCT sector) AS distinct_sector_count, 
                             COUNT(DISTINCT topic) AS distinct_topic_count,
                             COUNT(DISTINCT country) AS distinct_country_count,
                             COUNT(DISTINCT region) AS distinct_region_count 
                        FROM `table 1`";
            $stmt = $conn->query($query);

            if ($stmt) {
                if ($stmt->rowCount() > 0) {
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $distinctCounts = [
                        'distinct_sector_count' => $res[0]['distinct_sector_count'],
                        'distinct_topic_count' => $res[0]['distinct_topic_count'],
                        'distinct_country_count' => $res[0]['distinct_country_count'],
                        'distinct_region_count' => $res[0]['distinct_region_count'],
                    ];

                    $data = [
                        'status'  => 200,
                        'message' => 'Counting Records Fetched Successfully',
                        'totalcounts' => $distinctCounts
                    ];
                    header("HTTP/1.0 200 Records Fetched Successfully");
                    return json_encode($data);
                }else{
                    $data = [
                        'status' => 404,
                        'message' => 'No Record Found',
                    ];
                    header("HTTP/1.0 404 No Record Found");
                    return json_encode($data);
                }
            }
            else{
                $data = [
                    'status' => 500,
                    'message' => 'Internet Server Error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
                return json_encode($data);
            }
        } catch (PDOException $e) {
            $data = [
                'status' => 500,
                'message' => 'Database Error: ' . $e->getMessage(),
            ];
            header("HTTP/1.0 500 Database Error");
            echo json_encode($data);
        }
    }

    ///////////////////////// FETCH COMPLETE DATA ////////////////////////// 
    function fetchData(){

        global $conn;

        try{
            $query = "SELECT * FROM `table 1`";
            $stmt = $conn->query($query);

            if ($stmt) {
                if ($stmt->rowCount() > 0) {
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $data = [
                        'status'  => 200,
                        'message' => 'Records Fetched Successfully',
                        'data'    => $res
                    ];
                    header("HTTP/1.0 200 Records Fetched Successfully");
                    return json_encode($data);
                }else{
                    $data = [
                        'status' => 404,
                        'message' => 'No Record Found',
                    ];
                    header("HTTP/1.0 404 No Record Found");
                    return json_encode($data);
                }
            }
            else{
                $data = [
                    'status' => 500,
                    'message' => 'Internet Server Error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
                return json_encode($data);
            }
        } catch (PDOException $e) {
            $data = [
                'status' => 500,
                'message' => 'Database Error: ' . $e->getMessage(),
            ];
            header("HTTP/1.0 500 Database Error");
            echo json_encode($data);
        }
    }

    ///////////////////////// COMPLETE DATA OF SINGLE RECORD////////////////////////// 
    function fetchCompleteData($id){
        global $conn;

        try{
            $query = "SELECT * FROM `table 1` WHERE id=$id";
            $stmt = $conn->query($query);

            if ($stmt) {
                if ($stmt->rowCount() > 0) {
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $data = [
                        'status'  => 200,
                        'message' => 'Records Fetched Successfully',
                        'data'    => $res
                    ];
                    header("HTTP/1.0 200 Records Fetched Successfully");
                    return json_encode($data);
                }else{
                    $data = [
                        'status' => 404,
                        'message' => 'No Record Found',
                    ];
                    header("HTTP/1.0 404 No Record Found");
                    return json_encode($data);
                }
            }
            else{
                $data = [
                    'status' => 500,
                    'message' => 'Internet Server Error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
                return json_encode($data);
            }
        } catch (PDOException $e) {
            $data = [
                'status' => 500,
                'message' => 'Database Error: ' . $e->getMessage(),
            ];
            header("HTTP/1.0 500 Database Error");
            echo json_encode($data);
        }
    }

    ///////////////////////// TABLE DATA ////////////////////////// 
    function fetchTableData()
    {
        global $conn;

        try {
            $query = "SELECT id, title, topic, end_year, sector, published FROM `table 1` ORDER BY id ASC";
            $stmt = $conn->query($query);

            if ($stmt) {
                if ($stmt->rowCount() > 0) {
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $data = [
                        'status'  => 200,
                        'message' => 'Records Fetched Successfully',
                        'data'    => $res
                    ];
                    header("HTTP/1.0 200 Records Fetched Successfully");
                    return json_encode($data);
                } else {
                    $data = [
                        'status' => 404,
                        'message' => 'No Record Found',
                    ];
                    header("HTTP/1.0 404 No Record Found");
                    return json_encode($data);
                }
            } else {
                $data = [
                    'status' => 500,
                    'message' => 'Internet Server Error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
                return json_encode($data);
            }
        } catch (PDOException $e) {
            $data = [
                'status' => 500,
                'message' => 'Database Error: ' . $e->getMessage(),
            ];
            header("HTTP/1.0 500 Database Error");
            echo json_encode($data);
        }
    }


    /////////////////////// SEARCH BY TITLE /////////////////////////////
    function getRecordListByTitle($title)
    {
        global $conn;

        try {
            $query = "SELECT id, title, topic, end_year, sector, swot, pestle, city, country, region, published FROM `table 1` WHERE title LIKE :title ORDER BY id ASC";
            $stmt = $conn->prepare($query);
            $titleParam = '%' . $title . '%';
            $stmt->bindParam(':title', $titleParam, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $data = [
                    'status' => 200,
                    'message' => 'Records Fetched Successfully',
                    'data' => $res
                ];
                header("HTTP/1.0 200 Records Fetched Successfully");
                return json_encode($data);
            } else {
                $data = [
                    'status' => 404,
                    'message' => 'No Record Found',
                ];
                header("HTTP/1.0 404 No Record Found");
                return json_encode($data);
            }
        } catch (PDOException $e) {
            $data = [
                'status' => 500,
                'message' => 'Database Error: ' . $e->getMessage(),
            ];
            header("HTTP/1.0 500 Database Error");
            echo json_encode($data);
        }
    }


    /////////////////////////////////////////////////////// FILTERING ///////////////////////////////////////////
    /////////////////////// GET TOPCIS /////////////////////////////
    function getTopics() {
        global $conn;
    
        try {
            $query = "SELECT DISTINCT topic FROM `table 1` ORDER BY topic ASC";
            $stmt = $conn->prepare($query);
    
            if ($stmt) {
                if ($stmt->execute()) {
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                    $data = [
                        'status' => 200,
                        'message' => 'Records Fetched Successfully',
                        'data' => $res
                    ];
                    header("HTTP/1.0 200 Records Fetched Successfully");
                } else {
                    $data = [
                        'status' => 404,
                        'message' => 'No Record Found',
                    ];
                    header("HTTP/1.0 404 No Record Found");
                }
            } else {
                $data = [
                    'status' => 500,
                    'message' => 'Internet Server Error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
            }
    
            return json_encode($data); // Return the JSON response after setting headers
        } catch (PDOException $e) {
            $data = [
                'status' => 500,
                'message' => 'Database Error: ' . $e->getMessage(),
            ];
            header("HTTP/1.0 500 Database Error");
    
            return json_encode($data); // Return the JSON response after setting headers
        }
    }

    /////////////////////// SEARCH BY TOPICS /////////////////////////////
    function getRecordListByTopics($topics) {
        global $conn;
    
        $inClause = implode(',', array_fill(0, count($topics), '?'));
    
        $query = "SELECT id, title, topic, end_year, sector, published FROM `table 1` WHERE topic IN ($inClause) ORDER BY end_year ASC";
        $stmt = $conn->prepare($query);
    
        if ($stmt) {
            foreach ($topics as $key => $topic) {
                $stmt->bindValue(($key + 1), $topic, PDO::PARAM_STR);
            }
    
            if ($stmt->execute()) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                $data = [
                    'status' => 200,
                    'message' => 'Records Fetched Successfully',
                    'data' => $res
                ];
                header("HTTP/1.0 200 Records Fetched Successfully");
                return json_encode($data);
            } else {
                $data = [
                    'status' => 404,
                    'message' => 'No Record Found',
                ];
                header("HTTP/1.0 404 No Record Found");
                return json_encode($data);
            }
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internet Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }    


    /////////////////////// GET SECTORS /////////////////////////////
    function getSectors() {
        global $conn;
    
        try {
            $query = "SELECT DISTINCT sector FROM `table 1` ORDER BY sector ASC";
            $stmt = $conn->prepare($query);
    
            if ($stmt) {
                if ($stmt->execute()) {
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                    $data = [
                        'status' => 200,
                        'message' => 'Records Fetched Successfully',
                        'data' => $res
                    ];
                    header("HTTP/1.0 200 Records Fetched Successfully");
                } else {
                    $data = [
                        'status' => 404,
                        'message' => 'No Record Found', 
                    ];
                    header("HTTP/1.0 404 No Record Found");
                }
            } else {
                $data = [
                    'status' => 500,
                    'message' => 'Internet Server Error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
            }
    
            return json_encode($data); // Return the JSON response after setting headers
        } catch (PDOException $e) {
            $data = [
                'status' => 500,
                'message' => 'Database Error: ' . $e->getMessage(),
            ];
            header("HTTP/1.0 500 Database Error");
    
            return json_encode($data); // Return the JSON response after setting headers
        }
    }


    /////////////////////// SEARCH BY SECTORS /////////////////////////////
    function getRecordListBySectors($sectors){
        global $conn;
    
        $inClause = implode(',', array_fill(0, count($sectors), '?'));
    
        $query = "SELECT id, title, topic, end_year, sector, published FROM `table 1` WHERE sector IN ($inClause) ORDER BY end_year ASC";
        $stmt = $conn->prepare($query);
    
        if ($stmt) {
            foreach ($sectors as $key => $sector) {
                $stmt->bindValue(($key + 1), $sector, PDO::PARAM_STR);
            }
    
            if ($stmt->execute()) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                $data = [
                    'status' => 200,
                    'message' => 'Records Fetched Successfully',
                    'data' => $res
                ];
                header("HTTP/1.0 200 Records Fetched Successfully");
                return json_encode($data);
            } else {
                $data = [
                    'status' => 404,
                    'message' => 'No Record Found',
                ];
                header("HTTP/1.0 404 No Record Found");
                return json_encode($data);
            }
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internet Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }    


    /////////////////////// GET SWOT /////////////////////////////
    function getSwot() {
        global $conn;
    
        try {
            $query = "SELECT DISTINCT swot FROM `table 1` ORDER BY swot ASC";
            $stmt = $conn->prepare($query);
    
            if ($stmt) {
                if ($stmt->execute()) {
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                    $data = [
                        'status' => 200,
                        'message' => 'Records Fetched Successfully',
                        'data' => $res
                    ];
                    header("HTTP/1.0 200 Records Fetched Successfully");
                } else {
                    $data = [
                        'status' => 404,
                        'message' => 'No Record Found',
                    ];
                    header("HTTP/1.0 404 No Record Found");
                }
            } else {
                $data = [
                    'status' => 500,
                    'message' => 'Internet Server Error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
            }
    
            return json_encode($data); // Return the JSON response after setting headers
        } catch (PDOException $e) {
            $data = [
                'status' => 500,
                'message' => 'Database Error: ' . $e->getMessage(),
            ];
            header("HTTP/1.0 500 Database Error");
    
            return json_encode($data); // Return the JSON response after setting headers
        }
    }


    /////////////////////// SEARCH BY SWOT /////////////////////////////
    function getRecordListBySwots($swots){
        global $conn;
    
        $inClause = implode(',', array_fill(0, count($swots), '?'));
    
        $query = "SELECT id, title, topic, end_year, sector, published, swot FROM `table 1` WHERE swot IN ($inClause) ORDER BY end_year ASC";
        $stmt = $conn->prepare($query);
    
        if ($stmt) {
            foreach ($swots as $key => $swot) {
                $stmt->bindValue(($key + 1), $swot, PDO::PARAM_STR);
            }
    
            if ($stmt->execute()) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                $data = [
                    'status' => 200,
                    'message' => 'Records Fetched Successfully',
                    'data' => $res
                ];
                header("HTTP/1.0 200 Records Fetched Successfully");
                return json_encode($data);
            } else {
                $data = [
                    'status' => 404,
                    'message' => 'No Record Found',
                ];
                header("HTTP/1.0 404 No Record Found");
                return json_encode($data);
            }
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internet Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }    

    /////////////////////// GET REGION /////////////////////////////
    function getRegion() {
        global $conn;
    
        try {
            $query = "SELECT DISTINCT region FROM `table 1` ORDER BY region ASC";
            $stmt = $conn->prepare($query);
    
            if ($stmt) {
                if ($stmt->execute()) {
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                    $data = [
                        'status' => 200,
                        'message' => 'Records Fetched Successfully',
                        'data' => $res
                    ];
                    header("HTTP/1.0 200 Records Fetched Successfully");
                } else {
                    $data = [
                        'status' => 404,
                        'message' => 'No Record Found',
                    ];
                    header("HTTP/1.0 404 No Record Found");
                }
            } else {
                $data = [
                    'status' => 500,
                    'message' => 'Internet Server Error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
            }
    
            return json_encode($data); // Return the JSON response after setting headers
        } catch (PDOException $e) {
            $data = [
                'status' => 500,
                'message' => 'Database Error: ' . $e->getMessage(),
            ];
            header("HTTP/1.0 500 Database Error");
    
            return json_encode($data); // Return the JSON response after setting headers
        }
    }

    /////////////////////// SEARCH BY REGION /////////////////////////////
    function getRecordListByRegions($regions){
        global $conn;
    
        $inClause = implode(',', array_fill(0, count($regions), '?'));
    
        $query = "SELECT id, title, topic, end_year, published, region FROM `table 1` WHERE region IN ($inClause) ORDER BY end_year ASC";
        $stmt = $conn->prepare($query);
    
        if ($stmt) {
            foreach ($regions as $key => $region) {
                $stmt->bindValue(($key + 1), $region, PDO::PARAM_STR);
            }
    
            if ($stmt->execute()) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                $data = [
                    'status' => 200,
                    'message' => 'Records Fetched Successfully',
                    'data' => $res
                ];
                header("HTTP/1.0 200 Records Fetched Successfully");
                return json_encode($data);
            } else {
                $data = [
                    'status' => 404,
                    'message' => 'No Record Found',
                ];
                header("HTTP/1.0 404 No Record Found");
                return json_encode($data);
            }
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internet Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }    

    /////////////////////// GET CITY /////////////////////////////
    function getCity() {
        global $conn;
    
        try {
            $query = "SELECT DISTINCT city FROM `table 1` ORDER BY city ASC";
            $stmt = $conn->prepare($query);
    
            if ($stmt) {
                if ($stmt->execute()) {
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                    $data = [
                        'status' => 200,
                        'message' => 'Records Fetched Successfully',
                        'data' => $res
                    ];
                    header("HTTP/1.0 200 Records Fetched Successfully");
                } else {
                    $data = [
                        'status' => 404,
                        'message' => 'No Record Found',
                    ];
                    header("HTTP/1.0 404 No Record Found");
                }
            } else {
                $data = [
                    'status' => 500,
                    'message' => 'Internet Server Error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
            }
    
            return json_encode($data); // Return the JSON response after setting headers
        } catch (PDOException $e) {
            $data = [
                'status' => 500,
                'message' => 'Database Error: ' . $e->getMessage(),
            ];
            header("HTTP/1.0 500 Database Error");
    
            return json_encode($data); // Return the JSON response after setting headers
        }
    }

    /////////////////////// SEARCH BY CITIES /////////////////////////////
    function getRecordListByCities($cities){
        global $conn;
    
        $inClause = implode(',', array_fill(0, count($cities), '?'));
    
        $query = "SELECT id, title, topic, end_year, published, region, city FROM `table 1` WHERE city IN ($inClause) ORDER BY end_year ASC";
        $stmt = $conn->prepare($query);
    
        if ($stmt) {
            foreach ($cities as $key => $city) {
                $stmt->bindValue(($key + 1), $city, PDO::PARAM_STR);
            }
    
            if ($stmt->execute()) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                $data = [
                    'status' => 200,
                    'message' => 'Records Fetched Successfully',
                    'data' => $res
                ];
                header("HTTP/1.0 200 Records Fetched Successfully");
                return json_encode($data);
            } else {
                $data = [
                    'status' => 404,
                    'message' => 'No Record Found',
                ];
                header("HTTP/1.0 404 No Record Found");
                return json_encode($data);
            }
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internet Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }    

    /////////////////////// GET COUNTRY /////////////////////////////
    function getCountry() {
        global $conn;
    
        try {
            $query = "SELECT DISTINCT country FROM `table 1` ORDER BY country ASC";
            $stmt = $conn->prepare($query);
    
            if ($stmt) {
                if ($stmt->execute()) {
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                    $data = [
                        'status' => 200,
                        'message' => 'Records Fetched Successfully',
                        'data' => $res
                    ];
                    header("HTTP/1.0 200 Records Fetched Successfully");
                } else {
                    $data = [
                        'status' => 404,
                        'message' => 'No Record Found',
                    ];
                    header("HTTP/1.0 404 No Record Found");
                }
            } else {
                $data = [
                    'status' => 500,
                    'message' => 'Internet Server Error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
            }
    
            return json_encode($data); // Return the JSON response after setting headers
        } catch (PDOException $e) {
            $data = [
                'status' => 500,
                'message' => 'Database Error: ' . $e->getMessage(),
            ];
            header("HTTP/1.0 500 Database Error");
    
            return json_encode($data); // Return the JSON response after setting headers
        }
    }


    /////////////////////// SEARCH BY COUNTRIES /////////////////////////////
    function getRecordListByCountries($countries){
        global $conn;
    
        $inClause = implode(',', array_fill(0, count($countries), '?'));
    
        $query = "SELECT id, title, topic, end_year, published, region, city, country FROM `table 1` WHERE country IN ($inClause) ORDER BY end_year ASC";
        $stmt = $conn->prepare($query);
    
        if ($stmt) {
            foreach ($countries as $key => $country) {
                $stmt->bindValue(($key + 1), $country, PDO::PARAM_STR);
            }
    
            if ($stmt->execute()) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                $data = [
                    'status' => 200,
                    'message' => 'Records Fetched Successfully',
                    'data' => $res
                ];
                header("HTTP/1.0 200 Records Fetched Successfully");
                return json_encode($data);
            } else {
                $data = [
                    'status' => 404,
                    'message' => 'No Record Found',
                ];
                header("HTTP/1.0 404 No Record Found");
                return json_encode($data);
            }
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internet Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }   

    /////////////////////// GET COUNTRY /////////////////////////////
    function getPestle() {
        global $conn;
    
        try {
            $query = "SELECT DISTINCT pestle FROM `table 1` ORDER BY pestle ASC";
            $stmt = $conn->prepare($query);
    
            if ($stmt) {
                if ($stmt->execute()) {
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                    $data = [
                        'status' => 200,
                        'message' => 'Records Fetched Successfully',
                        'data' => $res
                    ];
                    header("HTTP/1.0 200 Records Fetched Successfully");
                } else {
                    $data = [
                        'status' => 404,
                        'message' => 'No Record Found',
                    ];
                    header("HTTP/1.0 404 No Record Found");
                }
            } else {
                $data = [
                    'status' => 500,
                    'message' => 'Internet Server Error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
            }
    
            return json_encode($data); // Return the JSON response after setting headers
        } catch (PDOException $e) {
            $data = [
                'status' => 500,
                'message' => 'Database Error: ' . $e->getMessage(),
            ];
            header("HTTP/1.0 500 Database Error");
    
            return json_encode($data); // Return the JSON response after setting headers
        }
    }


    /////////////////////// SEARCH BY COUNTRIES /////////////////////////////
    function getRecordListByPestles($pestles){
        global $conn;
    
        $inClause = implode(',', array_fill(0, count($pestles), '?'));
    
        $query = "SELECT id, title, topic, end_year, published, region, city, country, pestle FROM `table 1` WHERE pestle IN ($inClause) ORDER BY end_year ASC";
        $stmt = $conn->prepare($query);
    
        if ($stmt) {
            foreach ($pestles as $key => $pestle) {
                $stmt->bindValue(($key + 1), $pestle, PDO::PARAM_STR);
            }
    
            if ($stmt->execute()) {
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                $data = [
                    'status' => 200,
                    'message' => 'Records Fetched Successfully',
                    'data' => $res
                ];
                header("HTTP/1.0 200 Records Fetched Successfully");
                return json_encode($data);
            } else {
                $data = [
                    'status' => 404,
                    'message' => 'No Record Found',
                ];
                header("HTTP/1.0 404 No Record Found");
                return json_encode($data);
            }
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internet Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }  












?>