<?php
session_start();
$Version = "V.1.0." . rand(0, 9);
include 'config/conn.php';
if (isset($_SESSION['dealerId'])) {
header("Location: /");
}elseif(isset($_SESSION['adminId'])){
    header("Location: /admin");
}else{?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Panel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css?<?php echo $Version; ?>">
    <link rel="stylesheet" href="css/styleLogin.css?<?php echo $Version; ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css">
</head>

<body>
    <div onClick="closeMessageBox()" class="hide" id="messageBox">
        <div id="messageBoxScreen" class="box"></div>
    </div>
    <main>
        <section class="content-model">
            <header>
                <img class="logo" src="images/logo.png" alt="logo">
            </header>
            <div class="arrow">
                <i class="fa-solid fa-arrow-right"></i>
            </div>
        </section>
        <section class="login-model">
            <div class="container">
                <h1>SLD MIS Login Panel</h1>
                <h2>Login Here</h2>
                <h3 id="errorLoginForm"></h3>
                <form action="#" id="LoginForm">
                    <div class="element-title">Email/Username</div>
                    <div class="element">
                        <i class="material-icons">email</i>
                        <input type="username" id="username" name="username" placeholder="Email" required>
                    </div>
                    <div class="element-title">Password</div>
                    <div class="element">
                        <i class="material-icons">key</i>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit">Login</button>
                </form>
            </div>
        </section>
    </main>
    <script src="js/main.js?<?php echo $Version; ?>"></script>
    <script>
    $(document).ready(function() {
        let LoginForm = $("#LoginForm");
        LoginForm.on('submit', function(e) {
            e.preventDefault();
            let data = new FormData(this);
            if (data.get("username") == "" || data.get("username") == undefined) {
                message("Enter Username First", "", "large", "danger");
            } else if (data.get("password") == "" || data.get("password") == undefined) {
                message("Enter Password First", "", "large", "danger");
            } else {
                LoginUsers(data);
            }
        });
    });
    </script>
</body>

</html>
<?php }
?>