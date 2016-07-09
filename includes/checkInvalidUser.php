<?php

session_start();
require_once 'includes/constants.php';
require_once 'includes/util.php';
if (!isset($_SESSION[SESS_LOGIN_ID])) {
    header('Location: index.php');
}
?>
