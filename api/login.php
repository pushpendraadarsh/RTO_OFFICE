<?php
include_once '../config/conn.php';
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM dealerdemographicdata WHERE ( dealer_id='$username' OR email = '$username') and password = '$password'";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        $rows = mysqli_fetch_assoc($result);
       $position = $rows['position'];
       if ($position == "dealer" || $position == "") {
           $_SESSION['dealerId'] = $rows['dealer_id'];
           echo 200;
        }elseif ($position == "admin") {
            $_SESSION['adminId'] = $username;
            echo 200;
       }
    }else{
        echo 300;
    }
}
?>