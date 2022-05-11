<?php
include '../config/conn.php';
session_start();
if (isset($_SESSION['dealerId'])) {
    $dealerId = $_SESSION['dealerId'];
    $certificateno = $_POST['certificateNo'];
    $sql    = "SELECT * FROM dealerclientdata WHERE dealer_id='$dealerId' && certificateno='$certificateno'";
 $result = mysqli_query($conn, $sql);
 if (mysqli_num_rows($result) > 0) {
    $myObj = ["status"=>200,"url"=>$certificateno];
 }else{
    $myObj = ["status"=>300];
 }
}else {
    $myObj = ["status"=>100];
}
echo json_encode($myObj);
