<?php
include '../config/conn.php';
session_start();
if (isset($_POST['username']) && isset($_POST['firstName'])) {
    $dealer_id = $_POST['username'];
    $address = $_POST['address'];
    $firstName = $_POST['firstName'];
    $email = $_POST['email'];
    $lastName = $_POST['lastName'];
    $password = $_POST['password'];
    $date = date("d-m-Y h:i:s");

    $query = "SELECT * FROM dealerdemographicdata WHERE (dealer_id='$dealer_id' OR email='$email')";
    $query_Check = mysqli_query($conn,$query);
    if (mysqli_num_rows($query_Check) > 0) {
    	echo 300;
    } else {
    $sql = "INSERT INTO dealerdemographicdata (dealer_id,password,firstName,lastName,email,address,status,position) VALUES ('$dealer_id','$password','$firstName','$lastName','$email','$address','activate','dealer')";
    if (mysqli_query($conn, $sql)){
        echo 200;
    }else{
        echo 100;
    }
}
}
?>