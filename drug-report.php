
<?php
include 'includes/checkInvalidUser.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title >HMS : Drug Report</title>
        <?php require_once 'includes/html_main.php'; ?>
        <?php require_once 'includes/admin_init.php'; ?>
        <script src="js/drug-report.js"></script>
        <link href="css/drug-report.css" rel="stylesheet"/>
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
                        <div class="panel-heading heading"><i class="fa fa-file-pdf-o"> Drug-Report</i></div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#daily">Daily</a></li>
                                <li><a data-toggle="tab" href="#weekly">Weekly</a></li>
                                <li><a data-toggle="tab" href="#monthly">Monthly</a></li>
                                <li><a data-toggle="tab" href="#between">Between Dates</a></li>
                                <li><a data-toggle="tab" href="#Yearly">Yearly</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="daily" class="tab-pane fade in active">
                                    <div class="tab-rep">
                                        <div class="col-md-1 drug-field">Enter Date</div>
                                        <div class="col-md-3">
                                            <div class=" input-group">
                                                <span class="input-group-addon" id="basic-addon1">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input class="form-control" readonly type="text" id="daily-date" name='daily-date'/></input>
                                            </div>
                                        </div>
                                        <div class="col-md-1 head">
                                            <button type="button" class="btn btn-block btn-success" name="btn-daily-drug" id="btn-daily-drug">
                                                <span class="fa fa-server"></span> Go</button>       
                                        </div>
                                    </div>
                                </div>
                                <div id="weekly" class="tab-pane fade">
                                    <h3>Menu 1</h3>
                                    <p>Some content in menu 1.</p>
                                </div>
                                <div id="monthly" class="tab-pane fade">
                                    <div class="tab-rep">
                                        <div class="col-md-1 drug-field">Month</div>
                                        <div class="col-md-2">
                                            <div class=" input-group">
                                                <span class="input-group-addon" id="basic-addon1">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <select id="monthly-month" class="form-control">
                                                    <option value="select">select</option>
                                                    <?php
                                                    $month = array("1" => "January",
                                                        "2" => "February",
                                                        "3" => "March",
                                                        "4" => "April",
                                                        "5" => "May",
                                                        "6" => "June",
                                                        "7" => "July",
                                                        "8" => "August",
                                                        "9" => "September",
                                                        "10" => "October",
                                                        "11" => "November",
                                                        "12" => "December");
                                                    foreach ($month as $k => $v) {
                                                        echo '<option value=' . $k . '>' . $v . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-1 drug-field">Year</div>
                                        <div class="col-md-2">
                                            <div class=" input-group">
                                                <span class="input-group-addon" id="basic-addon1">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <select id="monthly-year" class="form-control">
                                                    <option value="select">select</option>
                                                    <?php
                                                    $year = 2005;
                                                    for ($year; $year <= 2030; $year++) {
                                                        echo '<option value=' . $year . '>' . $year . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1 head">
                                            <button type="button" class="btn btn-block btn-success" name="btn-monthly-drug" id="btn-monthly-drug">
                                                <span class="fa fa-server"></span> Go</button>       
                                        </div>
                                    </div>
                                </div>
                                <div id="between" class="tab-pane fade">
                                    <div class="tab-rep">
                                        <div class="col-md-1 drug-field">Enter Dates</div>
                                        <div class="col-md-3">
                                            <div class=" input-group">
                                                <span class="input-group-addon" id="basic-addon1">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input class="form-control" readonly type="text" id="start-date" name='start-date'/></input>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class=" input-group">
                                                <span class="input-group-addon" id="basic-addon1">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input class="form-control" type="text" readonly id="end-date" name='end-date'/></input>
                                            </div>
                                        </div>
                                        <div class="col-md-1 head">
                                            <button type="button" class="btn btn-block btn-success" name="btn-between-drug" id="btn-between-drug">
                                                <span class="fa fa-server"></span> Go</button>       
                                        </div>
                                    </div>
                                </div>
                                <div id="Yearly" class="tab-pane fade">
                                    <div class="tab-rep">
                                        <div class="col-md-1 drug-field">Select Year</div>
                                        <div class="col-md-2">
                                            <div class=" input-group">
                                                <span class="input-group-addon" id="basic-addon1">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <select class="form-control">
                                                    <option value="select">select</option>
                                                    <?php
                                                    $year = 2005;
                                                    for ($year; $year <= 2030; $year++) {
                                                        echo '<option value=' . $year . '>' . $year . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1 head">
                                            <button type="button" class="btn btn-block btn-success" name="btn-yearly-drug" id="btn-yearly-drug">
                                                <span class="fa fa-server"></span> Go</button>       
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <!-- pdf viewer-->
                <div class="pdf-viewer" id="pdfloader">
                    <iframe src="lib/tcpdf/reports/test simple.php" style="width: 100%; min-height: 450px; height: 100%;"/>
                </div>
                <!--end of pdf viewer-->
            </div>
            <!-- /#page-content-wrapper -->
        </div>
        <!-- /#wrapper -->
        <script src="js/profile.js"></script>

        <!--body div-->

    </body>
</html>

