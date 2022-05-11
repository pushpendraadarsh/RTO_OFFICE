<?php
include '../config/conn.php';
session_start();
if (isset($_SESSION['dealerEditForm']) && isset($_POST['status']) && isset($_POST['firstName']) && isset($_POST['lastName'])) {
    $dealer_id = $_SESSION['dealerEditForm'];
    $address = $_POST['address'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $status = $_POST['status'];
    // $date = date("d-m-Y h:i:s");

    $query = "SELECT * FROM dealerdemographicdata WHERE dealer_id='$dealer_id'";
    $query_Check = mysqli_query($conn,$query);
    if (mysqli_num_rows($query_Check) > 0) {
    $sql = "UPDATE dealerdemographicdata SET password='$password',firstName='$firstName',lastName='$lastName',email='$email',address='$address',status='$status' WHERE dealer_id='$dealer_id'";
    if (mysqli_query($conn, $sql)){
        echo 200;
    }else{
        echo 100;
    }
}else{
echo 300;
}

}
?>