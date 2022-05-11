<?php
include '../config/conn.php';
session_start();

if (isset($_POST['users']) && isset($_POST['quantity'])) {
    $dealer_id = $_POST['users'];
    $quantity = $_POST['quantity'];
$sql2 = "SELECT SUM(quantity) as userRegisterToken FROM dealerfinancialdata WHERE dealer_id = '$dealer_id'";
    $result2 = mysqli_query($conn,$sql2);
    $rows2 = mysqli_fetch_assoc($result2);
    if ( $rows2['userRegisterToken'] == ""||  $rows2['userRegisterToken'] == null) {
        $AvailbleToken = 0;
    }else{
        $AvailbleToken = $rows2['userRegisterToken'];
    }
    $OverallToken = $AvailbleToken + $quantity;
    $date = date("d-m-Y h:i:s");
    if ($OverallToken < 0) {
        echo 300;
    }else{
    $sql = "INSERT INTO dealerfinancialdata (dealer_id,quantity,method,datetime) VALUES ('$dealer_id','$quantity','add','$date')";
    if (mysqli_query($conn, $sql)){
        echo 200;
    }else{
        echo 300;
    }
  }
}
?>