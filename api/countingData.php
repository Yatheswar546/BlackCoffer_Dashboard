<?php

    header('Access-Control-Allow-Origin:');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Method: GET');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

    include_once('../backend/functions.php'); 

    $requestMethod = $_SERVER["REQUEST_METHOD"];

    if($requestMethod == 'GET'){

        $data = countingData();
        echo $data;
        
    }



?>