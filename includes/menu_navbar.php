<!--header-->
<nav class="navbar navbar-default no-margin">
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
                <i class="fa fa-user"></i>
                welcome, 
                <a href="#" data-toggle="popover" title="Administrator"  data-trigger="focus" data-placement="bottom" >
                    <b><?php echo $_SESSION[SESS_LOGIN_NAME]; ?></b>&nbsp;
                    <i class="fa fa-angle-down"></i>
                </a>
                <div id="popover_content_wrapper" style="display: none">
                    <div><a style="color: darkslateblue;" href="setting.php"><i class="fa fa-gears"></i> Setting</a></div>
                </div>
                &nbsp;&nbsp;
                <a href="#" data-toggle="popover" title="Notifications"  data-trigger="focus" data-placement="bottom" >
                    Notifications <span class="badge" style="background: darkred; color: white;">30</span>
                </a>
            </div>
        </div>
    </div><!-- bs-example-navbar-collapse-1 -->
</nav>
<!--header end-->
