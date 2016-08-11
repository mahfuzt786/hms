<!--header-->
<nav class="navbar navbar-default no-margin" style="border-bottom: 2px solid yellow;">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header fixed-brand">
        <!--<button type="button" class="navbar-toggle" data-toggle="collapse" id="menu-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar top-bar"></span>
            <span class="icon-bar middle-bar"></span>
            <span class="icon-bar bottom-bar"></span>
        </button>-->
        <a class="navbar-brand"><i class="fa fa-2x fa-ambulance"> HMS</i></a>        
    </div><!-- navbar-header-->
    <div class="collapse navbar-collapse" id="profile_menu">
        <!-- <ul class="nav navbar-nav">
             <li class="active">
                 <button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2">
                     <span class="sr-only">Toggle navigation</span>
                     <span class="icon-bar top-bar"></span>
                     <span class="icon-bar middle-bar"></span>
                     <span class="icon-bar bottom-bar"></span>
                 </button>
             </li>
 
         </ul>-->

        <div class="user">
            <div>
                <!--admin popover-->
                <i class="fa fa-user"></i>
                welcome, 
                <a href="#" data-toggle="popover" id="admin" title="Administrator"  data-trigger="focus" data-placement="bottom" >
                    <b><?php echo $_SESSION[SESS_LOGIN_NAME]; ?></b>&nbsp;
                    <i class="fa fa-angle-down"></i>
                </a>
                <div id="popover_content_wrapper_admin" style="display: none;">
                    <div><a style="color: darkslateblue;" href="setting.php"><i class="fa fa-gears"></i> Setting</a></div>
                </div>
                <!--end of admin popover-->
                &nbsp;&nbsp;
                <!--notification popover-->
                <a href="#" data-toggle="popover" id="notification"  data-trigger="focus" data-placement="bottom" >
                    Notifications <span class="badge" style="background: darkred; color: white;"><?php require_once 'notification.php';
echo $total_drugs_notify; ?></span>
                </a>
                <div id="popover_content_wrapper_notification" style="display: none;">
                    <div style="padding-top: 5px;"><a style="color:black;" href="manage-drugs.php">Low Stock </a><span class="badge" style="background: darkred; color: white;"><?php
echo $ls; ?></span></div>
                    <div style="padding-top: 5px;"><a style="color:black;" href="manage-drugs.php">Drug Expired </a><span class="badge" style="background: darkred; color: white;"><?php
echo $x; ?></span></div>
                </div>
                <!--end of notification popover-->
            </div>
        </div>
    </div><!-- bs-example-navbar-collapse-1 -->
</nav>
<!--header end-->
