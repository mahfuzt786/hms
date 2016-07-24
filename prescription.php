
<?php
include 'includes/checkInvalidUser.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title >HMS : Manage Prescription</title>
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
                                                <form name="Customprescription" id="Customprescription" action="<?php $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
                                                    <input id="action" type="hidden" name="action" value="" />
                                                    <div class="row">
                                                        <div class="col-md-2 detail">Prescription ID</div>
                                                        <div class="col-md-3">
                                                            <?php
                                                                $pid=0;
                                                                $sql = "SELECT prescription.p_id
                                                                        FROM wtfindin_hms.prescription";
                                                                $arRes = $mysqli->query($sql);
                                                                if (!$arRes) {
                                                                    throw new Exception($mysqli->error);
                                                                } else {
                                                                    if (mysqli_num_rows($arRes) != 0) {
                                                                        $pid=$pid+1;
                                                                    }
                                                                }
                                                            ?>
                                                            <label class="pres-id" id="p-id" name='p-id'><?php echo "P".$pid;?></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-2 detail">Prescription ID</div>
                                                        <div class="col-md-3">
                                                            <?php
                                                            $pid=0;
                                                            $sql = "SELECT prescription.p_id
                                                                    FROM wtfindin_hms.prescription";
                                                            $arRes = $mysqli->query($sql);
                                                            if (!$arRes) {
                                                                throw new Exception($mysqli->error);
                                                            } else {
                                                                if (mysqli_num_rows($arRes) != 0) {
                                                                    $pid=$pid+1;
                                                                }
                                                            }
                                                            ?>
                                                            <label class="pres-id" id="p-id" name='p-id'><?php echo "P".$pid;?></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-2 detail">Doctor Name</div>
                                                        <div class="col-md-3">
                                                            <select id="doctor_id" name="doctor_id" class="form-control input-group">
                                                                <option value="">Select Doctor</option>
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
                                                                <input type="radio" value="inPatient" id="patientType1" name="patientType">InPatient
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1 detail">
                                                            <label class="radio-inline">
                                                                <input type="radio" value="outPatient" id="patientType2" name="patientType">OutPatient
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-2 detail">Employee ID</div>
                                                        <div class="col-md-3">
                                                            <input class="form-control input-group" type="text" id="employee_id" name='employee_id' autocomplete="off"/>
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
                                                    <div class="med-list">
                                                        <div class=" row panel panel-default">
                                                            <div class="panel-heading">
                                                                <div class="prescribed_head">
                                                                    <b><i class="fa fa-file-text"></i> Prescribed Medicines</b>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body" style="background: lightcyan;">
                                                                <div class="col-mod">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="basic-addon1">
                                                                            <i class="fa fa-search"></i>
                                                                        </span><input class="form-control input-group" type="text" autocomplete="off" name="search_box" title="Search For" id="search_box" value="" placeholder="Search Drugs Name" />
                                                                    </div>
                                                                </div>
                                                                <!--<div class="col-md-1 col-mod"> </div>
                                                                <div class="col-md-1 col-mod">
                                                                    <button type="button" class="btn btn-block btn-primary">
                                                                        <span class="fa fa-plus"></span> Add</button>  
                                                                </div>-->

                                                                <div class="col-md-12 col-mod" id="row5" style="margin-top: 10px; display: none;">
                                                                        <!--<div class="col-md-1 col-mod text-center"><strong>Sl. Number</strong></div>-->
                                                                    <div class="col-md-4 col-mod text-center"><strong>Name</strong></div>
                                                                    <div class="col-md-2 col-mod text-center"><strong>Quantity</strong></div>
                                                                    <div class="col-md-2 col-mod text-center"><strong>Unit Price</strong></div>
                                                                    <div class="col-md-2 col-mod text-center"><strong>Total</strong></div>
                                                                    <div class="col-md-2 col-mod text-center"><strong>#</strong></div>

                                                                </div>
                                                                <!--Dynamic Textfield-->
                                                                <div class="row col-mod" id="addedDrugs"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--END OF MEDICINE LIST-->
                                                    <div class="row textArea-content">
                                                        <div class="col-md-6 textArea">
                                                            <div class="col-md-12">
                                                                <div>Remark</div>
                                                                <textarea class="form-control" type="text" id="p_remark" name='p_remark' autocomplete="off" style="resize: none;"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 textArea">
                                                            <div class="col-md-12">
                                                                <div>Note</div>
                                                                <textarea class="form-control" type="text" id="p_note" name='p_note' autocomplete="off" style="resize: none;"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row btnPres">
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-block btn-primary" name="btn-add-prescription-values" id="btnAddPrescription">
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

