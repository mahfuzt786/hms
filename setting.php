
<?php
include 'includes/checkInvalidUser.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title >HMS : Home</title>
        <?php require_once 'includes/html_main.php'; ?>
        <link href="css/profile.css" rel="stylesheet"/>
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
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-user"></i> Administrator</a></li>
                                    <li><a data-toggle="tab" href="#menu1"><i class="fa fa-key"></i> Change Password</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                        <h3><?php echo $_SESSION[SESS_LOGIN_NAME]; ?></h3>
                                        <?PHP
                                        include_once 'includes/database-config.php';
                                        $id=$_SESSION[SESS_LOGIN_ID];
                                        $sql = "SELECT user.*
					FROM wtfindin_hms.user
                                        WHERE userId='$id'";
                                        $arRes = $mysqli->query($sql);
                                        if (!$arRes) {
                                            throw new Exception($mysqli->error);
                                        }else{
                                            $row = $arRes->fetch_object();
                                            $username=$row->loginId;
                                        }
                                        ?>
                                        <p><b>Username:</b> <?php echo $username; ?></p>
                                    </div>
                                    <div id="menu1" class="tab-pane fade">
                                        <h3>Menu 1</h3>
                                        <p>Some content in menu 1.</p>
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

