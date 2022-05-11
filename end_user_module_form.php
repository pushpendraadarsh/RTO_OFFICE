<?php
$Version = "V.1.0." . rand(0, 9);
include 'config/conn.php';
session_start();
if (isset($_SESSION['dealerId'])) {
    $dealerIdSession = $_SESSION['dealerId'];
    include 'api/Functions.php';

        if ( $rows2['userRegisterToken'] == ""||  $rows2['userRegisterToken'] == null) {
        $userRegisterToken = 0;
        header("Location: sld_renewal");
        }else{
            $userRegisterToken = $rows2['userRegisterToken'];
        }
        if ( $userRegisterToken == 0){
            header("Location: sld_renewal");
        }
        if ( $userStatus == "deactivate"){
            header("Location: sld_renewal");
        }
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/styles.css?<?php echo $Version; ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>SLD ADD AMC</title>
    <script>
    </script>
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
                    <p>ADD AMC</p>
                </div>

                <div class="sld-renewal print-certificate container">
                    <header class="flex-start">
                        <div style="background-color:orangered !important;">
                            <a href="sld_renewal">AMC REPORT</a>
                        </div>
                    </header>
                    <div class="body">
                        <form action="#" id="AddUserData">
                            <div class="form-element">
                                <div class="form-control">
                                    <label for="customerName">Owner Name</label>
                                    <input type="text" name="customerName" id="customerName" placeholder="Owner Name"
                                        required>
                                </div>
                                <div class="form-control">
                                    <label for="address">Owner Address</label>
                                    <textarea type="text" name="address" id="address" placeholder="Owner Address"
                                        required></textarea>
                                </div>

                                <div class="form-control">
                                    <label for="contactNumber">Owner Mobile</label>
                                    <input type="text" name="contactNumber" id="contactNumber"
                                        placeholder="Owner Mobile Number" required>
                                </div>
                                <div class="form-control">
                                    <label for="makeModel">Make/Model</label>
                                    <input type="text" name="makeModel" id="makeModel" placeholder="Vehical Make/Model"
                                        required>
                                </div>
                                <div class="form-control">
                                    <label for="registrationNo">Vehical Number</label>
                                    <input type="text" name="registrationNo" id="registrationNo"
                                        placeholder="Vehical Number" required>
                                </div>
                                <div class="form-control">
                                    <label for="chasisNo">Chassis Number</label>
                                    <input type="text" name="chasisNo" id="chasisNo" placeholder="Chassis Number"
                                        required>
                                </div>
                                <div class="form-control">
                                    <label for="engineNo">Engine Number</label>
                                    <input type="text" name="engineNo" id="engineNo" placeholder="Engine Number"
                                        required>
                                </div>
                                <div class="form-control hide">
                                    <label for="rotorSealNo">Roto Seal Number</label>
                                    <input type="text" name="rotorSealNo" value=" " id="rotorSealNo"
                                        placeholder="Rotor Seal Number" required>
                                </div>
                                <div class="form-control">
                                    <label for="approvalNo">Type Approval Number</label>
                                    <input type="text" name="approvalNo" id="approvalNo"
                                        placeholder="Type Approval Number" maxlength="4" required>
                                </div>
                                <div class="form-control">
                                    <label for="speed">Set Speed</label>
                                    <select name="speed" id="speed" required>
                                        <option value="">Select Speed</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="60">60</option>
                                        <option value="80">80</option>
                                        <option value="90">90</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label for="manufacturingYear">Vehical Manufacturing Year</label>
                                    <input type="text" name="manufacturingYear" id="manufacturingYear"
                                        placeholder="Vehical Manufacturing Year" required>
                                </div>
                                <div class="form-control">
                                    <label for="vehicalCategory">Vehical Category</label>
                                    <select name="vehicalCategory" id="vehicalCategory" required>
                                        <option value="">Select</option>
                                        <option value="LCV">LCV</option>
                                        <option value="HVD">HVD</option>
                                        <option value="HCV">HCV</option>
                                        <option value="MCV">MCV</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label for="modelNo">Model Number</label>
                                    <select name="modelNo" id="modelNo" require>
                                        <option value="">Select</option>
                                        <option value="SYN 99(FUEL)">SYN 99(FUEL)</option>
                                        <option value="SYN 100(CABLE TYPE)">SYN 100(CABLE TYPE)</option>
                                        <option value="SYN SMART">SYN SMART</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label for="allotSerialNo">Allot Serial Number</label>
                                    <input type="text" name="allotSerialNo" id="allotSerialNo"
                                        placeholder="Allot Serial Number" minlength="5" maxlength="5" required>
                                </div>
                                <div class="form-control">
                                    <label for="invoiceNo">Invoice Number</label>
                                    <input type="text" name="invoiceNo" id="invoiceNo" placeholder="Invoice Number"
                                        required>
                                </div>
                                <div class="form-control">
                                    <label for="invoiceDate">Invoice Date</label>
                                    <input type="date" name="invoiceDate" id="invoiceDate" placeholder="Invoice Date"
                                        required>
                                </div>
                                <div class="form-control">
                                    <label for="state">Select State</label>
                                    <select name="state" id="state" required>
                                        <option value="">Select State</option>
                                        <option value="jharkhand">Jhankhand</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label for="selectRTO">Select RTO</label>
                                    <select class="selectRTO" name="selectRTO" required>
                                        <option value="">Select</option>
                                        <option value="JH-01">JH-01</option>
                                        <option value="JH-02">JH-02</option>
                                        <option value="JH-03">JH-03</option>
                                        <option value="JH-04">JH-04</option>
                                        <option value="JH-05">JH-05</option>
                                        <option value="JH-06">JH-06</option>
                                        <option value="JH-07">JH-07</option>
                                        <option value="JH-08">JH-08</option>
                                        <option value="JH-09">JH-09</option>
                                        <option value="JH-10">JH-10</option>
                                        <option value="JH-11">JH-11</option>
                                        <option value="JH-12">JH-12</option>
                                        <option value="JH-13">JH-13</option>
                                        <option value="JH-14">JH-14</option>
                                        <option value="JH-15">JH-15</option>
                                        <option value="JH-16">JH-16</option>
                                        <option value="JH-17">JH-17</option>
                                        <option value="JH-18">JH-18</option>
                                        <option value="JH-19">JH-19</option>
                                        <option value="JH-20">JH-20</option>
                                        <option value="JH-21">JH-21</option>
                                        <option value="JH-22">JH-22</option>
                                        <option value="JH-23">JH-23</option>
                                        <option value="JH-24">JH-24</option>
                                    </select>
                                </div>
                            </div>
                            <button id="SubBtn" type="submit">
                                Print Certificate
                            </button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <script src="js/main.js?<?php echo $Version; ?>"></script>
    <script>
    let form = $("#AddUserData");
    form.on('submit', function(e) {
        e.preventDefault();
        let UserData = new FormData(this);
        UserDataRegister(UserData);
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