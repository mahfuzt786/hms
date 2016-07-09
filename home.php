
<?php
include 'includes/checkInvalidUser.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title >HMS : Home</title>
        <?php require_once 'includes/html_main.php'; ?>
        <link href="css/profile.css" rel="stylesheet"/>
        <link href="css/dashboard.css" rel="stylesheet"/>
    </head>
    <body>

        <?php require_once('includes/menu_navbar.php'); ?>

        <div class="toggled-2" id="wrapper">
            <?php require_once('includes/menu_sidebar.php'); ?>
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container xyz">
                    <div class="panel panel-default">
                        <div class="panel-heading heading"><i class="fa fa-dashboard"> Admin Dashboard</i></div>

                        <div class="col-lg-12 container-fluid dash-head">
                            <div class="row-fluid">
                                <div class="col-md-4 dash-head-item" style="border: none;">
                                    <i class="fa fa-users"> Total Employees</i>
                                    <h3>5000</h3>
                                </div>
                                <div class="col-md-4 dash-head-item">
                                    <i class="fa fa-user"> Male Employees</i>
                                    <h3>2500</h3>
                                </div>
                                <div class="col-md-4 dash-head-item">
                                    <i class="fa fa-user"> Female Employees</i>
                                    <h3>2500</h3>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-12 container-fluid">
                                <div class="row-fluid">
                                    <div class="col-md-2 dash-item">
                                        <div class="panel panel-default">
                                            <div class="panel-body"><i class="fa fa-4x fa-users"></i></div>
                                            <div class="panel-heading">Outpatients</div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 dash-item">
                                        <div class="panel panel-default">
                                            <div class="panel-body"><i class="fa fa-4x fa-child"></i></div>
                                            <div class="panel-heading">Maternity</div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 dash-item">
                                        <div class="panel panel-default">
                                            <div class="panel-body"><i class="fa fa-4x fa-vine"></i></div>
                                            <div class="panel-heading">Vaccination</div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 dash-item">
                                        <div class="panel panel-default">
                                            <a href="drugs.php"> 
                                                <div class="panel-body"><i class="fa fa-4x fa-medkit"></i></div>
                                                <div class="panel-heading">Drugs</div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-2 dash-item">
                                        <div class="panel panel-default">
                                            <div class="panel-body"><i class="fa fa-4x fa-battery-0"></i></div>
                                            <div class="panel-heading">Sick Allowance</div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 dash-item">
                                        <div class="panel panel-default">
                                            <a href="setting.php"> 
                                                <div class="panel-body"><i class="fa fa-4x fa-gears"></i></div>
                                                <div class="panel-heading">Setting</div>
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

