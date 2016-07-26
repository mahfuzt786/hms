
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
            var oTable = $('#listmedicine').dataTable();
            function show_drug(id){
                $.ajax({
                    url: "includes/login-check.php",
                    type: "POST",
                    data: {
                        action: 'show_medicine_list',
                        id: id
                    },
                    success: function(result){
                        var arr = JSON.parse(result);
                        var i;
                        var out = "";
                        for(i = 0; i < arr.length; i++) {
                            out += "<tr><td>" +
                                arr[i].Name +
                                "</td><td>" +
                                arr[i].Category +
                                "</td><td>" +
                                arr[i].Quantity +
                                "</td><td>" +
                                arr[i].Total +
                                "</td></tr>";
                        }
                        out += "";
                        document.getElementById("druglist").innerHTML = out;    
                    }
                });
            }
            $(document).ready(function() {
                
                var options = {
                    valueNames: [ 'pid', 'doctor', 'date', 'remark', 'note' ],
                    page: 5,
                    plugins: [
                        ListPagination({
                            innerWindow: 3,
                            left: 2,
                            right: 2
                        })
                    ]
                };
                var prescription_details = new List('prescription-details', options);
                var options2 = {
                    valueNames: [ 'drugname', 'drugcategory', 'drugquantity', 'drugtotal' ],
                    page: 5,
                    plugins: [
                        ListPagination({
                            innerWindow: 3,
                            left: 2,
                            right: 2
                        })
                    ]
                };
                var medicine = new List('md', options2);
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
                                        <div id="prescription-details">
                                            <div class="col-md-12 head_employee_2">
                                                <input class="search" placeholder="Search" />
                                            </div>
                                            <table class="col-lg-12 table-drugs">  
                                                <thead>  
                                                    <tr>
                                                        <th class="sort text-center" width="20%" data-sort="pid" data-toggle="tooltip" data-placement="auto" title="Sort by Prescription ID">Prescription ID</th>
                                                        <th class="sort text-center" width="20%" data-sort="doctor" data-toggle="tooltip" data-placement="auto" title="Sort by Doctor">Doctor</th>
                                                        <th class="sort text-center" width="20%" data-sort="date" data-toggle="tooltip" data-placement="auto" title="Sort by Date">Date</th>
                                                        <th class="sort text-center" width="20%" data-sort="remark" data-toggle="tooltip" data-placement="auto" title="Sort by Remark">Remark</th>
                                                        <th class="sort text-center" width="20%" data-sort="note" data-toggle="tooltip" data-placement="auto" title="Sort by Note">Note</th>
                                                    </tr>  
                                                </thead>

                                                <tbody class="list">
                                                    <?php
                                                    $sql_prescription = "SELECT p.p_id, d.d_name, p.p_date, p.p_remark, p.p_note
                                                                         FROM prescription p, doctor d, employee e
                                                                         WHERE p.doctor_id=d.d_id AND p.employee_id=e.e_emp_id AND e.e_id='$id'
                                                                         ORDER BY p.p_id DESC";
                                                    $result_prescription = $mysqli->query($sql_prescription);
                                                    if (mysqli_num_rows($result_prescription) == 0) {
                                                        echo "<tr><td class='text-center' colspan='5'>";
                                                        echo "<b>NO RECORD FOUND</b>";
                                                        echo "</td></tr>";
                                                    } else {
                                                        while ($row_p = $result_prescription->fetch_assoc()) {
                                                            //$rows['drugs_cat_id'];
                                                            echo "<tr>";
                                                            echo"<td class='pid text-center' data-toggle=\"modal\" data-target=\"#medicineList\" onclick=\"show_drug('" . $row_p['p_id'] . "')\"> <div class='emp-detail'>" . $row_p['p_id'] . "</div> </td>";
                                                            echo"<td class='doctor'>" . $row_p['d_name'] . "</td>";

                                                            $dt = new DateTime($row_p['date']);
                                                            $date = $dt->format('j-M-Y, g:i A');

                                                            echo"<td class='date text-center'>" . $date . "</td>";
                                                            echo"<td class='remark'>" . $row_p['p_remark'] . "</td>";
                                                            echo"<td class='note'>" . $row_p['p_note'] . "</td>";
                                                        }
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

    <!--edit medicine list Modal -->
    <div class="modal fade" id="medicineList" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-file-o"></span> Medicine List</h4>
                </div>
                <div class="modal-body">
                    <!--Prescription List-->
                    <div id="md">

                        <div class="col-md-12 head_employee_2">
                            <input class="search" placeholder="Search" />
                        </div>
                        <table class="col-md-12 table-drugs" id="listmedicine">  
                            <thead>  
                                <tr>
                                    <th class="sort text-center" width="20%" data-sort="drugdrug" data-toggle="tooltip" data-placement="auto" title="Sort by Drug Name">Drug Name</th>
                                    <th class="sort text-center" width="20%" data-sort="drugcategory" data-toggle="tooltip" data-placement="auto" title="Sort by Doctor">Category</th>
                                    <th class="sort text-center" width="20%" data-sort="drugquantity" data-toggle="tooltip" data-placement="auto" title="Sort by Date">Quantity</th>
                                    <th class="sort text-center" width="20%" data-sort="drugtotal" data-toggle="tooltip" data-placement="auto" title="Sort by Remark">Total</th>
                                </tr>  
                            </thead>
                            <tbody class="list" id="druglist">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <!--end edit Medicine list modal-->

</body>
</html>

