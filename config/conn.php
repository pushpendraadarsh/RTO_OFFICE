<?php

$dbhost   = 'localhost';
$dbuser   = 'root';
$dbpass   = '';
$dbname   = 'rtoproject';
$timezone = date_default_timezone_set("Asia/Kolkata");
$conn     = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

function CloseCon($conn)
{
 $conn->close();
}
function adddate($date,$day){
    $date = date_create($date);
    date_add($date,date_interval_create_from_date_string($day));
    return date_format($date,"d-m-Y");
}
function substract_date($date,$day){
    $date = date_create($date);
    date_sub($date,date_interval_create_from_date_string($day));
    return date_format($date,"d-m-Y");
}
