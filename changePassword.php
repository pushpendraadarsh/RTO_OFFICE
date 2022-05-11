<?php
$Version = "V.1.0." . rand(0, 9);
include 'config/conn.php';
session_start();
if (isset($_SESSION['dealerId'])) {
    $dealerIdSession = $_SESSION['dealerId'];
    include 'api/Functions.php';
 ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="css/styles.css?<?php echo $Version; ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <title>Change Password</title>
    </head>

    <body>
        <?php include 'assets/pagination/preloader.php'; ?>
        <main>
            <?php include 'assets/pagination/message.php'; ?>
            <div class="header">
                <a href="/">
                    <p>SYN AUTO SOLUTIONS PVT. LTD. | MIS PANEL | USER TYPE : DEALER</p>
                </a>
            </div>

            <div class="section-container">
                <?php include "assets/pagination/sidebar.php"; ?>

                <section class="content">
                    <div class="container">
                        <p>CHANGE PASSWORD</p>
                    </div>

                    <div class="print-certificate container">
                        <header>
                            <p>Change Password Here..</p>
                        </header>
                        <div class="body">
                            <form action="#" id="ChangePassword">
                                <div class="form-element">
                                    <div class="form-control">
                                        <label for="oldPassword">Current Password</label>
                                        <input type="password" name="oldPassword" id="oldPassword" placeholder="Current Password" required>
                                    </div>
                                    <div class="form-control">
                                        <label for="newPassword">New Password</label>
                                        <input type="password" name="newPassword" id="newPassword" placeholder="New Password" required>
                                    </div>

                                    <div class="form-control">
                                        <label for="newPassword">Confirm Password</label>
                                        <input type="text" name="reNewPassword" id="reNewPassword" placeholder="Confirm Password" required>
                                    </div>
                                </div>
                                <button type="submit"> 
                                    Change Password
                                </button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <script src="js/main.js?<?php echo $Version; ?>"></script>
        <script>
            $(document).ready(function() {
                $("#ChangePassword").on('submit', function(e) {
                    e.preventDefault();
                    let FormDataforChangePassword = new FormData(this);
                    if (FormDataforChangePassword.get("newPassword") != FormDataforChangePassword.get("reNewPassword")) {
                        message("New Password Not Match.");
                    } else {
                        ChangePassword(FormDataforChangePassword, this);
                    }
                });
            });
        </script>
    </body>

    </html>
    <?php
} else {
 header("Location: login");
 die();
}
?>