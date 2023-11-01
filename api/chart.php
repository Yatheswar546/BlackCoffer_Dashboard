<?php 

    header('Access-Control-Allow-Origin:');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Method: GET');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

    include_once('../backend/charts.php');
 
    $requestMethod = $_SERVER["REQUEST_METHOD"];
 
    if($requestMethod == 'GET'){

        if($_GET['action'] == 'intensities'){
            $data = fetchIntensity();
            echo $data;    
        }

        if($_GET['action'] == 'relevance'){
            $data = fetchRelevance();
            echo $data;    
        }

        if($_GET['action'] == 'likelihood'){
            $data = fetchLikelihood();
            echo $data;    
        }

        if($_GET['action'] == 'cities'){
            $data = fetchCities();
            echo $data;    
        }

        if($_GET['action'] == 'regions'){
            $data = fetchRegions();
            echo $data;    
        }

        if($_GET['action'] == 'countries'){
            $data = fetchCountries();
            echo $data;    
        }
    }
    else{
        $data = [
            'status' => 405,
            'message' => $requestMethod. 'Method Not Allowed',
        ];
        header("HTTP/1.0 405 Method Not Allowed");
        echo json_encode($data);
    }

?>