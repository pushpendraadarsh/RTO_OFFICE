<?php
$Version = "V.1.0." . rand(0, 9);
include '../config/conn.php';
session_start();
if (isset($_SESSION['dealerId']) && isset($_POST['newPassword'])) {
    $dealerId = $_SESSION['dealerId'];
    $oldPassword = $_POST['oldPassword'];
    $new_password = $_POST['newPassword'];
    $reNewPass = $_POST['reNewPassword'];

    $sql = "SELECT password FROM dealerdemographicdata WHERE dealer_id='$dealerId'";
    $rows = mysqli_fetch_assoc(mysqli_query($conn,$sql));
    $currentPassword = $rows['password'];
    if ($oldPassword == $currentPassword) {
        if ($new_password == $reNewPass) {
            $uql = "UPDATE dealerdemographicdata SET password='$reNewPass' WHERE dealer_id='$dealerId'";
            if(mysqli_query($conn,$uql)){
                echo 200;
            }else{
                echo 100;
            }
        }else{
            echo 400;//new password not match
        }
    }else {
        echo 300;
    } 
}
 ?>