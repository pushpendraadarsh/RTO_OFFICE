<?php
include_once '../config/conn.php';
session_start();
if (isset($_SESSION['dealerId']) && isset($_POST['customerName']) && strlen($_POST['allotSerialNo']) == 5) {
    $dealerId = $_SESSION['dealerId'];
    /*************Certificate No Allot************ */
    $sql= "SELECT * FROM dealerclientdata ORDER BY certificateno DESC";
 $result = mysqli_query($conn, $sql);
 $row = mysqli_fetch_assoc($result);
 if (mysqli_num_rows($result) > 0) {
    if (intval($row['certificateno']) < 1000) {
        $last_CertNo = 1000;
   }else{
       $last_CertNo = $row['certificateno'];
   }
   }else{
   $last_CertNo = 1000;
   }
    $certNooo = intval($last_CertNo) + 1;
    $timesofzero = 8 - strlen($certNooo);
    $certNo = str_repeat("0",$timesofzero).$certNooo;


    $name = $_POST['customerName'];
    $mobNo = $_POST['contactNumber'];
    $address = $_POST['address'];
    $vehicalregistrationno = $_POST['registrationNo'];
    $chasisno = $_POST['chasisNo'];
    $engineno = $_POST['engineNo'];
    $rotorsealno = $_POST['rotorSealNo'];
    $model = $_POST['makeModel'];
    $approvalno = $_POST['approvalNo'];
    $speed = $_POST['speed'];
    $vehicalmanufactureyear = $_POST['manufacturingYear'];
    $vehicalcategory = $_POST['vehicalCategory'];
    $modelno = $_POST['modelNo'];
    $serialno = $_POST['allotSerialNo'];
    $invoiceno = $_POST['invoiceNo'];
    $invoicedate = $_POST['invoiceDate'];
    $rtostate = $_POST['state'];
    $rto = $_POST['selectRTO'];
    $remark = "No";
    $datetime = date("d-m-Y h:i:s");

    $CheckSerialNoUnique= "SELECT * FROM dealerclientdata WHERE serialno='$serialno'";
 $CheckSerialNoUniqueProcess = mysqli_query($conn, $CheckSerialNoUnique);
if (mysqli_num_rows($CheckSerialNoUniqueProcess) > 0) {
    $myObj = ["status"=>300];
}else{
    $sql = "INSERT INTO dealerclientdata (dealer_id,certificateno,name,mobno,address,vehicalregistrationno,chasisno,engineno,rotorsealno,
    model,approvalno,speed,vehicalmanufactureyear,vehicalcategory,modelno,serialno,invoiceno,invoicedate,rtostate,rto,remark)
    VALUES ('$dealerId','$certNo','$name','$mobNo','$address','$vehicalregistrationno','$chasisno','$engineno','$rotorsealno',
    '$model','$approvalno','$speed','$vehicalmanufactureyear','$vehicalcategory','$modelno','$serialno','$invoiceno',
    '$invoicedate','$rtostate','$rto','$remark')";

    $sql2 = "INSERT INTO dealerfinancialdata (dealer_id,quantity,method,datetime)
    VALUES ('$dealerId','-1','used','$datetime')";

    if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
        $myObj = ["status"=>200,"no"=>$certNo];
    }else{
        $myObj = ["status"=>300];
    }
}
echo json_encode($myObj);
}
?>