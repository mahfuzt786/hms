<?php

session_start();

require_once '../includes/constants.php';
require_once '../includes/database-config.php'; /* Database Settings */
require_once '../includes/util.php';


/*  When a user click the login button */
$action = $_REQUEST['action']; //Calling program must pass action

if ($action == "check_daily") {
    check_daily($mysqli);
} else {
    throw new Exception("Unknown Action: " + $action);
}

//if (isset($_POST['frmLogin']))
function check_daily($mysqli) {
    $error = 'false';
    $dt = strtoupper(getRequestPostDefault('dt', 'null'));
    $sql = "SELECT pd.p_id,pd.drug_id,pd.addedQuantity,d.drugs_id,d.drugs_name,d.drugs_quantity,p.p_id,p.p_date
            FROM prescription_drugs pd, drugs d, prescription p
            WHERE pd.drug_id=d.drugs_id AND pd.p_id=p.p_id AND DATE(p.p_date)='$dt'";
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        throw new Exception($mysqli->error);
    } else {
        if (mysqli_num_rows($arRes) == 0) {
            echo 'nil';
            return false;
        } else {
            echo 'done';
            return true;
        }
    }
}

?>