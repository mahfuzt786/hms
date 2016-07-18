
<?php
include 'includes/checkInvalidUser.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title >HMS : Drugs Category</title>
        <?php require_once 'includes/html_main.php'; ?>
        <?php require_once 'includes/admin_init.php'; ?>
        <link href="css/list.css" rel="stylesheet"/>
        <link href="css/drugs_category.css" rel="stylesheet"/>
        <script src="js/drugs_category.js"></script>
        <script>
            
            function edit_cat(id) {
                $('#catid').val(id);
                $.ajax({
                    url: "includes/login-check.php",
                    type: "POST",
                    data: {
                        action: 'cat',
                        id: id
                    },
                    success: function(result){
                        $('#edit-drugs-category').val(result);
                    }
                });
                $.ajax({
                    url: "includes/login-check.php",
                    type: "POST",
                    data: {
                        action: 'catdesc',
                        id: id
                    },
                    success: function(result){
                        $('#edit-drugs-category-description').val(result);
                    }
                });
            }
            function delete_cat(id){
                Lobibox.confirm({
                    msg: "Are you sure you want to delete this Category?",
                    callback: function ($this, type, ev) {
                        //Your code goes here
                        if(type=='yes'){
                            $.ajax({
                                url: "includes/login-check.php",
                                type: "POST",
                                data: {
                                    action: 'delete_cat',
                                    id: id
                                },
                                success: function(result){
                                    if(result=='done') {
                                        Lobibox.alert("success",
                                        {
                                            msg: 'Drugs Category Successfully Deleted ',
                                            callback: function ($this, type, ev) {
                                                if(type=='ok'){
                                                    location.replace('drugs.php');}
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
                    valueNames: [ 'sno', 'category', 'category_desc', 'options' ],
                    page: 5,
                    plugins: [
                        ListPagination({
                            innerWindow: 3,
                            left: 2,
                            right: 2
                        })
                    ]
                };

                var drugsList = new List('drugsCategory', options);
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
                                <div class="panel panel-default">
                                    <div class="panel-heading heading"><i class="fa fa-plus-circle"> Drugs Category</i></div>
                                    <div class="panel-body">
                                        <div id="drugsCategory">
                                            <div class="col-md-2 head_cat">
                                                <button type="button" class="btn btn-block btn-primary" name="btn-add-category" id="btn-add-category" data-toggle="modal" data-target="#add-category">
                                                    <span class="fa fa-plus"></span> Add Drugs Category</button> 
                                            </div>
                                            <div class="col-md-4"></div>
                                            <div class="col-md-6 head_cat_2">
                                                <input class="search" placeholder="Search" />
                                            </div>
                                            <table class="col-lg-12 table-drugs-category">  
                                                <thead>  
                                                    <tr>
                                                        <th class="sort text-center" data-sort="sno" data-toggle="tooltip" data-placement="auto" title="Sort by Serial No">#</th>
                                                        <th class="sort text-center" data-sort="category" data-toggle="tooltip" data-placement="auto" title="Sort by Category">Category</th>
                                                        <th class="sort text-center" data-sort="category_desc" data-toggle="tooltip" data-placement="auto" title="Sort by Category Description">Category Description</th>
                                                        <th class="text-center" data-toggle="tooltip" data-placement="auto" title="Options">Options</th>
                                                    </tr>  
                                                </thead>

                                                <tbody class="list">
                                                    <?php
                                                    $sno = 1;
                                                    $sql_drugscategory = "SELECT drugscategory.*
                                                                FROM wtfindin_hms.drugscategory
                                                                ORDER BY drugs_cat_id DESC";
                                                    $result = $mysqli->query($sql_drugscategory);
                                                    while ($rows = $result->fetch_assoc()) {
                                                        //$rows['drugs_cat_id'];
                                                        echo "<tr>";
                                                        echo"<td class='sno text-center'>" . $sno . "</td>";
                                                        echo"<td class='category'>" . $rows['drugs_cat'] . "</td>";
                                                        echo"<td class='category_desc'>" . $rows['drugs_cat_desc'] . "</td>";
                                                        echo"<td class='text-center'>
                                                        <button id=\"btn-edit-category\" data-toggle=\"modal\" data-target=\"#edit-category\" onclick=\"edit_cat('" . $rows['drugs_cat_id'] . "')\"><i style='color:darkgreen;' data-toggle='tooltip' data-placement='auto' title='Edit' class='fa fa-wrench'></i></button>
                                                        &nbsp;&nbsp;
                                                        <button id=\"btn-delete-category\" onclick=\"delete_cat('" . $rows['drugs_cat_id'] . "')\"><i style='color:red;' data-toggle='tooltip' data-placement='auto' title='Delete' class='fa fa-trash'></i></button>
                                                        </td>";
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
                <!-- /#page-content-wrapper -->
            </div>
            <!-- /#wrapper -->
            <script src="js/profile.js"></script>

            <!--add Category Modal -->
            <div class="modal fade" id="add-category" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><span class="fa fa-plus"></span> Add Drugs Category</h4>
                        </div>
                        <div class="modal-body">
                            <div>
                                <form action="" id="frm-add-category">
                                    <!--<input type="hidden" id="id" value="<?php echo $id; ?>"/>-->
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-plus"></i></span>
                                        <input class="form-control" type="text" id="drugs-category" name='drugs-category' autocomplete="off" placeholder="Drugs Category"/>  
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <textarea class="form-control" type="text" id="drugs-category-description" name='drugs-category-description' placeholder="Drugs Category Description"></textarea>
                                    </div>
                                    <div class="form-group input-group col-md-12">
                                        <button type="button" class="btn btn-block btn-primary" name="btn-add-category-values" id="btn-add-category-values">
                                            <span class="fa fa-plus"></span> Add Category</button>       
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
            <!--end of add category modal-->

            <!--edit Category Modal -->
            <div class="modal fade" id="edit-category" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><span class="fa fa-pencil"></span> Edit Drugs Category</h4>
                        </div>
                        <div class="modal-body">
                            <div>
                                <form action="" id="frm-edit-category">
                                    <input type="hidden" id="catid" value=""/>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-plus"></i></span>
                                        <input class="form-control" type="text" id="edit-drugs-category" name='edit-drugs-category' autocomplete="off" placeholder="Drugs Category"/>  
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <textarea class="form-control" type="text" id="edit-drugs-category-description" name='edit-drugs-category-description' placeholder="Drugs Category Description"></textarea>
                                    </div>
                                    <div class="form-group input-group col-md-12">
                                        <button type="button" class="btn btn-block btn-success" name="btn-add-category-values" id="btn-edit-category-values">
                                            <span class="fa fa-pencil"></span> Edit Category</button>       
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

