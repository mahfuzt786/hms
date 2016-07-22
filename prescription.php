
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
        <link href="css/prescription.css" rel="stylesheet"/>
        <script src="js/prescription.js"></script>
        <script>
            /* function listbox_item_move(source,destination){
                var src = document.getElementById(source);
                var dest = document.getElementById(destination);

                for(var count=0; count < src.options.length; count++) {

                    if(src.options[count].selected == true) {
                        var option = src.options[count];

                        var newOption = document.createElement("option");
                        newOption.value = option.value;
                        newOption.text = option.text;
                        newOption.selected = true;
                        try {
                            dest.add(newOption, null); //Standard
                            src.remove(count, null);
                        }catch(error) {
                            dest.add(newOption); // IE only
                            src.remove(count);
                        }
                        count--;

                    }

                }
            }*/
            $(document).ready(function() {
                var options = {
                    valueNames: ['option','drugname' ]
                };

                var drugs = new List('drugs', options);
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
                                <i class="fa fa-file"> Prescription</i>
                            </div>
                            <div class="panel-body">

                                <div class="">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#prescription"><i class="fa fa-plus"></i> Prescription</a></li>
                                        <li><a href="#prescriptionlist"><i class="fa fa-file"></i> Prescription List</a></li>
                                    </ul>
                                    <div class="row tab-content tab-prescription">
                                        <div id="prescription" class="tab-pane fade in active">
                                            <div class="prescription-add-header">
                                                <h4><span class="fa fa-plus"></span> Add Prescription</h4>
                                            </div>
                                            <div class="prescription-add-content">
                                                <form action="" id="frm-add-prescription">
                                                    <div class="row">
                                                        <div class="col-md-2 detail">Doctor Name</div>
                                                        <div class="col-md-3">
                                                            <select id="doc-id" class="form-control input-group">
                                                                <option value="select doctor">Select Doctor</option>
                                                                <?php
                                                                $sql = "SELECT doctor.*
                                                                        FROM wtfindin_hms.doctor";
                                                                $arRes = $mysqli->query($sql);

                                                                $detail = array();
                                                                while ($row = $arRes->fetch_assoc()) {
                                                                    echo "<option value=" . $row['d_id'];
                                                                    echo ">" . $row['d_name'];
                                                                    echo "</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row radio-field">
                                                        <div class="col-md-2 detail">Patient Type</div>
                                                        <div class="col-md-1 detail">
                                                            <label class="radio-inline">
                                                                <input type="radio" value="1" id="patientType1" name="patientType" >InPatient
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1 detail">
                                                            <label class="radio-inline">
                                                                <input type="radio" value="2" id="patientType2" name="patientType">OutPatient
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-2 detail">Employee ID</div>
                                                        <div class="col-md-3">
                                                            <input class="form-control input-group" type="text" id="emp-id" name='emp-id' autocomplete="off"/>
                                                        </div>
                                                        <div class="col-md-5 detail" id="show-detail">
                                                            <i class="glyphicon glyphicon-ok" id="found"></i>
                                                            <i class="glyphicon glyphicon-remove" id="notfound"></i>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-2 detail">Name</div>
                                                        <div class="col-md-3">
                                                            <input class="form-control input-group" type="text" id="emp-name" name='emp-name' autocomplete="off"/>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-2 detail">Date</div>
                                                        <div class="col-md-3">
                                                            <input class="form-control input-group" readonly type="text" id="date" name='date' value="<?php echo date('d/m/Y'); ?>" autocomplete="off"/>
                                                        </div>
                                                    </div>
                                                    <!--MEDICINE LIST-->
                                                    
                                                    <div class="row">
                                                        <div class="col-md-2 prescribed_head">
                                                            <b><i class="fa fa-file-text"></i> Prescribed Medicines</b>
                                                        </div>
                                                    </div>
                                                    <div class="row row-item">
                                                        <div class="col-md-1 col-mod">Sl. Number</div>
                                                        <div class="col-md-4 col-mod">Name</div>
                                                        <div class="col-md-2 col-mod">Quantity</div>
                                                        <div class="col-md-2 col-mod">Price</div>
                                                        <div class="col-md-2 col-mod">Total</div>
                                                        <div class="col-md-1 col-mod text-center">#</div>
                                                    </div>
                                                    <div class="row row-item">
                                                        <div class="col-md-1 text-center slno col-mod">(1)</div>
                                                        <div class="col-md-4 col-mod"><input placeholder="Name" class="form-control input-group" type="text"/></div>
                                                        <div class="col-md-2 col-mod"><input placeholder="Quantity" class="form-control input-group" type="text"/></div>
                                                        <div class="col-md-2 col-mod"><input placeholder="Price" readonly class="form-control input-group" type="text"/></div>
                                                        <div class="col-md-2 col-mod"><input placeholder="Total" class="form-control input-group" type="text"/></div>
                                                        <div class="col-md-1 col-mod">
                                                            <button type="button" class="btn btn-block btn-primary">
                                                                <span class="fa fa-plus"></span> Go</button>  
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row row-item">
                                                        <div class="col-md-1 text-center slno col-mod">(2)</div>
                                                        <div class="col-md-4 col-mod"><input placeholder="Name" class="form-control input-group" type="text"/></div>
                                                        <div class="col-md-2 col-mod"><input placeholder="Quantity" class="form-control input-group" type="text"/></div>
                                                        <div class="col-md-2 col-mod"><input placeholder="Price" readonly class="form-control input-group" type="text"/></div>
                                                        <div class="col-md-2 col-mod"><input placeholder="Total" class="form-control input-group" type="text"/></div>
                                                        <div class="col-md-1 col-mod">
                                                            <button type="button" class="btn btn-block btn-primary">
                                                                <span class="fa fa-plus"></span> Go</button>  
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <!--END OF MEDICINE LIST-->
                                                    <div class="row textArea-content">
                                                        <div class="col-md-6 textArea">
                                                            <div class="col-md-12">
                                                                <div>Remark</div>
                                                                <textarea class="form-control" type="text" id="date" name='date' autocomplete="off"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 textArea">
                                                            <div class="col-md-12">
                                                                <div>Note</div>
                                                                <textarea class="form-control" type="text" id="date" name='date' autocomplete="off"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row btnPres">
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-block btn-primary" name="btn-add-prescription-values" id="btn-add-prescription-values">
                                                                <span class="fa fa-plus"></span> Add Prescription</button>       
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div> 


                                        <!--second tab-->
                                        <div id="prescriptionlist" class="tab-pane fade">
                                        </div>
                                        <!--second tab-->
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

