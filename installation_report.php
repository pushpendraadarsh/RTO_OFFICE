<?php
$Version = "V.1.0." . rand(0, 9);
include 'config/conn.php';
session_start();
$dealerIdSession = $_SESSION['dealerId'];
if (isset($_SESSION['dealerId'])) {
    include 'api/Functions.php';
 ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RTO Office</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css">
        <link href="http://fonts.googleapis.com/css?family=Roboto:400,300,400italic,500,500italic" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet" type="text/css">
        <script src="js/main.js?<?php echo $Version; ?>"></script>
        <link rel="stylesheet" href="css/vendor/bootstrap.css?<?php echo $Version; ?>" type="text/css">
        <link rel="stylesheet" href="css/style.css?<?php echo $Version; ?>">
        <link rel="stylesheet" href="css/vendor/animate.css" type="text/css">
        <link rel="stylesheet" href="css/vendor/datepicker.min.css" type="text/css">
        <link rel="stylesheet" href="css/vendor/waves.css" type="text/css">
        <link rel="stylesheet" href="css/vendor/layout.css" type="text/css">
        <link rel="stylesheet" href="css/vendor/components.css" type="text/css">
        <link rel="stylesheet" href="css/vendor/plugins.css" type="text/css">
        <link rel="stylesheet" href="css/vendor/common-styles.css" type="text/css">
        <link rel="stylesheet" href="css/vendor/pages.css" type="text/css">
        <link rel="stylesheet" href="css/vendor/responsive.css" type="text/css">
        <link rel="stylesheet" href="css/vendor/matmix-iconfont.css" type="text/css">
        <script type="text/javascript" src="js/vendor/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="js/vendor/layout.init.js"></script>
        <script type="text/javascript" src="js/vendor/jquery-migrate-1.2.1.js"></script>
        <script type="text/javascript" src="js/vendor/jRespond.min.js"></script>
        <script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/vendor/nav-accordion.js"></script>
        <script type="text/javascript" src="js/vendor/hoverintent.js"></script>
        <script type="text/javascript" src="js/vendor/waves.js"></script>
        <script type="text/javascript" src="js/vendor/switchery.js"></script>
        <script type="text/javascript" src="js/vendor/jquery.loadmask.js"></script>
        <script type="text/javascript" src="js/vendor/icheck.js"></script>
        <script type="text/javascript" src="js/vendor/select2.js"></script>
        <script type="text/javascript" src="js/vendor/bootstrap-filestyle.js"></script>
        <script type="text/javascript" src="js/vendor/bootbox.js"></script>
        <script type="text/javascript" src="js/vendor/animation.js"></script>
        <script type="text/javascript" src="js/vendor/colorpicker.js"></script>
        <script type="text/javascript" src="js/vendor/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="js/vendor/sweetalert.js"></script>
        <script type="text/javascript" src="js/vendor/moment.js"></script>
        <script type="text/javascript" src="js/vendor/calendar/fullcalendar.js"></script>
        <!--CHARTS-->
        <script type="text/javascript" src="js/vendor/chart/sparkline/jquery.sparkline.js"></script>
        <script type="text/javascript" src="js/vendor/chart/easypie/jquery.easypiechart.min.js"></script>
        <script type="text/javascript" src="js/vendor/chart/flot/excanvas.min.js"></script>
        <script type="text/javascript" src="js/vendor/chart/flot/jquery.flot.min.js"></script>
        <script type="text/javascript" src="js/vendor/chart/flot/curvedLines.js"></script>
        <script type="text/javascript" src="js/vendor/chart/flot/jquery.flot.time.min.js"></script>
        <script type="text/javascript" src="js/vendor/chart/flot/jquery.flot.stack.min.js"></script>
        <script type="text/javascript" src="js/vendor/chart/flot/jquery.flot.axislabels.js"></script>
        <script type="text/javascript" src="js/vendor/chart/flot/jquery.flot.resize.min.js"></script>
        <script type="text/javascript" src="js/vendor/chart/flot/jquery.flot.tooltip.min.js"></script>
        <script type="text/javascript" src="js/vendor/chart/flot/jquery.flot.spline.js"></script>
        <script type="text/javascript" src="js/vendor/chart/flot/jquery.flot.pie.min.js"></script>
        <script type="text/javascript" src="js/vendor/chart.init.js"></script>
        <script type="text/javascript" src="js/vendor/smart-resize.js"></script>
        <script type="text/javascript" src="js/vendor/matmix.init.js"></script>
        <script type="text/javascript" src="js/vendor/retina.min.js"></script>
        <!---DataTables--->
        <script type="text/javascript" src="js/vendor/jquery.dataTables.js"></script>
        <script type="text/javascript" src="js/vendor/dataTables.responsive.js"></script>
        <script type="text/javascript" src="js/vendor/dataTables.tableTools.js"></script>
        <script type="text/javascript" src="js/vendor/dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="js/vendor/stacktable.js"></script>
        <script type="text/javascript" src="js/vendor/datepicker.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/vendor/datepicker.en.js" type="text/javascript"></script>
        <!--Data Tables-->
        <style>
            .datepicker.active .datepicker--content {
                display: block!important;
            }

            .contentMain {
                position: relative;
                height: 100vh;
                overflow: hidden;
            }

            .contentMain .row {
                overflow-y: auto;
            }

            main .sidebar {
                height: 100vh;
            }
        </style>
    </head>

    <body>
    <?php include 'assets/pagination/preloader.php'; ?>
        <main>
            <?php include "assets/pagination/sidebar+header.php"; ?>

            <section class="contentMain">
                <?php include "assets/pagination/contentHeader.php"; ?>
                <!---Fitter List Start Here--->
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header">
                            <h2>Sale List</h2>
                        </div>
                        <div class="box-widget widget-module">
                            <div class="widget-head clearfix">
                                <span class="h-icon"><i class="fa fa-th"></i></span>
                                <h4>Sale List</h4>
                            </div>
                            <div class="widget-container">
                                <div class=" widget-block">
                                    <table class="table dt-table">
                                        <thead>

                                            <tr>
                                                <th>
                                                    Cert Name
                                                </th>
                                                <th>
                                                    Customer Name
                                                </th>
                                                <th>
                                                    Contact Number
                                                </th>
                                                <th>
                                                    Address
                                                </th>
                                                <th>
                                                    Vehicle Reg No.
                                                </th>
                                                <th>
                                                    Vehicle Chasis No.
                                                </th>
                                                <th>
                                                    Vehicle Engine No.
                                                </th>
                                                <th>
                                                    Vehicle Reg Date
                                                </th>
                                                <th>
                                                    Vehicle Make/Model
                                                </th>
                                                <th>
                                                    Speed Governor Model No.
                                                </th>
                                                <th>
                                                    Serial No.
                                                </th>
                                                <th>
                                                    Speed
                                                </th>
                                                <th>
                                                    Invoice No. & Date
                                                </th>
                                                <th>
                                                    RTO
                                                </th>
                                                <th>
                                                    Remark
                                                </th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>
                                                    Cert Name
                                                </th>
                                                <th>
                                                    Customer Name
                                                </th>
                                                <th>
                                                    Contact Number
                                                </th>
                                                <th>
                                                    Address
                                                </th>
                                                <th>
                                                    Vehicle Reg No.
                                                </th>
                                                <th>
                                                    Vehicle Chasis No.
                                                </th>
                                                <th>
                                                    Vehicle Engine No.
                                                </th>
                                                <th>
                                                    Vehicle Reg Date
                                                </th>
                                                <th>
                                                    Vehicle Make/Model
                                                </th>
                                                <th>
                                                    Speed Governor Model No.
                                                </th>
                                                <th>
                                                    Serial No.
                                                </th>
                                                <th>
                                                    Speed
                                                </th>
                                                <th>
                                                    Invoice No. & Date
                                                </th>
                                                <th>
                                                    RTO
                                                </th>
                                                <th>
                                                    Remark
                                                </th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
$sql    = "SELECT * FROM dealerclientdata WHERE dealer_id='$dealerIdSession'";
 $result = mysqli_query($conn, $sql);
 if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) { ?>
                                             <tr>
                                                <td> <a href="certificate?CertificateId=<?php echo $row['certificateno']; ?>" target="_blank" rel="noopener noreferrer"> <?php echo $row['certificateno']; ?></a></td>
                                                <td><?php echo $row['name']; ?> </td>
                                                <td><?php echo $row['mobno']; ?> </td>
                                                <td><?php echo $row['address']; ?></td>
                                                <td><?php echo $row['vehicalregistrationno']; ?></td>
                                                <td><?php echo $row['chasisno']; ?></td>
                                                <td><?php echo $row['engineno']; ?></td>
                                                <td><?php echo $row['invoicedate']; ?></td>
                                                <td><?php echo $row['model']; ?></td>
                                                <td><?php echo $row['modelno']; ?></td>
                                                <td><?php echo $row['serialno']; ?></td>
                                                <td><?php echo $row['speed']; ?></td>
                                                <td><?php echo $row['invoiceno'] . "/" . $row['invoicedate']; ?></td>
                                                <td><?php echo $row['rto']; ?></td>
                                                <td><?php echo $row['remark']; ?></td>
                                            </tr>
<?php
}

 } else {
  return;
 }
 ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--- Fitter List End Here -->
                </div>
                </div>
            </section>
        </main>
    </body>

    </html>
    <?php
} else {
 header("Location: login");
 die();
}
?>