<?php

session_start();
require_once 'constants.php';
require_once 'util.php';

if (isset($_SESSION[SESS_LOGIN_ID])) {
    $_SESSION = array();
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600);
    }
    session_destroy();

    //$home_url='/http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php';
    $home_url = '../index.php';
    header('Location:' . $home_url);
}
?>
