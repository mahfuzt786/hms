
<?php
include 'includes/checkInvalidUser.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title >HMS : Employee</title>
        <?php require_once 'includes/html_main.php'; ?>
        <?php require_once 'includes/admin_init.php'; ?>
        <link href="css/list.css" rel="stylesheet"/>
        <link href="css/employee.css" rel="stylesheet"/>
        <script src="js/manage_drugs.js"></script>
        <script>
            function show_drug(id){
                $.ajax({
                    url: "includes/login-check.php",
                    type: "POST",
                    data: {
                        action: 'show_drug',
                        id: id
                    },
                    success: function(result){
                        var arr = $.parseJSON(result);
                        /*$.each(arr, function(k, v) {
                            //display the key and value pair
                            alert(k + ' is ' + v);
                        });*/
        
                        $('label#d_cat').text(': '+ arr[0]);
                        $('label#d_name').text(': '+ arr[1]);
                        $('label#d_desc').text(': '+ arr[2]);
                        $('label#d_company').text(': '+ arr[4]);
                        $('label#d_price').text(': '+ arr[3]);
                        $('label#d_md').text(': '+ arr[6]);
                        $('label#d_ed').text(': '+ arr[7]);
                        $('label#d_quantity').text(': '+ arr[5]);
                        

                    }
                });
            }
            function edit_drug(id) {
                $('#did').val(id);
                $.ajax({
                    url: "includes/login-check.php",
                    type: "POST",
                    data: {
                        action: 'retrieve_drug_detail',
                        id: id
                    },
                    success: function(result){
                        var arr = $.parseJSON(result);
                        /*$.each(arr, function(k, v) {
                            //display the key and value pair
                            alert(k + ' is ' + v);
                        });*/
                        $('input#catid').val(arr[0]);
                        var cid= $('input#catid').val(); 
                        //alert (cid);
                        $.ajax({
                            url: "includes/login-check.php",
                            type: "POST",
                            data: {
                                action: 'retrieve_drug_category'
                            },
                            success: function(result){
                                content='';
                                var arr = $.parseJSON(result);
                                content+='<option value="select">Select Category</option>';
                                $.each(arr, function(k, v) {
                                    if(cid==k){
                                        content+='<option value="' + k +'" selected>' + v + '</option>';
                                    }else{
                                        content+='<option value="' + k +'">' + v + '</option>';
                                    }
                                });
                                $('#drugs-category-edit').html(content); 
                            }
                                                    
                        });
                        $('input#drugs-name-edit').val(arr[1]);
                        $('textarea#drugs-description-edit').text(arr[2]);
                        $('input#drugs-price-edit').val(arr[3]);
                        $('input#drugs-company-edit').val(arr[4]);
                        $('input#drugs-manu-date-edit').val(arr[5]);
                        $('input#drugs-exp-date-edit').val(arr[6]);
                        $('input#drugs-quantity-edit').val(arr[7]);
                        

                    }
                });
                
            }
            function delete_drug(id){
                Lobibox.confirm({
                    msg: "Are you sure you want to delete this Drug?",
                    callback: function ($this, type, ev) {
                        //Your code goes here
                        if(type=='yes'){
                            $.ajax({
                                url: "includes/login-check.php",
                                type: "POST",
                                data: {
                                    action: 'delete_drug',
                                    id: id
                                },
                                success: function(result){
                                    if(result=='done') {
                                        Lobibox.alert("success",
                                        {
                                            msg: 'Drug Successfully Deleted ',
                                            callback: function ($this, type, ev) {
                                                if(type=='ok'){
                                                    location.replace('manage-drugs.php');}
                                            }
                                        });
                                        if($('.lobibox'))
                                        {
                                            $('.lobibox .lobibox-btn').focus();
                                        }
                                    }
                                    else {
                                        Lobibox.alert("error",
                                        {
                                            msg: result
                                        });
                                    }
                                }
                            });
                        }
                    }
                });
            }
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
                                <i class="fa fa-user"> Employee</i>
                            </div>
                            <div class="mapping">Employee :: <a href="employee-add.php">Add Employee</a></div>
                            <div class="panel-body">
                                <div id="employee">
                                    <div class="col-md-2 head_employee">
                                        <button type="button" onClick="window.location='employee-add.php';" class="btn btn-block btn-primary" name="btn-add-employee" id="btn-add-employee">
                                            <span class="fa fa-plus"></span> Add Employee</button> 
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-6 head_employee_2">
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
                                                                WHERE e_status='active'
                                                                ORDER BY e_id DESC";
                                            $result = $mysqli->query($sql_drugs);
                                            while ($rows = $result->fetch_assoc()) {
                                                //$rows['drugs_cat_id'];
                                                echo "<tr>";
                                                echo"<td class='sno text-center'>" . $sno . "</td>";
                                                echo"<td class='employeeid' data-toggle=\"modal\" data-target=\"#drug-detail\" onclick=\"show_drug('" . $rows['e_id'] . "')\">" . $rows['e_emp_id'] . "</td>";
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

