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
        <title>Print Certificate</title>
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
                      <p>PRINT RENEWAL CERTIFICATE</p>
                    </div>

                    <div class="print-certificate container">
                        <header>
                            <p>Print Here..</p>
                        </header>
                        <div class="body">
                            <p>Select Certificate Number</p>
                            <form action="#" id="printCertificateForm">
                                <select name="certificateNo" id="certificateNo">
                                    <option value="">Select</option>
                                    <?php 
                                    $CertificateSqlresult = availableCertificate($conn,$dealerIdSession);
                                    if (mysqli_num_rows($CertificateSqlresult) > 0) {
                                        while ($rows = mysqli_fetch_assoc($CertificateSqlresult)) { ?>
                                            <option value="<?php echo $rows['certificateno']; ?>"><?php echo $rows['certificateno']; ?></option>
                                       <?php }
                                    }
                                    ?>
                                    
                                </select>
                                <button type="submit">
                                    <i class="material-icons">print</i> 
                                    <span>PRINT CERTIFICATE</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <script src="js/main.js?<?php echo $Version; ?>"></script>
        <script>
        $(document).ready(function(){
            let CertificateForm = $("#printCertificateForm");
            CertificateForm.on('submit',function(e){
                e.preventDefault();
                let CertificateFormData = new FormData(this);
                // let values = [...CertificateFormData.entries()];
                if (CertificateFormData.get('certificateNo') == "") {
                    return;
                }else{
                    Certificate(CertificateFormData);
                }
                CertificateForm[0].reset();
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