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
function storecustomer ($customerinput){
    global $con;

    $mobile=mysqli_real_escape_string($con,$customerinput['mobile']);
    $otp=mysqli_real_escape_string($con,$customerinput['otp']);

    if(empty(trim($mobile))){
        return error422('Enter Your Mobile Number');
    }else if(empty(trim($otp))){
        return error422('Enter Your OTP');
    }else{
        $query="INSERT INTO api(mobile,otp) values('$mobile','$otp')";
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

function getcustomer($customerparams){
    global $con;
    if($customerparams['id']==Null){
        return error422('Enter Your customerid');
    }
    $customerid=mysqli_real_escape_string($con,$customerparams['id']);
    $query="select * from api where id='$customerid' limit 1";
    $result=mysqli_query($con,$query);
    if($result){
        if(mysqli_num_rows($result)==1){
            $res=mysqli_fetch_assoc($result);
            $data=[
                'status'=>200,
                'message'=>'customer fetched successfully',
                'data'=>$res
            ];
            header("HTTP/1.0 200 ok");
            return json_encode($data);
        }else{
            $data=[
                'status'=>404,
                'message'=>'No Customer Found',
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    }else{
        $data=[
            'status'=>500,
            'message'=>'internal server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}
function getcustomerlist(){
    global $con;
    $query="select * from api";
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
function updatecustomer($customerinput,$customerparams){
    global $con;
    if(!isset($customerparams['id'])){
        return error422('customer id is not found in url');
    }else if($customerparams['id']==Null){
        return error422('Enter the customer id');
    }
    $customerid=mysqli_real_escape_string($con,$customerparams['id']);
    $mobile=mysqli_real_escape_string($con,$customerinput['mobile']);
    $otp=mysqli_real_escape_string($con,$customerinput['otp']);

    if(empty(trim($mobile))){
        return error422('Enter Your Mobile');
    }else if(empty(trim($otp))){
        return error422('Enter Your Otp');
    }else{
       echo $query="Update api set mobile='$mobile',otp='$otp' where id='$customerid' limit 1";
        $result=mysqli_query($con,$query);
        if($result){
            header('Location: index.php');
            exit;
            // $data=[
            //     'status'=>200,
            //     'message'=>'customer update Successfully',
            // ];
            // header("HTTP/1.0 200 updated");
            // return json_encode($data);
        }else{
            $data=[
                'status'=>500,
                'message'=>'internal server Error',
            ];
            header("HTTP/1.0 500 internal server Error");
            return json_encode($data);
        }
    }
}
function deletecustomer($customerparams){
    global $con;
    if(!isset($customerparams['id'])){
        return error422('customer id is not found in url');
    }else if($customerparams['id']==Null){
        return error422('Enter the Customer id');
    }
    $customerid=mysqli_real_escape_string($con,$customerparams['id']);
    $query="delete from api where id='$customerid' limit 1";
    $result=mysqli_query($con,$query);
    if($result){
        $data=[
            'status'=>200,
            'message'=>'customer deleted Successfully',
        ];
        header("HTTP/1.0 200 ok");
        return json_encode($data);
    }else{
        $data=[
            'status'=>404,
            'message'=>'customer not Found',
        ];
        header("HTTP/1.0 404 Not Found");
        return json_encode($data);
    }
}
?>