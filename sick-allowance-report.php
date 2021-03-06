
<?php
include 'includes/checkInvalidUser.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title >HMS : Sick Allowance Report</title>
        <?php require_once 'includes/html_main.php'; ?>
        <?php require_once 'includes/admin_init.php'; ?>
        <script src="js/sick-allowance-report.js"></script>
        <link href="css/sick-allowance-report.css" rel="stylesheet"/>
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
                        <div class="panel-heading heading"><i class="fa fa-battery-half"> Sick-Allowance-Report</i></div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#daily"><i class="fa fa-battery-1"></i> Daily</a></li>
                                <li><a data-toggle="tab" href="#between"><i class="fa fa-battery-2"></i> Between Dates</a></li>
                                <li><a data-toggle="tab" href="#monthly"><i class="fa fa-battery-3"></i> Monthly</a></li>
                                <li><a data-toggle="tab" href="#Yearly"><i class="fa fa-battery-4"></i> Yearly</a></li>
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
                                            <button type="button" class="btn btn-block btn-success" name="btn-daily-sa" id="btn-daily-sa">
                                                <span class="fa fa-server"></span> Go</button>       
                                        </div>
                                    </div>
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
                                            <button type="button" class="btn btn-block btn-success" name="btn-monthly-sl" id="btn-monthly-sl">
                                                <span class="fa fa-server"></span> Go</button>       
                                        </div>
                                    </div>
                                </div>
                                <div id="between" class="tab-pane fade">
                                    <div class="tab-rep">
                                        <div class="col-md-1 drug-field">Dates</div>
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
                                            <button type="button" class="btn btn-block btn-success" name="btn-between-sl" id="btn-between-sl">
                                                <span class="fa fa-server"></span> Go</button>       
                                        </div>
                                    </div>
                                </div>
                                <div id="Yearly" class="tab-pane fade">
                                    <div class="tab-rep">


                                        <div class="col-md-1 drug-field">Emp. ID &nbsp;<input type="checkbox" id="d-empid" name="d-empid"></input></div>
                                        <div class="col-md-3">
                                            <input class="form-control" placeholder="Employee ID" type="text" id="daily-empid" name='daily-empid'/></input>
                                        </div>
                                        <div class="col-md-1 drug-field">Select Year</div>
                                        <div class="col-md-2">
                                            <div class=" input-group">
                                                <span class="input-group-addon" id="basic-addon1">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <select id="yearly-year" class="form-control">
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
                                            <button type="button" class="btn btn-block btn-success" name="btn-yearly-sl" id="btn-yearly-sl">
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
                    <iframe id="frame" style="width: 100%; min-height: 500px; height: 100%;"></iframe>
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

