<?php 
include '../config/conn.php';
session_start();
// if ($_POST['event'] == "dealerList") {
	$sql = "SELECT * FROM dealerdemographicdata WHERE position='dealer' ORDER BY firstName ASC";
	$check = mysqli_query($conn,$sql);
		$someArray = [];
	if (mysqli_num_rows($check) > 0) {
		array_push($someArray, [
                'status'  => "200",
            ]);
		while ($row = mysqli_fetch_assoc($check)) {
			array_push($someArray, [
				'id'    =>  $row['dealer_id'],
                'fullName'  => $row['firstName']." ".$row['lastName'],
                'address'  => $row['address'],
                'status'  => $row['status']
            ]);
		}
	}else{
		array_push($someArray, [
                'status'  => "100",
            ]);
	}
	echo json_encode($someArray);
// }
?>