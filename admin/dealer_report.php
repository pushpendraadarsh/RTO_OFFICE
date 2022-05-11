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
    <title>Dealer's Report</title>
</head>

<body>
<?php include 'assets/pagination/preloader.php'; ?>
    <main>
    <?php include "assets/pagination/sidebar+header.php"; ?>

        <section class="contentMain">
        <?php include "assets/pagination/contentHeader.php"; ?>
        <div class="containerBox">
                    <!-- <div class="DealerList"> -->
                    	<style type="text/css">
                            th{
                                font-family: sans-serif;
                                font-size: large;
                            }
                    		td{
                    			font-size: x-large;
                    			font-weight: 100;
                    		}
                    		tr td:last-child sub{
                    			font-size: large;
                    		}
                    		tr:nth-child(even){
                    			background-color: mintcream;
                    		}
                    	</style>
                        <table border="2" style="width: 90% !important;margin: auto;">
                            <thead>
                                <tr>
                                    <th width="10%">Sr. No.</th>
                                    <th width="35%">Dealer Id</th>
                                    <th width="10%">Available Renewals</th>
                                    <th width="10%">Last Recharge</th>
                                    <th width="35%">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
    $sql10 = "SELECT * FROM dealerdemographicdata WHERE position='dealer' ORDER BY firstName ASC";
	$check = mysqli_query($conn,$sql10);
	if (mysqli_num_rows($check) > 0) {
        $i = 1;
		while ($row = mysqli_fetch_assoc($check)) { ?>
			                    <tr>
                                	<td><?php echo $i++; ?></td>
                                	<td><?php echo $row['dealer_id']; ?></td>
                                	<td><?php echo tokenExist($conn,$row['dealer_id'],'OverallToken');?></td>
                                	<td><?php echo tokenExist($conn,$row['dealer_id'],'LastQuantity');?></td><td class="heavy"><?php echo tokenExist($conn,$row['dealer_id'],'LastDateTime');?></td>
                                </tr>
		<?php }
  }else{ ?>
                                 <tr>
                                	<td colspan="5" style="text-align: center;"> No Data Found</td>
                                </tr>
		<?php } ?>
                            </tbody>
                        </table>
                </div>       
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