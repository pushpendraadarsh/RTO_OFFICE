<?php
$Version = "V.1.0." . rand(0, 9);
include 'config/conn.php';
session_start();
if (isset($_SESSION['dealerId'])) {
    $dealerIdSession = $_SESSION['dealerId'];
    include 'api/Functions.php';

        if ( $rows2['userRegisterToken'] == ""||  $rows2['userRegisterToken'] == null) {
        $userRegisterToken = 0;
        }else{
            $userRegisterToken = $rows2['userRegisterToken'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="http://www.flotcharts.org/flot/source/jquery.canvaswrapper.js"></script>
    <script src="http://www.flotcharts.org/flot/source/jquery.colorhelpers.js"></script>
    <script src="http://www.flotcharts.org/flot/source/jquery.flot.js"></script>
    <script src="http://www.flotcharts.org/flot/source/jquery.flot.saturated.js"></script>
    <script src="http://www.flotcharts.org/flot/source/jquery.flot.drawSeries.js"></script>
    <script src="http://www.flotcharts.org/flot/source/jquery.flot.browser.js"></script>
    <script src="http://www.flotcharts.org/flot/source/jquery.flot.uiConstants.js"></script>
    <link rel="stylesheet" href="css/examples.css">
    <title>RTO Office</title>
    <script type="text/javascript">
    $(function() {

        // We use an inline data source in the example, usually data would
        // be fetched from a server

        var data = [],
            totalPoints = 200;

        function getRandomData() {

            if (data.length > 0)
                data = data.slice(1);

            // Do a random walk

            while (data.length < totalPoints) {

                var prev = data.length > 0 ? data[data.length - 1] : 50,
                    y = prev + Math.random() * 10 - 5;

                if (y < 0) {
                    y = 0;
                } else if (y > 100) {
                    y = 100;
                }

                data.push(y);
            }

            // Zip the generated y values with the x values

            var res = [];
            for (var i = 0; i < data.length; ++i) {
                res.push([i, data[i]])
            }

            return res;
        }

        // Set up the control widget

        var updateInterval = 300;

        var plot = $.plot("#placeholder", [getRandomData()], {
            series: {
                shadowSize: 0, // Drawing is faster without shadows
                lines: {
                    show: true,
                    fill: true,
                    fillColor: '#99e4eea9',
                    lineWidth: 2.5
                }
            },
            colors: ["#55becc"],
            // grid: {
            //     verticalLines: false,
            //     horizontalLines: false
            // },
            yaxis: {
                min: 0,
                max: 1000,
                tickLength: 0
            },
            xaxis: {
                min: 0,
                max: 10,
                tickLength: 0
            },
            grid: {
                // backgroundColor: {
                //     colors: ["#5a5d60"],
                //     opacity: 0.5
                // }, // "Ground" color (May be a color gradient)
                show: true,
                borderWidth: 0.5,
                borderColor: ["rgba(123, 116, 116, 0.522)"],
                color: ["rgba(123, 116, 116, 0.522)"],
                opacity: 1
                // tickColor: "#FFFFFF"
            }
        });

        function update() {
            plot.setData([getRandomData()]);
            plot.draw();
            setTimeout(update, updateInterval);

        }
        $(".switch-label").on('click', function() {
            console.log($('#switch-1').prop('checked'));
            if ($('#switch-1').prop('checked') == false) {
                updateInterval = 300;
            } else {
                updateInterval = 5000;
            }
            update();
        });
    });
    </script>
</head>

<body>
    <?php include 'assets/pagination/preloader.php'; ?>
    <main>
        <div class="header">
            <a href="/">
                <p>SYN AUTO SOLUTIONS PVT. LTD. | MIS PANEL | USER TYPE : DEALER</p>
            </a>
        </div>

        <div class="section-container">
            <?php include "assets/pagination/sidebar.php"; ?>
            <?php include "assets/pagination/message.php"; ?>

            <section class="content">
                <div class="container">
                    <p>DASHBOARD</p>
                    <div class="sub-container-fluid">
                        <div class="box bg-green">
                            <div class="icon"><i class="timeline material-icons">timeline</i></div>
                            <div class="content">
                                <div>TOTAL RENEWAL</div>
                                <div class="xx-large">
                                    <?php
                                        $CertificateSqlresult = availableCertificate($conn,$dealerIdSession);
                                         if (mysqli_num_rows($CertificateSqlresult) > 0) {
                                             echo mysqli_num_rows($CertificateSqlresult);
                                          }else{
                                              echo 0;
                                          }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="box bg-deep-purple">
                            <div class="icon"><i class="material-icons">account_balance_wallet</i></div>
                            <div class="content">
                                <div>WALLET BALANCE</div>
                                <div id="walletBalance" class="xx-large">
                                    <?php echo $userRegisterToken; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="graph container">
                    <header>
                        <p>SERVER HEALTH(%)</p>
                        <div class="btnRealOrOff">
                            <form action="#">
                                <span>Real Time</span>
                                <span style="font-weight: bold; font-size: small;">OFF</span>
                                <div class="switch">
                                    <input id="switch-1" type="checkbox" class="switch-input" name="realTime" />
                                    <label for="switch-1" class="switch-label">Switch</label>
                                </div>
                                <span style="font-weight: bold; font-size: small;">ON</span>
                            </form>
                        </div>
                    </header>
                    <?php include 'assets/pagination/graph.php'; ?>
                </div>
            </section>
        </div>
    </main>
    <script src="js/main.js?<?php echo $Version; ?>"></script>
    <script>
    $(document).ready(function() {
        // let token = $("#walletBalance");
        // if (parseInt(token.html()) < 4) {
        //     token.css("color", "red");
        // }
        $(".switch-label").on('click', function() {
            if ($('#switch-1').prop('checked') == false) {
                message("Real time feature some extra charge your internet/data.", "", "large",
                    "danger");
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