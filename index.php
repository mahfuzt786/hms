<!DOCTYPE html>
<html>
    <head>
        <title>Hospital Management System : Login</title>
        <?php include_once 'includes/html_main.php'; ?>
        <link href="css/login.css" rel="stylesheet">
        <script src="js/login.js"></script>
    </head>
    <body>
        <div class="body_container col-md-12">
            <div class="header_login">
                <div class="col-md-12"><i class="fa fa-2x fa-ambulance"> HMS</i></div>
            </div>
            <div class="login_box panel panel-default">
                <div class="soft-name text-center">
                    <i class="fa fa-3x fa-hospital-o"> Hospital Management System</i>
                </div>
                <div class="panel-heading">
                    <i class="fa fa-2x fa-sign-in"> Login</i>
                </div>
                <div id="alert">
                    <?php
                    //session_start();

                    if (isset($_SESSION[SESS_LOGIN_MSG])) {
                        echo $_SESSION[SESS_LOGIN_MSG];
                        $_SESSION[SESS_LOGIN_MSG] = '';
                    }
                    ?>
                </div>
                <div class="panel-body">
                    <form action="" id="frm-login">
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input class="form-control" type="text" id="username" name='username' placeholder="username"/>          
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input class="form-control" type="password" id="password" name='password' placeholder="password"/>          
                        </div>
                        <div class="form-group input-group col-md-12">
                            <button type="button" class="btn btn-block btn-default" name="btn-login" id="btn-login">
                                <span class="fa fa-sign-in"></span> Login</button>       
                        </div>
                    </form>
                </div>
                <div class="panel-heading foot">
                    <?php require_once 'includes/footer.php'; ?>
                </div>
            </div>
        </div>
    </body>
</html>
