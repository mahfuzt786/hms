
<?php
include 'includes/checkInvalidUser.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title >HMS : Employee Add</title>
        <?php require_once 'includes/html_main.php'; ?>
        <?php require_once 'includes/admin_init.php'; ?>
        <link href="css/list.css" rel="stylesheet"/>
        <link href="css/employee.css" rel="stylesheet"/>
        <script src="js/employee-add.js"></script>
        <script>
            $(document).ready(function() {
                $('[data-toggle="tooltip"]').tooltip({
                    container : 'body'
                });  
            });
        </script>
    </head>
    <body>

        <?php require_once('includes/menu_navbar.php'); ?>

        <div class="toggled-2" id="wrapper">
            <?php require_once('includes/menu_sidebar.php'); ?>
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container xyz">
                    <div class="row">

                        <div class="col-lg-12 content panel panel-default">
                            <div class="panel-heading heading">
                                <i class="fa fa-user"> Employee</i>
                            </div>
                            <div class="panel-body">
                                <div class="employee-add-content">
                                    <form action="" id="frm-add-employee">
                                        <div class="row employee-add-header">
                                            <div class=" col-md-3">
                                                <h4><span class="fa fa-plus"></span> Add Employee</h4>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6 head-info text-right">
                                                        <?php
                                                        $total = 0;
                                                        $sql = "SELECT employee.*
                                                                FROM wtfindin_hms.employee";
                                                        $arRes = $mysqli->query($sql);
                                                        if (!$arRes) {
                                                            throw new Exception($mysqli->error);
                                                        } else {
                                                            $total = mysqli_num_rows($arRes);
                                                            $total = $total + 1;
                                                        }
                                                        $egid = 'EMP100' . $total;
                                                        $egpfid = 'PF100' . $total;
                                                        ?>
                                                        Serial No. : <?php echo $total; ?>
                                                    </div>
                                                    <div class="col-md-6 head-info" style="border: none;">
                                                        <a href="employee.php" style="text-decoration: none;"><< Back</a>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="row field">
                                            <div class="col-md-2 head">Division</div>
                                            <div class="col-md-3">
                                                <select id="division" class="form-control input-group">
                                                    <option value="select">Select Division</option>
                                                    <?php
                                                    $sql = "SELECT division.*
                                                            FROM wtfindin_hms.division";
                                                    $arRes = $mysqli->query($sql);
                                                    while ($row = $arRes->fetch_assoc()) {
                                                        echo "<option value=" . $row['div_id'];
                                                        echo ">" . $row['div_name'];
                                                        echo "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3 field">
                                                <span style="border-right: 1px solid lightgrey; padding-right: 10px;"><i class="fa fa-question-circle"></i></span>
                                                <span style="border-right: 1px solid lightgrey; margin-left: 5px; padding-right: 10px;"><i class="fa fa-plus"></i></span>
                                                <span><i class="fa fa-wrench" style="margin-left: 5px;"></i></span>
                                            </div>
                                        </div>
                                        <div class="row field" style="padding-bottom: 10px;">
                                            <div class="col-md-2 head">Book</div>
                                            <div class="col-md-1 head">
                                                <label class="radio-inline">
                                                    <input type="radio" value="1"  id="I" name="book" >I
                                                </label>
                                            </div>
                                            <div class="col-md-1 head">
                                                <label class="radio-inline">
                                                    <input type="radio" value="2"  id="II" name="book" >II
                                                </label>
                                            </div>
                                            <div class="col-md-1 head">
                                                <label class="radio-inline">
                                                    <input type="radio" value="3" id="III" name="book">III
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row field">
                                            <div class="col-md-2 head">Employee ID</div>
                                            <div class="col-md-3">
                                                <input class="form-control input-group" type="text" id="emp-id" name='emp-id' placeholder="Example : <?php echo $egid; ?>"/>
                                            </div>
                                        </div>
                                        <div class="row field">
                                            <div class="col-md-2 head">PF ID</div>
                                            <div class="col-md-3">
                                                <input class="form-control input-group" type="text" id="pfid" name='pfid' placeholder="Example : <?php echo $egpfid; ?>"/>
                                            </div>
                                        </div>

                                        <div class="row field">
                                            <div class="col-md-2 head head-dropdown">Designation</div>
                                            <div class="col-md-3">
                                                <select id="des-id" class="form-control input-group">
                                                    <option value="select">Select Designation</option>
                                                    <?php
                                                    $sql = "SELECT employee_designation.*
                                                            FROM wtfindin_hms.employee_designation";
                                                    $arRes = $mysqli->query($sql);
                                                    while ($row = $arRes->fetch_assoc()) {
                                                        echo "<option value=" . $row['e_des_id'];
                                                        echo ">" . $row['e_des'];
                                                        echo "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3 field">
                                                <span style="border-right: 1px solid lightgrey; padding-right: 10px;"><i class="fa fa-plus"></i></span>
                                                <span><i class="fa fa-wrench" style="margin-left: 5px;"></i></span>
                                            </div>
                                        </div>

                                        <div class="row field">
                                            <div class="col-md-2 head">Name</div>
                                            <div class="col-md-3">
                                                <input class="form-control input-group" type="text" id="emp-name" name='emp-name'/>
                                            </div>
                                        </div>

                                        <div class="row row-field field">
                                            <div class="col-md-2 head">Gender</div>

                                            <div class="col-md-1 head">
                                                <label class="radio-inline">
                                                    <input type="radio" value="male"  id="male" name="emp-gender" >Male
                                                </label>
                                            </div>
                                            <div class="col-md-1 head">
                                                <label class="radio-inline">
                                                    <input type="radio" value="female" id="female" name="emp-gender">Female
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row field">
                                            <div class="col-md-2 head">Age</div>
                                            <div class="col-md-3">
                                                <input class="form-control input-group" maxlength="2" type="text" id="emp-age" name='emp-age' />
                                            </div>
                                        </div>
                                        <div class="row field">
                                            <div class="col-md-2 head">Salary</div>
                                            <div class="col-md-3">
                                                <input class="form-control input-group" maxlength="10" type="text" id="emp-salary" name='emp-salary'/>
                                            </div>
                                        </div>
                                        <div class="row field">
                                            <div class="col-md-2 head">Address</div>
                                            <div class="col-md-3">
                                                <textarea class="form-control" type="text" id="emp-address" name='emp-address'></textarea>
                                            </div>
                                        </div>
                                        <div class="row field">
                                            <div class="col-md-5 head">
                                                <button type="button" class="btn btn-block btn-primary" name="btn-add-employee-values" id="btn-add-employee-values">
                                                    <span class="fa fa-plus"></span> Add Employee</button>       
                                            </div>
                                        </div>
                                    </form>
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

