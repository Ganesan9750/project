<?php
require "dbconfig.php";

function error422($message)
{
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("HTTP/1.0 422 Unprocessable Entity");
    echo json_encode($data);
    exit();
}
function storecustomer ($data){
    global $con;

    $name=mysqli_real_escape_string($con,$data['name']);
    $image=mysqli_real_escape_string($con,$data['image']);

    $filename = $_FILES["image"]["name"];
	$tempname = $_FILES["image"]["tmp_name"];
	$folder="./image/".$filename;
    move_uploaded_file($tempname,$folder);

    if(empty(trim($name))){
        return error422('Enter Your Name');
    }else if(empty(trim($filename))){
        return error422('Enter Your Image');
    }else{
        $query="INSERT INTO api_image(name,image) values('$name','$filename')";
        $result=mysqli_query($con,$query);
        if($result){
            // $data=[
            //     'status'=>200,
            //     'message'=>'Customer Created Successfully',
            // ];
            // header("HTTP/1.0 201 created");
            // return json_encode($data);
            header('Location: index.php');
            exit;
        }else{
            $data=[
                'status'=>500,
                'message'=>'internal server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }
    
}

function getcustomerlist(){
    global $con;
    $query="select * from api_image";
    $result=mysqli_query($con,$query);
    if($result){
        if(mysqli_num_rows($result)>0){
            $res=mysqli_fetch_all($result,MYSQLI_ASSOC);
            $data=[
                'status'=>200,
                'message'=>'Customer list fetched Successfully',
                'data'=>$res
            ];
            header("HTTP/1.0 200 ok");
            return json_encode($data);
        }else{
            $data=[
                'status'=>404,
                'message'=>'No customer Found',
            ];
            header("HTTP/1.0 404 NO Customer Found");
            return json_encode($data);
        }
    }else{
        $data=[
            'status'=>405,
            'message'=>'Method Not Allowed',
        ];
        header("HTTP/1.0 405 Method Not Allowed");
        return json_encode($data);
    }

}

?>