<?php 
include '../config/conn.php';
session_start();
if (isset($_SESSION['adminId']) && isset($_POST['dealerId'])) {
	$dealerIdSession = $_POST['dealerId'];
	$sql3 = "SELECT * FROM dealerdemographicdata WHERE dealer_id = '$dealerIdSession'";
$result3 = mysqli_query($conn,$sql3);
$obj = [];
if (mysqli_num_rows($result3) > 0) {
	array_push($obj,["status"=>200]);
    $rows3 = mysqli_fetch_assoc($result3);
    $dealerName = $rows3['firstName']." ".$rows3['lastName'];
    $dealerEmail = $rows3['email'];
    array_push($obj,[
    	"firstName"=> $rows3['firstName'],
    	"lastName"=>$rows3['lastName'],
    	"email"=>$rows3['email'],
    	"address"=>$rows3['address'],
    	"password"=>$rows3['password'],
    	"status"=>$rows3['status']
    ]);
    $_SESSION['dealerEditForm'] = $dealerIdSession;
}else{
         array_push($obj,["status"=>100]);
}
echo json_encode($obj);
}
?>