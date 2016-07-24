
<?php
include 'includes/checkInvalidUser.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title >HMS : Manage Drugs</title>
        <?php require_once 'includes/html_main.php'; ?>
        <?php require_once 'includes/admin_init.php'; ?>
        <link href="css/list.css" rel="stylesheet"/>
        <link href="css/manage_drugs.css" rel="stylesheet"/>
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
                    valueNames: [ 'sno', 'drugsname', 'category', 'price', 'man_date', 'exp_date', 'quantity', 'options' ],
                    page: 5,
                    plugins: [
                        ListPagination({
                            innerWindow: 3,
                            left: 2,
                            right: 2
                        })
                    ]
                };
                var options_expiry = {
                    valueNames: [ 'sno', 'drugsname', 'category', 'price', 'man_date', 'exp_date', 'quantity', 'options' ],
                    page: 5,
                    plugins: [
                        ListPagination({
                            innerWindow: 3,
                            left: 2,
                            right: 2
                        })
                    ]
                };

                var drugs = new List('drugs', options);
                var drugsexp = new List('drugsexp', options_expiry);
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
                                <i class="fa fa-medkit"> Drugs</i>
                            </div>
                            <div class="mapping">Drugs :: <a href="drugs.php">Drugs Category</a> :: <a href="manage-drugs.php">Manage Drugs</a></div>
                            <div class="panel-body">

                                <div class="">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#drugs"><i class="fa fa-plus-square"></i> Drugs</a></li>
                                        <li><a href="#expired-drugs">Expired Drugs</a></li>
                                    </ul>
                                    <div class="tab-content tab-drugs">
                                        <div id="drugs" class="tab-pane fade in active">
                                            <div id="drugs">
                                                <div class="col-md-2 head_drugs">
                                                    <button type="button" class="btn btn-block btn-primary" name="btn-add-managedrugs" id="btn-add-managedrugs" data-toggle="modal" data-target="#manage-drugs">
                                                        <span class="fa fa-plus"></span> Add Drugs</button> 
                                                </div>
                                                <div class="col-md-4"></div>
                                                <div class="col-md-6 head_drugs_2">
                                                    <input class="search" placeholder="Search" />
                                                </div>
                                                <table class="col-lg-12 table-drugs">  
                                                    <thead>  
                                                        <tr>
                                                            <th class="sort text-center" data-sort="sno" data-toggle="tooltip" data-placement="auto" title="Sort by Serial No">#</th>
                                                            <th class="sort text-center" data-sort="drugsname" data-toggle="tooltip" data-placement="auto" title="Sort by Drug Name">Name</th>
                                                            <th class="sort text-center" data-sort="category" data-toggle="tooltip" data-placement="auto" title="Sort by Category">Category</th>
                                                            <th class="sort text-center" data-sort="price" data-toggle="tooltip" data-placement="auto" title="Sort by Price">Price</th>
                                                            <th class="sort text-center" data-sort="man_date" data-toggle="tooltip" data-placement="auto" title="Sort by Manufacturing Date">Manufacturing Date</th>
                                                            <th class="sort text-center" data-sort="exp_date" data-toggle="tooltip" data-placement="auto" title="Sort by Expiry Date">Expiry Date</th>
                                                            <th class="sort text-center" data-sort="quantity" data-toggle="tooltip" data-placement="auto" title="Sort by Quantity">Quantity</th>
                                                            <th class="text-center" data-toggle="tooltip" data-placement="auto" title="Options">Options</th>
                                                        </tr>  
                                                    </thead>

                                                    <tbody class="list">
                                                        <?php
                                                        $sno = 1;
                                                        $sql_drugs = "SELECT wtfindin_hms.drugs.*
                                                                FROM wtfindin_hms.drugs
                                                                WHERE isAvailable='Y'
                                                                ORDER BY drugs_id DESC";
                                                        $result = $mysqli->query($sql_drugs);
                                                        while ($rows = $result->fetch_assoc()) {
                                                            //$rows['drugs_cat_id'];
                                                            echo "<tr>";
                                                            echo"<td class='sno text-center'>" . $sno . "</td>";
                                                            echo"<td class='drugsname' data-toggle=\"modal\" data-target=\"#drug-detail\" onclick=\"show_drug('" . $rows['drugs_id'] . "')\">" . $rows['drugs_name'] . "</td>";


                                                            $catid = $rows['drugs_cat_id'];
                                                            $sql_drugscategory = "SELECT drugscategory.drugs_cat
                                                                FROM wtfindin_hms.drugscategory
                                                                WHERE drugs_cat_id='$catid'";
                                                            $result2 = $mysqli->query($sql_drugscategory);
                                                            $row = $result2->fetch_assoc();
                                                            echo"<td class='category'>" . $row['drugs_cat'] . "</td>";


                                                            echo"<td class='price'><i class=\"fa fa-rupee\"> </i>&nbsp;" . $rows['drugs_price'] . "</td>";
                                                            echo"<td class='man_date text-center'>" . $rows['drugs_manufacturing_date'] . "</td>";
                                                            echo"<td class='exp_date text-center'>" . $rows['drugs_expiry_date'] . "</td>";
                                                            echo"<td class='quantity text-center'>" . $rows['drugs_quantity'] . "</td>";
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

                                        <!--second tab-->
                                        <div id="expired-drugs" class="tab-pane fade">
                                            <div id="drugsexp">
                                                <div class="col-md-6"></div>
                                                <div class="col-md-6 head_drugs_2">
                                                    <input class="search" placeholder="Search" />
                                                </div>
                                                <table class="col-lg-12 table-drugs">  
                                                    <thead>  
                                                        <tr>
                                                            <th class="sort text-center" data-sort="sno" data-toggle="tooltip" data-placement="auto" title="Sort by Serial No">#</th>
                                                            <th class="sort text-center" data-sort="drugsname" data-toggle="tooltip" data-placement="auto" title="Sort by Drug Name">Name</th>
                                                            <th class="sort text-center" data-sort="category" data-toggle="tooltip" data-placement="auto" title="Sort by Category">Category</th>
                                                            <th class="sort text-center" data-sort="price" data-toggle="tooltip" data-placement="auto" title="Sort by Price">Price</th>
                                                            <th class="sort text-center" data-sort="man_date" data-toggle="tooltip" data-placement="auto" title="Sort by Manufacturing Date">Manufacturing Date</th>
                                                            <th class="sort text-center" data-sort="exp_date" data-toggle="tooltip" data-placement="auto" title="Sort by Expiry Date">Expiry Date</th>
                                                            <th class="sort text-center" data-sort="quantity" data-toggle="tooltip" data-placement="auto" title="Sort by Quantity">Quantity</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="list">
                                                        <?php
                                                        $sno = 1;
                                                        $sql_drugs = "SELECT wtfindin_hms.drugs.*
                                                                FROM wtfindin_hms.drugs
                                                                WHERE isAvailable='N'
                                                                ORDER BY drugs_id DESC";
                                                        $result = $mysqli->query($sql_drugs);
                                                        while ($rows = $result->fetch_assoc()) {
                                                            //$rows['drugs_cat_id'];
                                                            echo "<tr>";
                                                            echo"<td class='sno text-center'>" . $sno . "</td>";
                                                            echo"<td class='drugsname' data-toggle=\"modal\" data-target=\"#drug-detail\" onclick=\"show_drug('" . $rows['drugs_id'] . "')\">" . $rows['drugs_name'] . "</td>";


                                                            $catid = $rows['drugs_cat_id'];
                                                            $sql_drugscategory = "SELECT drugscategory.drugs_cat
                                                                FROM wtfindin_hms.drugscategory
                                                                WHERE drugs_cat_id='$catid'";
                                                            $result2 = $mysqli->query($sql_drugscategory);
                                                            $row = $result2->fetch_assoc();
                                                            echo"<td class='category'>" . $row['drugs_cat'] . "</td>";


                                                            echo"<td class='price'><i class=\"fa fa-rupee\"> </i>&nbsp;" . $rows['drugs_price'] . "</td>";
                                                            echo"<td class='man_date text-center'>" . $rows['drugs_manufacturing_date'] . "</td>";
                                                            echo"<td class='exp_date text-center'>" . $rows['drugs_expiry_date'] . "</td>";
                                                            echo"<td class='quantity text-center'>" . $rows['drugs_quantity'] . "</td>";
                                                            echo"</tr>";
                                                            $sno = $sno + 1;
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

                    </div>
                </div>
                <!-- /#page-content-wrapper -->
            </div>
            <!-- /#wrapper -->
            <script src="js/profile.js"></script>

            <!--drugs details Modal -->
            <div class="modal fade" id="drug-detail" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><span class="fa fa-plus-square-o"></span> Drug Detail</h4>
                        </div>
                        <div class="modal-body ">
                            <div class="druginfo row">
                                <div class="col-md-4"><label>Name</label></div>
                                <div class="col-md-8"><label id="d_name"></label></div>
                                <div class="col-md-4"><label>Category</label></div>
                                <div class="col-md-8"><label id="d_cat"></label></div>
                                <div class="col-md-4"><label>Description</label></div>
                                <div class="col-md-8"><label id="d_desc"></label></div>
                                <div class="col-md-4"><label>Manufacturing Company</label></div>
                                <div class="col-md-8"><label id="d_company"></label></div>
                                <div class="col-md-4"><label>Price</label></div>
                                <div class="col-md-8"><label id="d_price"></label></div>
                                <div class="col-md-4"><label>Manufacturing Date</label></div>
                                <div class="col-md-8"><label id="d_md"></label></div>
                                <div class="col-md-4"><label>Expiry Date</label></div>
                                <div class="col-md-8"><label id="d_ed"></label></div>
                                <div class="col-md-4"><label>Quantity</label></div>
                                <div class="col-md-8"><label id="d_quantity"></label></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
            <!--end of add category modal-->


            <!--add Drugs Modal -->
            <div class="modal fade" id="manage-drugs" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><span class="fa fa-plus"></span> Add Drug</h4>
                        </div>
                        <div class="modal-body">
                            <div>
                                <form action="" id="frm-add-drugs">
                                    <!--<input type="hidden" id="id" value="<?//php echo $id; ?>"/>-->
                                    <div class="form-group ">
                                        <select class="form-control option-control" id="drugs-category" name='drugs-category'>
                                            <option value="select">Select Category</option>
                                            <?php
                                            $sql_drugs_category = "SELECT wtfindin_hms.drugscategory.*
                                                                FROM wtfindin_hms.drugscategory";
                                            $result = $mysqli->query($sql_drugs_category);
                                            while ($rows = $result->fetch_assoc()) {
                                                echo "<option value=" . $rows['drugs_cat_id'] . ">";
                                                echo $rows['drugs_cat'];
                                                echo "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <input class="form-control" type="text" id="drugs-name" name='drugs-name' autocomplete="off" placeholder="Drug Name"/>  
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" type="text" id="drugs-description" name='drugs-description' placeholder="Drug Description"></textarea>
                                    </div>
                                    <div class="form-group ">
                                        <input class="form-control" type="text" id="drugs-price" pattern="\d+(\.\d{2})?" name='drugs-price' autocomplete="off" placeholder="Drug Price"/>  
                                    </div>
                                    <div class="form-group ">
                                        <input class="form-control" type="text" id="drugs-company" name='drugs-company' autocomplete="off" placeholder="Drug Company"/>  
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="text" value="" readonly id="drugs-manu-date" name='drugs-manu_date' autocomplete="off" placeholder="Drug Manufacturing Date"/>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="text" value="" readonly id="drugs-exp-date" name='drugs-exp-date' autocomplete="off" placeholder="Drug Expiry Date"/>  
                                    </div>
                                    <div class="form-group ">
                                        <input class="form-control" type="text" id="drugs-quantity" name='drugs-quantity' autocomplete="off" placeholder="Drug Quantity"/>  
                                    </div>
                                    <div class="form-group input-group col-md-12">
                                        <button type="button" class="btn btn-block btn-primary" name="btn-add-category-values" id="btn-add-drugs-values">
                                            <span class="fa fa-plus"></span> Add Drug</button>       
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
            <!--end of add drugs modal-->

            <!--edit Category Modal -->
            <div class="modal fade" id="edit-drug" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><span class="fa fa-pencil"></span> Edit Drug Details</h4>
                        </div>
                        <div class="modal-body">
                            <div>
                                <form action="" id="frm-edit-drugs">
                                    <input type="hidden" id="did" value=""/>
                                    <input type="hidden" id="catid" value=""/>
                                    <div class="form-group ">
                                        <select class="form-control option-control" id="drugs-category-edit" name='drugs-category-edit'>
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <input class="form-control" type="text" id="drugs-name-edit" name='drugs-name-edit' autocomplete="off" placeholder="Drug Name"/>  
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" type="text" id="drugs-description-edit" name='drugs-description-edit' placeholder="Drug Description"></textarea>
                                    </div>
                                    <div class="form-group ">
                                        <input class="form-control" type="text" id="drugs-price-edit" pattern="\d+(\.\d{2})?" name='drugs-price-edit' autocomplete="off" placeholder="Drug Price"/>  
                                    </div>
                                    <div class="form-group ">
                                        <input class="form-control" type="text" id="drugs-company-edit" name='drugs-company-edit' autocomplete="off" placeholder="Drug Company"/>  
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="text" value="" readonly id="drugs-manu-date-edit" name='drugs-manu_date-edit' autocomplete="off" placeholder="Drug Manufacturing Date"/>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="text" value="" readonly id="drugs-exp-date-edit" name='drugs-exp-date-edit' autocomplete="off" placeholder="Drug Expiry Date"/>  
                                    </div>
                                    <div class="form-group ">
                                        <input class="form-control" type="text" id="drugs-quantity-edit" name='drugs-quantity-edit' autocomplete="off" placeholder="Drug Quantity"/>  
                                    </div>
                                    <div class="form-group input-group col-md-12">
                                        <button type="button" class="btn btn-block btn-success" name="btn-edit-drugs-values" id="btn-edit-drugs-values">
                                            <span class="fa fa-pencil"></span> Edit Drug</button>       
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
            <!--end edit category modal-->

            <!--body div-->

    </body>
</html>

