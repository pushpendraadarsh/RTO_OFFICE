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
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <title>User Module</title>
</head>

<body>
    <?php include 'assets/pagination/preloader.php'; ?>
    <main>
        <?php include "assets/pagination/sidebar+header.php"; ?>

        <section class="contentMain">
            <?php include "assets/pagination/contentHeader.php"; ?>
            <div class="hide hypermenu">
                <div class="form DealerRegistration">
                    <span class="close iconify" data-icon="eva:close-circle-fill"></span>
                    <p>Dealers Registration Form</p>
                    <form id="dealerRegisForm" action="#" style="
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    align-content: center;
    justify-content: center;
    align-items: center;
    font-size: large;">
                        <label class="labelUserReg" for="firstName">First Name</label>
                        <input class="inputUserReg" type="text" name="firstName" id="firstName" required>

                        <label class="labelUserReg" for="lastName">Last Name</label>
                        <input class="inputUserReg" type="text" name="lastName" id="lastName">

                        <label class="labelUserReg" for="username">Username</label>
                        <input class="inputUserReg" type="username" name="username" id="username">

                        <label class="labelUserReg" for="email">Email Address</label>
                        <input class="inputUserReg" type="email" name="email" id="email">

                        <label class="labelUserReg" for="address">Address</label>
                        <textarea class="inputUserReg" name="address" id="address" required></textarea>

                        <label class="labelUserReg" for="password">Password</label>
                        <input class="inputUserReg" type="text" name="password" id="password" required>

                        <button type="submit">Create Users</button>
                    </form>
                </div>
            </div>
            <!-- Edit Users -->
            <div class="hide hypermenu">
                <div class="form editDealerForm">
                    <span class="close iconify" data-icon="eva:close-circle-fill"></span>
                    <p>Edit Dealer Details</p>
                    <form id="editDealerForm" action="#" style="
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    align-content: center;
    justify-content: center;
    align-items: center;
    font-size: large;">
                        <label class="labelUserReg" for="edit_firstName">First Name</label>
                        <input class="inputUserReg" type="text" name="firstName" id="edit_firstName" required>

                        <label class="labelUserReg" for="edit_lastName">Last Name</label>
                        <input class="inputUserReg" type="text" name="lastName" id="edit_lastName">

                        <label class="labelUserReg" for="edit_email">Email Address</label>
                        <input class="inputUserReg" type="email" name="email" id="edit_email">

                        <label class="labelUserReg" for="edit_address">Address</label>
                        <textarea class="inputUserReg" name="address" id="edit_address" required></textarea>

                        <label class="labelUserReg" for="edit_password">Password</label>
                        <input class="inputUserReg" type="text" name="password" id="edit_password" required>

                        <label class="labelUserReg" for="edit_status">Status</label>
                        <select name="status" id="edit_status" required>
                            <option value="activate">Activate</option>
                            <option value="deactivate">Deactivate</option>
                        </select>
                        <button type="submit">Update Users</button>
                    </form>
                </div>
            </div>
            <!-- Dealers list -->
            <div class="containerBox">
                <button id="AddDealers"><span class="iconify" data-icon="akar-icons:circle-plus-fill"></span>Add
                    Dealers</button>
                <!-- <div class="DealerList"> -->
                <table border="2">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <script src="../js/main.js?<?php echo $Version; ?>"></script>
    <script>
    $(document).ready(function() {
        DealerList($("tbody"));

        $("#AddDealers").click(function() {
            $(".DealerRegistration").parent().toggleClass("hide");
        });
        $(".close").click(function() {
            $(".hypermenu").addClass("hide");
        });

        let dealerRegisForm = $("#dealerRegisForm");
        dealerRegisForm.on('submit', function(e) {
            e.preventDefault();
            let formdta = new FormData(this);
            dealerRegisForms(formdta, this);
        });

        $("#editDealerForm").on('submit', function(e) {
            e.preventDefault();
            let formeditdata = new FormData(this);
            dealerEditForms(formeditdata, this);
        });
    });
    </script>
</body>

</html>
<?php } else {
 header("Location: ../login");
 die();
}
?>