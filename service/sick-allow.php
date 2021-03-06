<?php

session_start();

require_once '../includes/constants.php';
require_once '../includes/database-config.php'; /* Database Settings */
require_once '../includes/util.php';


/*  When a user click the login button */
$action = $_REQUEST['action']; //Calling program must pass action

if ($action == "checkEmp") {
    checkEmp($mysqli);
} else if ($action == "addRate") {
    addRate($mysqli);
} else if ($action == "addSickLeave") {
    addSickLeave($mysqli);
} else {
    throw new Exception("Unknown Action: " + $action);
}

//if (isset($_POST['frmLogin']))
function checkEmp($mysqli) {
    $error = 'false';
    $eid = strtoupper(getRequestPostDefault('eid', 'null'));
    $sql = "SELECT e.*,d.e_des,v.div_name
            FROM employee e,employee_designation d,division v
            WHERE e.e_des_id=d.e_des_id AND e.division=v.div_id AND e_emp_id='$eid'";
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        throw new Exception($mysqli->error);
    } else {
        if (mysqli_num_rows($arRes) == 0) {
            echo 0;
            return false;
        } else {
            $row = $arRes->fetch_object();

            $id = $row->e_emp_id;
            $name = $row->e_name;
            $pfid = $row->pf_id;
            $division = $row->div_name;
            $book = $row->book;
            $des = $row->e_des;
            $gender = $row->e_gender;

            $detail = array(
                0 => $id,
                1 => $name,
                2 => $pfid,
                3 => $division,
                4 => $book,
                5 => $des,
                6 => $gender
            );

            echo json_encode($detail);
            return true;
        }
    }
}

function addRate($mysqli) {
    $error = 'false';
    $rid = strtoupper(getRequestPostDefault('rid', 'null'));
    $rate = getRequestPostDefault('rate', 'null');
    $sql = "UPDATE sick_allowance_rate SET r_rate='$rate' WHERE r_id='$rid'";
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        echo "Error in updation !!";
        return false;
    } else {
        echo "done";
        return true;
    }
}

function addSickLeave($mysqli) {
    $flag = 0;
    $error = 'false';
    $slid = strtoupper(getRequestPostDefault('slid', 'null'));
    $empid = strtoupper(getRequestPostDefault('empid', 'null'));
    $patient = strtoupper(getRequestPostDefault('patient', 'null'));
    $rate = getRequestPostDefault('rate', 'null');
    $sdate = getRequestPostDefault('sdate', 'null');
    $edate = getRequestPostDefault('edate', 'null');
    $relation = getRequestPostDefault('relation', 'null');
    $gender = getRequestPostDefault('gender', 'null');
    if (strlen($relation) == 0 && strlen($gender) == 0) {
        $sql = "INSERT INTO wtfindin_hms.sick_leave(s_id,emp_id,rate,patientType,startDate,endDate)
                VALUES ('$slid','$empid','$rate','$patient','$sdate','$edate')";
        $flag = 0;
    } else {
        $sql = "INSERT INTO wtfindin_hms.sick_leave(s_id,emp_id,rate,patientType,startDate,endDate)
                VALUES ('$slid','$empid','$rate','$patient','$sdate','$edate')";
        $flag = 1;
    }
    $arRes = $mysqli->query($sql);
    if ($flag == 1) {
        $sql2 = "INSERT INTO wtfindin_hms.dependent(sid,relation,gender)
                VALUES ('$slid','$relation','$gender')";
        $arRes2 = $mysqli->query($sql2);
        if (!$arRes && !$arRes2) {
            echo "Error in granting leave !!";
            return false;
        } else {
            echo "done";
            return true;
        }
    } else {
        if (!$arRes) {
            echo "Error in granting leave !!";
            return false;
        } else {
            echo "done";
            return true;
        }
    }
}

?>