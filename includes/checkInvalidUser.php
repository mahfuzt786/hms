<?php

session_start();
$flag = 0;
require_once 'includes/constants.php';
require_once 'includes/util.php';
if (!isset($_SESSION[SESS_LOGIN_ID])) {
    header('Location: index.php');
} else if (!isset($_SESSION['isLoggedIn']) || !($_SESSION['isLoggedIn'])) {
    //code for authentication comes here
    //ASSUME USER IS VALID
    $_SESSION['isLoggedIn'] = true;
    /////////////////////////////////////////
    $_SESSION['timeOut'] = 300;
    $logged = time();
    $_SESSION['loggedAt'] = $logged;
} else {
    require 'timeCheck.php';
    $hasSessionExpired = checkIfTimedOut();
    if ($hasSessionExpired) {
        session_unset();
        header("Location:index.php");
        exit;
    } else {
        $_SESSION['loggedAt'] = time(); // update last accessed time
    }
    $flag = 1;
}
//echo '<script>alert ('.$flag.');</script>';
?>
