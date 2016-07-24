
<?php
include 'includes/checkInvalidUser.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title >HMS : Employee Detail</title>
        <?php require_once 'includes/html_main.php'; ?>
        <?php require_once 'includes/admin_init.php'; ?>
        <link href="css/list.css" rel="stylesheet"/>
        <link href="css/employee.css" rel="stylesheet"/>
        <script src=""></script>
        <script>
            $(document).ready(function() {
                var options = {
                    valueNames: [ 'sno', 'employeeid', 'name', 'designation', 'age', 'gender', 'salary', 'options' ],
                    page: 10,
                    plugins: [
                        ListPagination({
                            innerWindow: 3,
                            left: 2,
                            right: 2
                        })
                    ]
                };

                var employee = new List('employee', options);
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
                                <i class="fa fa-user"> Employee Details</i>
                            </div>
                            <div class="mapping">

                            </div>
                            <div class="panel-body">
                                <!--Employee's Personal Details-->
                                <?php
                                $id = $_GET[id];
                                $sql = "SELECT employee.*
                                        FROM wtfindin_hms.employee
                                        WHERE e_id='$id'";
                                $arRes = $mysqli->query($sql);
                                if (!$arRes) {
                                    throw new Exception($mysqli->error);
                                }

                                if (mysqli_num_rows($arRes) == 0) {
                                    throw new Exception($mysqli->error);
                                } else {
                                    $row = $arRes->fetch_object();
                                    $empid = $row->e_emp_id;
                                    $desid = $row->e_des_id;

                                    $sql1 = "SELECT employee_designation.*
                                        FROM wtfindin_hms.employee_designation
                                        WHERE e_des_id='$desid'";
                                    $arRes1 = $mysqli->query($sql1);
                                    if (!$arRes1) {
                                        throw new Exception($mysqli->error);
                                    }

                                    if (mysqli_num_rows($arRes1) == 0) {
                                        throw new Exception($mysqli->error);
                                    } else {
                                        $row1 = $arRes1->fetch_object();
                                        $designation = $row1->e_des;
                                    }

                                    $name = $row->e_name;
                                    $salary = $row->e_salary;
                                    $age = $row->e_age;
                                    $gender = $row->e_gender;
                                    $address = $row->e_address;
                                }
                                ?>
                                <div class="panel panel-primary" style="margin-top: -10px;">
                                    <div class="panel-heading">
                                        <b><?php echo $empid; ?> <a href="employee.php" style="float: right; color: white; display: inline;"> <i class="fa fa-arrow-left"></i> Back </a></b>
                                    </div>
                                    <div class="panel-body empdetail">
                                        <div class="row row-mod">
                                            <div class="col-md-2">Name</div>
                                            <div class="col-md-10"><?php echo $name; ?></div>
                                        </div>
                                        <div class="row row-mod">
                                            <div class="col-md-2">Designation</div>
                                            <div class="col-md-10"><?php echo $designation; ?></div>
                                        </div>
                                        <div class="row row-mod">
                                            <div class="col-md-2">Age</div>
                                            <div class="col-md-10"><?php echo $age; ?></div>
                                        </div>
                                        <div class="row row-mod">
                                            <div class="col-md-2">Gender</div>
                                            <div class="col-md-10"><?php echo $gender; ?></div>
                                        </div>
                                        <div class="row row-mod">
                                            <div class="col-md-2">Salary</div>
                                            <div class="col-md-10"><?php echo $salary; ?></div>
                                        </div>
                                        <div class="row row-mod">
                                            <div class="col-md-2">Address</div>
                                            <div class="col-md-10"><?php echo $address; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <!--end of Employee's Personal Details-->


                                <div class="panel panel-primary">
                                    <div class="panel-heading"><i class="fa fa-file"></i> Prescription List</div>
                                    <div class="panel-body">
                                        
                                        <!--Prescription List-->
                                        <div id="employee">
                                            <div class="col-md-12 head_employee_2">
                                                <input class="search" placeholder="Search" />
                                            </div>
                                            <table class="col-lg-12 table-drugs">  
                                                <thead>  
                                                    <tr>
                                                        <th class="sort text-center" data-sort="sno" data-toggle="tooltip" data-placement="auto" title="Sort by Serial No">#</th>
                                                        <th class="sort text-center" data-sort="employeeid" data-toggle="tooltip" data-placement="auto" title="Sort by Employee ID">ID</th>
                                                        <th class="sort text-center" data-sort="name" data-toggle="tooltip" data-placement="auto" title="Sort by Name">Name</th>
                                                        <th class="sort text-center" data-sort="designation" data-toggle="tooltip" data-placement="auto" title="Sort by Designation">Designation</th>
                                                        <th class="sort text-center" data-sort="age" data-toggle="tooltip" data-placement="auto" title="Sort by Age">Age</th>
                                                        <th class="sort text-center" data-sort="gender" data-toggle="tooltip" data-placement="auto" title="Sort by Gender">Gender</th>
                                                        <th class="sort text-center" data-sort="salary" data-toggle="tooltip" data-placement="auto" title="Sort by Salary">Salary</th>
                                                        <th class="text-center" data-toggle="tooltip" data-placement="auto" title="Options">Options</th>
                                                    </tr>  
                                                </thead>

                                                <tbody class="list">
                                                    <?php
                                                    $sno = 1;
                                                    $sql_drugs = "SELECT wtfindin_hms.employee.*
                                                                FROM wtfindin_hms.employee
                                                                WHERE isActive='Y'
                                                                ORDER BY e_id DESC";
                                                    $result = $mysqli->query($sql_drugs);
                                                    while ($rows = $result->fetch_assoc()) {
                                                        //$rows['drugs_cat_id'];
                                                        echo "<tr>";
                                                        echo"<td class='sno text-center'>" . $sno . "</td>";
                                                        echo"<td class='employeeid'><a href=\"employee-detail.php?id=" . $rows['e_id'] . "\">" . $rows['e_emp_id'] . "</a></td>";
                                                        echo"<td class='name'>" . $rows['e_name'] . "</td>";

                                                        $eid = $rows['e_des_id'];
                                                        $sql_employee_designation = "SELECT employee_designation.*
                                                                FROM wtfindin_hms.employee_designation
                                                                WHERE e_des_id='$eid'";
                                                        $result2 = $mysqli->query($sql_employee_designation);
                                                        $row = $result2->fetch_assoc();

                                                        echo"<td class='designation'>" . $row['e_des'] . "</td>";
                                                        echo"<td class='age text-center'>" . $rows['e_age'] . "</td>";
                                                        echo"<td class='gender text-center'>" . $rows['e_gender'] . "</td>";
                                                        echo"<td class='salary text-center'>" . $rows['e_salary'] . "</td>";
                                                        echo"<td class='text-center'>
                                                        <button id=\"btn-edit-drug\" data-toggle=\"modal\" data-target=\"#edit-drug\" onclick=\"edit_drug('" . $rows['drugs_id'] . "')\"><i style='color:darkgreen;' data-toggle='tooltip' data-placement='auto' title='Edit' class='fa fa-wrench'></i></button>
                                                        &nbsp;&nbsp;
                                                        <button id=\"btn-delete-drug\" onclick=\"delete_drug('" . $rows['drugs_id'] . "')\"><i style='color:red;' data-toggle='tooltip' data-placement='auto' title='Delete' class='fa fa-trash'></i></button>
                                                        </td>";
                                                        echo"</tr>";
                                                        $sno = $sno + 1;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <div class="text-right">
                                                <div id="drug" class="pagination"></div>
                                            </div>
                                            <div>
                                                <p style="color: darkcyan;">*** click on column header to sort ***</p>
                                            </div>
                                        </div>
                                        <!--End of prescription list-->

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
    </div>
    <!-- /#wrapper -->
    <script src="js/profile.js"></script>

    <!--body div-->

</body>
</html>

