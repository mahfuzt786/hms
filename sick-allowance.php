
<?php
include 'includes/checkInvalidUser.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title >HMS : Sick Allowance</title>
        <?php require_once 'includes/html_main.php'; ?>
        <?php require_once 'includes/admin_init.php'; ?>
        <script src="js/sick-allowance.js"></script>
        <link href="css/sick-allowance.css" rel="stylesheet"/>
        <link href="css/profile.css" rel="stylesheet"/>
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
                        <div class="panel-heading heading"><i class="fa fa-battery-half"> Sick Allowance</i></div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#sickleave">Sick Leave</a></li>
                                <li><a data-toggle="tab" href="#sickrecord">Sick Record</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="content">
                                    <div id="sickleave" class="col-md-12 inner-content tab-pane fade in active">
                                        <div class="col-md-6">
                                            <div class="fields row">
                                                <div class="fields col-md-4">Employee ID</div>
                                                <div class="col-md-6"><input class="form-control" type="text" id="empid" name="empid"></input></div>
                                            </div>
                                            <div class="fields row">
                                                <div class="fields col-md-4">Allowance Rate
                                                </div>
                                                <div class="col-md-6"><input class="form-control" type="text" id="rate" name='rate'></input></div>
                                            </div>
                                            <div class=" fields row">
                                                <div class="fields col-md-4">Start Date</div>
                                                <div class="col-md-6"><input class="form-control" type="text" id="start-date" name='start-date'></input></div>
                                            </div>
                                            <div class=" fields row">
                                                <div class="fields col-md-4">End Date</div>
                                                <div class="col-md-6"><input class="form-control" type="text" id="end-date" name='end-date'></input></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                    </div>
                                </div>
                                <div class="content">
                                    <div id="sickrecord" class="tab-pane fade">
                                        <div id="daily" class="tab-pane fade in active">
                                            <p>Table</p>
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

