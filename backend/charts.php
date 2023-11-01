<?php
    
    include_once('../database/database.php');

    ///////////////////////// INTENSITY ////////////////////////// 
    function fetchIntensity(){

        global $conn;

        try{
            $query = "SELECT start_year, intensity FROM `table 1` GROUP BY start_year";
            $stmt = $conn->query($query);

            if ($stmt) {
                if ($stmt->rowCount() > 0) {
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $start_years = [];
                    $intensity = [];

                    foreach ($res as $row) {
                        $start_years[] = $row['start_year'];
                        $intensity[] = $row['intensity'];
                    }

                    $data = [
                        'status'  => 200,
                        'message' => 'Records Fetched Successfully',
                        'start_years' => $start_years,
                        'intensity' => $intensity,
                        'action' => 'intensities'
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

    ///////////////////////// RELEVANCE ////////////////////////// 
    function fetchRelevance(){

        global $conn;

        try{
            $query = "SELECT end_year, relevance FROM `table 1` GROUP BY end_year";
            $stmt = $conn->query($query);

            if ($stmt) {
                if ($stmt->rowCount() > 0) {
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $end_years = [];
                    $relevance = [];

                    foreach ($res as $row) {
                        $end_years[] = $row['end_year'];
                        $relevance[] = $row['relevance'];
                    }

                    $data = [
                        'status'  => 200,
                        'message' => 'Records Fetched Successfully',
                        'end_years' => $end_years,
                        'relevance' => $relevance,
                        'action' => 'relevance'
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

    ///////////////////////// LIKELIHOOD ////////////////////////// 
    function fetchLikelihood(){

        global $conn;

        try{
            $query = "SELECT topic, CEIL(AVG(likelihood)) AS ceil_average_likelihood FROM `table 1` GROUP BY topic";
            $stmt = $conn->query($query);

            if ($stmt) {
                if ($stmt->rowCount() > 0) {
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $topics = [];
                    $likelihood = [];

                    foreach ($res as $row) {
                        $topics[] = $row['topic'];
                        $likelihood[] = $row['ceil_average_likelihood'];
                    }

                    $data = [
                        'status'  => 200,
                        'message' => 'Records Fetched Successfully',
                        'topics' => $topics,
                        'likelihood' => $likelihood,
                        'action' => 'likelihood'
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

    ///////////////////////// CITIES ////////////////////////// 
    function fetchCities(){

        global $conn;

        try{
            $query = "SELECT city, COUNT(*) AS city_count FROM `table 1` GROUP BY city";
            $stmt = $conn->query($query);

            if ($stmt) {
                if ($stmt->rowCount() > 0) {
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $cities = [];
                    $cityCounts = [];
                    foreach ($res as $row) {
                        $city = $row['city'];
                        $count = $row['city_count'];
                    
                        $cities[] = array(
                            'city' => $city,
                            'count' => $count
                        );
                    }

                    $data = [
                        'status'  => 200,
                        'message' => 'Records Fetched Successfully',
                        'city' => $cities,
                        'action' => 'cities'
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

    ///////////////////////// REGIONS ////////////////////////// 
    function fetchRegions(){

        global $conn;

        try{
            $query = "SELECT region, COUNT(*) AS region_count FROM `table 1` GROUP BY region";
            $stmt = $conn->query($query);

            if ($stmt) {
                if ($stmt->rowCount() > 0) {
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $regions = [];
                    $regionCounts = [];
                    foreach ($res as $row) {
                        $region = $row['region'];
                        $count = $row['region_count'];
                    
                        $regions[] = array(
                            'region' => $region,
                            'count' => $count
                        );
                    }

                    $data = [
                        'status'  => 200,
                        'message' => 'Records Fetched Successfully',
                        'region' => $regions,
                        'action' => 'regions'
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

    ///////////////////////// COUNTRIES ////////////////////////// 

    function fetchCountries(){

        global $conn;
 
        try{
            $query = "SELECT country FROM `table 1` GROUP BY country";
            $stmt = $conn->query($query);

            if ($stmt) {
                if ($stmt->rowCount() > 0) {
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $country = [];

                    foreach ($res as $row) {
                        $country[] = $row['country'];
                    }

                    $data = [
                        'status'  => 200,
                        'message' => 'Records Fetched Successfully',
                        'country' => $country,
                        'action' => 'countries'
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

?>