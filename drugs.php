
<?php
include 'includes/checkInvalidUser.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title >HMS : Home</title>
        <?php require_once 'includes/html_main.php'; ?>
        <link href="css/profile.css" rel="stylesheet"/>
        <script src="js/menu_item_active.js"></script>
    </head>
    <body>

        <?php require_once('includes/menu_navbar.php'); ?>

        <div class="toggled-2" id="wrapper">
            <?php require_once('includes/menu_sidebar.php'); ?>
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container xyz">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1><?php echo $_SESSION[SESS_LOGIN_NAME]; ?></h1>
                            <p style="text-align: justify;">Hospital Management System app</p>
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

