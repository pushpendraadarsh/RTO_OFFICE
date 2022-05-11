<?php
include '../config/conn.php';
session_start();
if (isset($_SESSION['adminId']) && isset($_GET['dealerId'])) {
     	$dealerId = $_GET['dealerId'];
     if ($dealerId == "") {
     	echo 100;
     }else{
     	$sql = "DELETE FROM dealerdemographicdata WHERE dealer_id='$dealerId'";
     	if (mysqli_query($conn,$sql)) {
     		echo 200;
     	}else{
            echo 100;
        }
     }

}
?>