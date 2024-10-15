<?php
    $servername="localhost";
    $username="root";
    $pass="";
    $db="interview";

    $con=mysqli_connect($servername,$username,$pass,$db);

    if($con == false){
        die("Error:".mysqli_connect_error());
    }
?>