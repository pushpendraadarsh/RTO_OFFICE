<?php                   //find Token Data
                        $sql2 = "SELECT SUM(quantity) as userRegisterToken FROM dealerfinancialdata WHERE dealer_id = '$dealerIdSession'";
                        $result2 = mysqli_query($conn,$sql2);
                            $rows2 = mysqli_fetch_assoc($result2);
                            $userRegisterToken = $rows2['userRegisterToken'];
                            //DealerDataFetch
$sql3 = "SELECT * FROM dealerdemographicdata WHERE dealer_id = '$dealerIdSession'";
$result3 = mysqli_query($conn,$sql3);
if (mysqli_num_rows($result3) > 0) {
    $rows3 = mysqli_fetch_assoc($result3);
    $dealerName = $rows3['firstName']." ".$rows3['lastName'];
    $dealerEmail = $rows3['email'];
    $userStatus = $rows3['status'];
}else{
$dealerName = "No Name";
$dealerEmail = "N/A";
}

//Last Recharge IN ADMIN
$sql4="SELECT * FROM dealerfinancialdata WHERE method='add' ORDER BY id DESC";
$result4=mysqli_query($conn,$sql4);
if (mysqli_num_rows($result4) > 0) {
    $row4 = mysqli_fetch_assoc($result4);
    $lastRecharge ="Dealer Name:". $row4['dealer_id']." Quantity: ".$row4['quantity']." (".$row4['datetime'].")";
}else{
    $lastRecharge = 'No Data Found';
}

/************************Token data By users*******************/

function tokenExist($conn,$dealerId,$mode){
   $sql2 = "SELECT * FROM dealerfinancialdata WHERE dealer_id = '$dealerId'";
   $result2 = mysqli_query($conn,$sql2);

   if (mysqli_num_rows($result2) > 0) {
    if (isset($mode) && $mode == "OverallToken") {
        $token = 0;
        while($rows = mysqli_fetch_assoc($result2)){
            $quantity = $rows['quantity'];
            $token = $token + $quantity;
        }
        return $token;
    }
    ////Last Quantity
    if (isset($mode) && $mode == "LastQuantity") {
        $sql5 = "SELECT * FROM dealerfinancialdata WHERE dealer_id = '$dealerId' && method='add' ORDER BY id DESC";
        $res5 = mysqli_query($conn,$sql5);
        if (mysqli_num_rows($res5) > 0) {
        $result5 = mysqli_query($conn,$sql5);
        return mysqli_fetch_assoc($result5)['quantity'];
    }else{
        return 'No data Found!!';
    }
    }
    //Last Datetime
    if (isset($mode) && $mode == "LastDateTime") {
        $sql5 = "SELECT * FROM dealerfinancialdata WHERE dealer_id = '$dealerId' && method='add' ORDER BY id DESC";
        $res5 = mysqli_query($conn,$sql5);
        if (mysqli_num_rows($res5) > 0) {
        $result5 = mysqli_query($conn,$sql5);
        $rowss5 = mysqli_fetch_assoc($result5);
        $d = date_create($rowss5['datetime']);
        return date_format($d,"d-m-Y");
    }else{
        return "";
    }
    }
        return mysqli_fetch_assoc($result5);
   }else{
    return 0;
   }
}

function dealerCount($conn,$mode){
    if (isset($mode) && $mode = 'active') {
    $sql = "SELECT count('dealerId') as dealerAll FROM dealerdemographicdata WHERE position='dealer'&&status='activate'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    return $row['dealerAll'];
    }
}

function availableCertificate($conn,$dealerId){
    $sql= "SELECT * FROM dealerclientdata WHERE dealer_id='$dealerId' ORDER BY id DESC";
    return mysqli_query($conn,$sql);
}
?>