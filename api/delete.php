<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

    include('function.php');

    $requestmethod=$_SERVER["REQUEST_METHOD"];
    if($requestmethod =="DELETE"){
            $deletecustomer=deletecustomer($_GET);
            echo $deletecustomer;
    }else{
        $data=[
            'status'=>404,
            'message'=>$requestmethod.'Method Not Allowed',
        ];
        header("http/1.0 404 Method Not Allowed");
        echo json_encode($data);
    }
    

?>