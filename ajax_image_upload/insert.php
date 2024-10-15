<?php
$db = mysqli_connect("localhost", "root", "", "interview");
$filename = $_FILES["image"]["name"];
$tempname = $_FILES["image"]["tmp_name"];
$folder = "./image/" . $filename;
$sql = "insert into image(photo) values('$filename')";
// echo $sql;
mysqli_query($db, $sql);
if (move_uploaded_file($tempname, $folder)) {
    echo "Success";
}
?>
