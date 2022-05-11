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
    <title>Admin Dashboard</title>
</head>

<body>
<?php include 'assets/pagination/preloader.php'; ?>
    <main>
    <?php include "assets/pagination/sidebar+header.php"; ?>

        <section class="contentMain">
        <?php include "assets/pagination/contentHeader.php"; ?>
        <marquee style="
        color: red;
    font-size: x-large;
    font-weight: 700;
    margin: 10px;
    padding: 5px;">Last Recharge : <?php echo $lastRecharge; ?></marquee>
        <div class="EUMR" style="
        width: 69vw;
        height: 40vh;
        background-color:aliceblue;
        color:blue;
        margin:auto;">
        <?php if (dealerCount($conn,"active") > 0) { ?>
            <p>Recharge Dealers</p>
            <form id="TokenRechargeForm" action="#">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" placeholder="Enter Quantity" minlength="1" maxlength="3" required>
                
                <select name="users" id="users" required>
                    <option value="">Select Users</option>
                    <?php
                    $ActiveUsersql = "SELECT * FROM dealerdemographicdata WHERE status='activate' && position='dealer' ORDER BY firstName ASC";
                    $ActiveUserResult = mysqli_query($conn,$ActiveUsersql);
                    if (mysqli_num_rows($ActiveUserResult) > 0) {
                        while ($row = mysqli_fetch_assoc($ActiveUserResult)) { ?>
                            <option value="<?php echo $row["dealer_id"] ?>"><?php echo $row["firstName"]." ".$row["lastName"]."(".$row["dealer_id"].")" ?></option>
                        <?php }
                    }
                    ?>
                </select>

                <button type="submit">Pay</button>
            </form>
        <?php }else{ ?> 
            <p>Please Add Dealers First For Recharge</p>
         <?php }?>

            <!-- Extra  -->
            <div class="EUMR">
            <p>Active Dealers</p>
            <div class="quantity">
                <?php echo dealerCount($conn,"active"); ?>
            </div>
        </div>
        <!-- end  -->
        </div>
        </section>
    </main>
    <script src="../js/main.js?<?php echo $Version; ?>"></script>
    <script>
        $(document).ready(function(){
            let ForRecharge = $("#TokenRechargeForm");
            $("#quantity").on('keyup',function(){
                if (this.value.length > 3) {
                    let new_val = this.value.substring(0, 3);
                    this.value = new_val;
                } else {}
            });
            ForRecharge.on('submit',function(e){
                e.preventDefault();
                let FormDatas = new FormData(this);
                if (FormDatas.get('quantity') == 0) {
                    message('Quantity not allowed.');
                }else{
                AdminRechargeToken(FormDatas);
                this.reset();
            }
            });

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