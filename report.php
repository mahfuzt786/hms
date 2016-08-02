
<?php
include 'includes/checkInvalidUser.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title >HMS : Report</title>
        <?php require_once 'includes/html_main.php'; ?>
        <link href="css/profile.css" rel="stylesheet"/>
        <link href="css/dashboard.css" rel="stylesheet"/>
    </head>
    <body>

        <?php require_once('includes/menu_navbar.php'); ?>

        <div class="toggled-2" id="wrapper"><?php
        require_once('includes/menu_sidebar.php');
        ?>
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container xyz">
                    <div class="panel panel-default">
                        <div class="panel-heading heading"><i class="fa fa-file-pdf-o"> Report</i></div>
                        <div class="panel-body">
                            <div class="col-lg-12 container-fluid">
                                <div class="row-fluid">
                                    <div class="col-md-2 dash-item">
                                        <div class="panel panel-default">
                                            <a href="lib/tcpdf/reports/test simple.php">
                                                <div class="panel-body"><i class="fa fa-4x fa-medkit"></i></div>
                                                <div class="panel-heading">Drugs Report</div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-2 dash-item">
                                        <div class="panel panel-default">
                                            <a href="sick-allowance-report.php">
                                                <div class="panel-body"><i class="fa fa-4x fa-battery-half"></i></div>
                                                <div class="panel-heading">Sick Allowance Report</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
        <!-- /#wrapper -->
        <script src="js/profile.js"></script>

        <!--body div-->

    </body>
</html>

