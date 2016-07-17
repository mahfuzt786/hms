
<?php
include 'includes/checkInvalidUser.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title >HMS : Home</title>
        <?php require_once 'includes/html_main.php'; ?>
        <?php require_once 'includes/admin_init.php'; ?>
        <link href="css/setting.css" rel="stylesheet"/>
        <script src="js/setting.js"></script>
        <script>
            $(document).ready(function() {
                var options = {
                    valueNames: [ 'sno','date_time', 'ip_address' ],
                    page: 5,
                    plugins: [
                        ListPagination({
                            innerWindow: 3,
                            left: 2,
                            right: 2
                        })
                    ]
                };

                var logList = new List('log_details', options);
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
                                <i class="fa fa-gears"> Setting</i>
                            </div>
                            <div class="panel-body">
                                <!--<ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-user"></i> Administrator</a></li>
                                    <li><a data-toggle="tab" href="#menu1"><i class="fa fa-key"></i> Change Password</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">-->
                                <div class="col-md-6 table-log-details">
                                    <div class="panel panel-default pane-1">
                                        <div class="panel-heading"><i class="fa fa-user"></i> Admin</div>
                                        <div class="panel-body">
                                            <h3><?php echo $_SESSION[SESS_LOGIN_NAME]; ?></h3>

                                            <?PHP
                                            $id = $_SESSION[SESS_LOGIN_ID];
                                            $username = $_SESSION[SESS_LOGIN_NAME];
                                            $sql = "SELECT user.*
                                            FROM wtfindin_hms.user
                                            WHERE userId='$id'";
                                            $arRes = $mysqli->query($sql);
                                            if (!$arRes) {
                                                throw new Exception($mysqli->error);
                                            } else {
                                                $row = $arRes->fetch_object();
                                                $username = $row->loginId;
                                            }
                                            ?>
                                            <p><b>Username:</b> <?php echo $username; ?></p>
                                        </div>
                                    </div>

                                    <div class="panel panel-default pane-2">
                                        <div class="panel-heading"><i class="fa fa-key"></i> Change Password</div>
                                        <div class="panel-body">

                                            <form action="" id="frm-password_change">
                                                <input type="hidden" id="id" value="<?php echo $id; ?>"/>
                                                <input type="hidden" id="username" value="<?php echo $username; ?>"/>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                    <input class="form-control" type="password" id="old_pass" name='old_pass' autocomplete="off" placeholder="Password"/>          
                                                    <span class="input-group-addon check_input ok" id="oldP_ok"><i class="glyphicon glyphicon-ok"></i></span>
                                                    <span class="input-group-addon check_input remove" id="oldP_remove"><i class="glyphicon glyphicon-remove"></i></span>
                                                </div>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                    <input class="form-control" type="text" id="new_pass" name='new_pass' placeholder="New Password"/> 
                                                    <span class="input-group-addon check_input ok" id="newP_ok"><i class="glyphicon glyphicon-ok"></i></span>
                                                    <span class="input-group-addon check_input remove" id="newP_remove"><i class="glyphicon glyphicon-remove"></i></span>
                                                </div>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                    <input class="form-control" type="text" id="new_pass_c" name='new_pass_c' placeholder="Confirm New Password"/>
                                                    <span class="input-group-addon check_input ok" id="newPc_ok"><i class="glyphicon glyphicon-ok"></i></span>
                                                    <span class="input-group-addon check_input remove" id="newPc_remove"><i class="glyphicon glyphicon-remove"></i></span>
                                                </div>
                                                <div class="form-group input-group col-md-12">
                                                    <button type="button" class="btn btn-block btn-danger" name="btn-change-password" id="btn-change-password">
                                                        <span class="fa fa-check"></span> Change Password</button>       
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6 table-log-details">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><i class="fa fa-calendar-times-o"></i> Log Details</div>
                                        <div class="panel-body">
                                            <div id="log_details">
                                                <div>
                                                    <input class="search" placeholder="Search" />
                                                </div>
                                                <table class="col-lg-12">  
                                                    <thead>  
                                                        <tr>
                                                            <th class="sort" data-sort="sno" data-toggle="tooltip" data-placement="auto" title="Sort by Serial Number">#</th>
                                                            <th class="sort" data-sort="date_time" data-toggle="tooltip" data-placement="auto" title="Sort by Date and Time">Date & Time (Y-m-d & H:M:S)</th>
                                                            <th class="sort" data-sort="ip_address" data-toggle="tooltip" data-placement="auto" title="Sort by Last Login IP Address">IP Address</th>
                                                        </tr>  
                                                    </thead>
                                                    <tbody class="list">
                                                        <?php
                                                        $sql_log = "SELECT userlogin.*
                                                                FROM wtfindin_hms.userlogin
                                                                WHERE userId='$id'";
                                                        $arr_log = $mysqli->query($sql_log);
                                                        $tot_rec = mysqli_num_rows($arr_log);
                                                        for ($x = $tot_rec; $x > 0; $x--) {
                                                            $sql_log_item = "SELECT userlogin.*
                                                                FROM wtfindin_hms.userlogin
                                                                WHERE userLoginId='$x'";
                                                            $rows = $mysqli->query($sql_log_item)->fetch_object();
                                                            echo "<tr>";
                                                            echo"<td class='sno'>(" . $x . ")</td>";
                                                            echo"<td class='date_time'>" . $rows->loginDate . "</td>";
                                                            echo"<td class='ip_address'>" . $rows->remote_addr . "</td>";
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
                                <!--</div>
                                <div id="menu1" class="tab-pane fade">
                                    <table id="myTable" class="table table-striped" >  
                                        <thead>  
                                            <tr>  
                                                <th>Date & Time (Y-m-d & H:M:S)</th>   
                                            </tr>  
                                        </thead>  
                                        <tbody>  
                                            <tr>  
                                                <td>001</td>   
                                            </tr>   
                                        </tbody>  
                                    </table>  
                                </div>
                            </div>-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
        <!-- /#wrapper -->

        <!--body div-->

    </body>
</html>

