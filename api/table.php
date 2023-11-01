<?php

    header('Access-Control-Allow-Origin:');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Method: GET');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

    include_once('../backend/functions.php'); 

    $requestMethod = $_SERVER["REQUEST_METHOD"]; 

    if($requestMethod == 'GET'){

        $data = fetchTableData();
        echo $data;
        
    }

    elseif($requestMethod == 'POST'){

        if($_POST['action'] == 'searchRecord'){  
            $title = $_POST['title'];
            $recordList = getRecordListByTitle($title);
            echo $recordList;
        }

        if($_POST['action'] == 'viewRecord'){
            $id = $_POST['id'];
            $recordList = fetchCompleteData($id);
            echo $recordList;
        }
        if($_POST['action'] == 'searchTopics'){
            $topics = $_POST['arr'];
            $recordList =  getRecordListByTopics($topics);
            echo $recordList;
        }
        if($_POST['action'] == 'searchSectors'){
            $sectors = $_POST['arr'];
            $recordList =  getRecordListBySectors($sectors);
            echo $recordList;
        }
        if($_POST['action'] == 'searchSwots'){
            $swots = $_POST['arr'];
            $recordList =  getRecordListBySwots($swots);
            echo $recordList;
        }
        if($_POST['action'] == 'searchRegions'){
            $regions = $_POST['arr'];
            $recordList =  getRecordListByRegions($regions);
            echo $recordList;
        }
        if($_POST['action'] == 'searchCity'){
            $cities = $_POST['arr'];
            $recordList =  getRecordListByCities($cities);
            echo $recordList;
        }
        if($_POST['action'] == 'searchCountry'){
            $countries = $_POST['arr'];
            $recordList =  getRecordListByCountries($countries);
            echo $recordList;
        }
        if($_POST['action'] == 'searchPestle'){
            $pestles = $_POST['arr'];
            $recordList =  getRecordListByPestles($pestles);
            echo $recordList;
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