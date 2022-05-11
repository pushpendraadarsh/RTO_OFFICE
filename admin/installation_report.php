<?php
$Version = "V.1.0." . rand(0, 9);
include '../config/conn.php';
session_start();
$dealerIdSession = $_SESSION['adminId'];
if (isset($_SESSION['adminId'])) {
    include '../api/Functions.php';
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/style.css?<?php echo $Version; ?>">
    <link rel="stylesheet" href="../css/styleadmin.css?<?php echo $Version; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css">
    <title>RTO Office</title>
</head>

<body>
<?php include 'assets/pagination/preloader.php'; ?>
    <main>
    <?php include "assets/pagination/sidebar+header.php"; ?>

        <section class="contentMain">
        <?php include "assets/pagination/contentHeader.php"; ?>

        </section>
    </main>
    <script src="../js/main.js?<?php echo $Version; ?>"></script>
    <script>
        $(document).ready(function(){
            
        });
    </script>
</body>

</html>
<?php
} else {
 header("Location: ../login");
 die();
}
?>