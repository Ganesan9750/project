<?php
    error_reporting(0);

    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

    include('insert.php');

    $requestmethod=$_SERVER["REQUEST_METHOD"];
    if($requestmethod =="POST"){
        $inputdata=json_decode(file_get_contents("php://input"),true);
        if(empty($inputdata)){
            $storecustomer=storecustomer($_POST);
        }else{
            $storecustomer=storecustomer($inputdata);
        }
        echo $storecustomer;
    }else{
        $data=[
            'status'=>405,
            'message'=>$requestmethod.'Method Not Allowed',
        ];
        header("http/1.0 405 Method Not Allowed");
        echo json_encode($data);
    }
    

?>