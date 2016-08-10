
<?php
include 'includes/checkInvalidUser.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title >HMS : Sick Allowance</title>
        <?php require_once 'includes/html_main.php'; ?>
        <?php require_once 'includes/admin_init.php'; ?>
        <link href="css/list.css" rel="stylesheet"/>
        <script src="js/sick-allowance.js"></script>
        <link href="css/sick-allowance.css" rel="stylesheet"/>
        <link href="css/profile.css" rel="stylesheet"/>
        <script>
            $(document).ready(function() {
                var options = {
                    valueNames: [ 'SLID', 'EMPID', 'RATE', 'TYPE', 'START', 'DAYS', 'END', 'DATE'],
                    page: 10,
                    plugins: [
                        ListPagination({
                            innerWindow: 3,
                            left: 2,
                            right: 2
                        })
                    ]
                };

                new List('leaverecord', options); 
                $('[data-toggle="tooltip"]').tooltip({
                    container : 'body'
                }); 
            });
        </script>
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
                                <li class="active"><a data-toggle="tab" href="#sickleave">Leave</a></li>
                                <li><a data-toggle="tab" href="#sickrecord">Leave Record</a></li>
                            </ul>

                            <div class="tab-content content">
                                <div id="sickleave" class=" row tab-pane fade in active">
                                    <div class="col-md-6">
                                        <form>
                                            <div class=" fields row" style="margin-bottom: 5px;">
                                                <div class="fields col-md-4">ID</div>
                                                <div class="col-md-6 fields">
                                                    <?php
                                                    $total = 0;
                                                    $sql = "SELECT sid FROM wtfindin_hms.sick_leave";
                                                    $arRes = $mysqli->query($sql);
                                                    if (!$arRes) {
                                                        throw new Exception($mysqli->error);
                                                    } else {
                                                        $total = mysqli_num_rows($arRes) + 1;
                                                        if ($total < 0) {
                                                            throw new Exception($mysqli->error);
                                                        } else {
                                                            $total = $total + 1000;
                                                            $s_id = "SL" . $total;
                                                        }
                                                    }
                                                    ?>
                                                    <span id="slid"><b><?php echo $s_id; ?></b></span>
                                                </div>
                                            </div>
                                            <div class="fields row">
                                                <div class="fields col-md-4">Employee ID</div>
                                                <div class="col-md-6"><input class="form-control" type="text" id="empid" name="empid"></input></div>
                                                <div class="col-md-2 fields">
                                                    <i class="glyphicon glyphicon-ok" id="found"></i>
                                                    <i class="glyphicon glyphicon-remove" id="notfound"></i>
                                                </div>
                                            </div>
                                            <div class="fields row">
                                                <div class="fields col-md-4">Allowance Rate
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fields">
                                                        <?php
                                                        $sql_rate = "SELECT sick_allowance_rate.* FROM wtfindin_hms.sick_allowance_rate";
                                                        $arRes_rate = $mysqli->query($sql_rate);
                                                        if (!$arRes_rate) {
                                                            throw new Exception($mysqli->error);
                                                        } else {
                                                            if (mysqli_num_rows($arRes_rate) == 0) {
                                                                throw new Exception($mysqli->error);
                                                            } else {
                                                                $row_rate = $arRes_rate->fetch_object();
                                                                $rid = $row_rate->r_id;
                                                                $rate = $row_rate->r_rate;
                                                            }
                                                        }
                                                        ?>
                                                        <span id="rate-text"><?php echo $rate; ?></span>
                                                        <input type="hidden" value="<?php echo $rid; ?>" id="rid"/>
                                                    </div>
                                                    <div class=" input-group" id="rate">
                                                        <input class="form-control" maxlength="4" value="<?php echo $rate; ?>" type="text" id="rate-textbox" name='rate'></input>
                                                        <span id="remove-textbox" class="input-group-addon remove-textbox" id="basic-addon1">
                                                            <i class="glyphicon glyphicon-remove"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="fields">
                                                        <span class="edit-icon" id="edit-icon"><i class="fa fa-1x fa-wrench"></i></span>
                                                    </div> 
                                                    <span id="edit-rate"><button type="button" class="btn btn-block btn-primary" value="edit" name="btn-edit-rate" id="btn-edit-rate">edit</button></span>
                                                </div>
                                            </div>
                                            <div class="fields row">
                                                <div class="fields col-md-4">Patient Type
                                                </div>
                                                <div class="col-md-6 fields-radio">
                                                    <input type="radio" name="type-patient" id="patient-self" value="self"> Self</input>
                                                    &nbsp;
                                                    <input type="radio" name="type-patient" id="patient-dependent" value="dependent"> Dependent</input>
                                                </div>
                                            </div>

                                            <div id="dependent">
                                                <div class="fields row">
                                                    <div class="fields col-md-4 wrap">Relation
                                                    </div>
                                                    <div class="col-md-6 fields-radio wrap">
                                                        <input type="radio" class="relation" name="relation" id="relation-child" value="child"> Child</input>
                                                        &nbsp;
                                                        <input type="radio" class="relation" name="relation" id="relation-parent" value="parent"> Parent</input>
                                                    </div>
                                                </div>
                                                <div class="fields row">
                                                    <div class="fields col-md-4 wrap">Dependent's Gender
                                                    </div>
                                                    <div class="col-md-6 fields-radio wrap">
                                                        <input type="radio" class="gender" name="gender" id="g-male" value="male"> Male</input>
                                                        &nbsp;
                                                        <input type="radio" class="gender" name="gender" id="g-female" value="female"> Female</input>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class=" fields row">
                                                <div class="fields col-md-4">Start Date</div>
                                                <div class="col-md-6">
                                                    <div class=" input-group">
                                                        <span class="input-group-addon" id="basic-addon1">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input class="form-control" readonly type="text" id="start-date" name='start-date'></input>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" fields row">
                                                <div class="fields col-md-4">End Date</div>
                                                <div class="col-md-6">
                                                    <div class=" input-group">
                                                        <span class="input-group-addon" id="basic-addon1">
                                                            <i class="fa fa-calendar"></i>
                                                        </span><input class="form-control" readonly type="text" id="end-date" name='end-date'></input>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fields row" style="padding-bottom: 15px;">
                                                <div class="fields col-md-10">
                                                    <button type="button" class="btn btn-block btn-primary" name="btn-grant-leave" id="btn-grant-leave">
                                                        <span class="fa fa-plus"></span> Grant Leave</button>  
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-12 emp-record " id="emp-record">
                                            <div class=" fields row">
                                                <div class="fields col-md-4">Employee ID</div>
                                                <div class="fields col-md-8"><span id="id"></span></div>
                                            </div>
                                            <div class=" fields row">
                                                <div class="fields col-md-4">Employee Name</div>
                                                <div class="fields col-md-8"><span id="name"></span></div>
                                            </div>
                                            <div class=" fields row">
                                                <div class="fields col-md-4">PF ID</div>
                                                <div class="fields col-md-8"><span id="pfid"></span></input></div>
                                            </div>
                                            <div class=" fields row">
                                                <div class="fields col-md-4">Division</div>
                                                <div class="fields col-md-8"><span id="div"></span></div>
                                            </div>
                                            <div class=" fields row">
                                                <div class="fields col-md-4">Book Number</div>
                                                <div class="fields col-md-8"><span id="book"></span></div>
                                            </div>
                                            <div class=" fields row">
                                                <div class="fields col-md-4">Designation</div>
                                                <div class="fields col-md-8"><span id="desig"></span></div>
                                            </div>
                                            <div class=" fields row">
                                                <div class="fields col-md-4">Gender</div>
                                                <div class="fields col-md-8"><span id="gen"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="sickrecord" class="row tab-pane fade">
                                    <div id="leaverecord" class="leave-record">
                                        <div class="col-md-12 leave-search">
                                            <input class="search" placeholder="Search" />
                                        </div>
                                        <table class="col-lg-12 table-drugs">  
                                            <thead>  
                                                <tr>
                                                    <th class="sort text-center" data-sort="SLID" data-toggle="tooltip" data-placement="auto" title="Sort by Leave ID">leave ID</th>
                                                    <th class="sort text-center" data-sort="EMPID" data-toggle="tooltip" data-placement="auto" title="Sort by Employee ID">Emp. ID</th>
                                                    <th class="sort text-center" data-sort="RATE" data-toggle="tooltip" data-placement="auto" title="Sort by Rate">Rate</th>
                                                    <th class="sort text-center" data-sort="TYPE" data-toggle="tooltip" data-placement="auto" title="Sort by Patient Type">Patient Type</th>
                                                    <th class="sort text-center" data-sort="START" data-toggle="tooltip" data-placement="auto" title="Sort by Start Date">Start Date</th>
                                                    <th class="sort text-center" data-sort="END" data-toggle="tooltip" data-placement="auto" title="Sort by End Date">End Date</th>
                                                    <th class="sort text-center" data-sort="DAYS" data-toggle="tooltip" data-placement="auto" title="Sort by No. of days on leave">Days on Leave</th>
                                                    <th class="sort text-center" data-sort="DATE" data-toggle="tooltip" data-placement="auto" title="Sort by No. of days on leave">Entry Date</th>
                                                    <th class="text-center" data-toggle="tooltip" data-placement="auto" title="Options">Options</th>
                                                </tr>  
                                            </thead>

                                            <tbody class="list">
                                                <?php
                                                $sql_prescription = "SELECT s.*, d.*
                                                                         FROM sick_leave s, dependent d
                                                                         WHERE s.s_id=d.sid 
                                                                         ORDER BY s.sid DESC";
                                                $result = $mysqli->query($sql_prescription);
                                                while ($rows = $result->fetch_assoc()) {
                                                    //$rows['drugs_cat_id'];
                                                    echo "<tr>";
                                                    echo"<td class='SLID text-center'>" . $rows['s_id'] . "</td>";
                                                    echo"<td class='EMPID text-center'>" . $rows['emp_id'] . "</td>";
                                                    echo"<td class='RATE text-center'>" . $rows['rate'] . "</td>";
                                                    if ($rows['patientType'] == 'DEPENDENT') {
                                                        echo"<td class='TYPE text-center'>" . strtoupper($rows['relation']) . ' (' . strtoupper($rows['gender']) . ")</td>";
                                                    } else {
                                                        echo"<td class='TYPE text-center'>" . $rows['patientType'] . "</td>";
                                                    }

                                                    $s = new DateTime($rows['startDate']);
                                                    $e = new DateTime($rows['endDate']);
                                                    $d = new DateTime($rows['date']);
                                                    $start = $s->format('j-M-Y');
                                                    $end = $e->format('j-M-Y');
                                                    $date = $d->format('j-m-Y');

                                                    $days = $e->diff($s)->format("%a");
                                                    $days=$days+1;

                                                    echo"<td class='START text-center'>" . $start . "</td>";
                                                    echo"<td class='END text-center'>" . $end . "</td>";

                                                    echo"<td class='DAYS text-center'>" . $days . "</td>";
                                                    echo"<td class='DATE text-center'>" . $date . "</td>";
                                                    echo"<td class='text-center'>
                                                        <button id=\"btn-edit-drug\" data-toggle=\"modal\" data-target=\"#edit-drug\" onclick=\"edit_drug('" . $rows[''] . "')\"><i style='color:darkgreen;' data-toggle='tooltip' data-placement='auto' title='Edit' class='fa fa-wrench'></i></button>
                                                        &nbsp;&nbsp;
                                                        <button id=\"btn-delete-drug\" onclick=\"delete_drug('" . $rows[''] . "')\"><i style='color:red;' data-toggle='tooltip' data-placement='auto' title='Delete' class='fa fa-trash'></i></button>
                                                        </td>";
                                                    echo"</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <div class="text-right">
                                            <div class="pagination"></div>
                                        </div>
                                        <div>
                                            <p style="color: darkcyan;">*** click on column header to sort ***</p>
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

