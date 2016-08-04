<?php

session_start();

require_once '../includes/constants.php';
require_once '../includes/database-config.php'; /* Database Settings */
require_once '../includes/util.php';


/*  When a user click the login button */
$action = $_REQUEST['action']; //Calling program must pass action

if ($action == "check_daily") {
    check_daily($mysqli);
}else if ($action == "check_weekly") {
    check_weekly($mysqli);
}else if ($action == "check_monthly") {
    check_monthly($mysqli);
}else if ($action == "check_yearly") {
    check_yearly($mysqli);
}else if ($action == "check_between") {
    check_between($mysqli);
}else {
    throw new Exception("Unknown Action: " + $action);
}

//if (isset($_POST['frmLogin']))
function check_daily($mysqli) {
    $error = 'false';
    $dt = strtoupper(getRequestPostDefault('dt', 'null'));
    $sql = "SELECT pd.p_id,pd.drug_id,SUM(pd.addedQuantity) AS quantity,count(d.drugs_id) AS cnt,d.drugs_name,d.drugs_quantity,d.total_stock,p.p_id,p.p_date
            FROM prescription_drugs pd, drugs d, prescription p
            WHERE pd.drug_id=d.drugs_id AND pd.p_id=p.p_id AND DATE(p.p_date)='$dt'
            GROUP BY d.drugs_name HAVING cnt >= 1";
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
function check_weekly($mysqli) {
    $error = 'false';
    $dt = strtoupper(getRequestPostDefault('dt', 'null'));
    $sql = "SELECT DISTINCT pd.p_id, pd.drug_id, SUM( pd.addedQuantity ) AS quantity, count(d.drugs_id) AS cnt, d.drugs_name, d.drugs_quantity, d.total_stock, p.p_id, 
			date( p.p_date ) prescDate, date(DATE_ADD(p.p_date, INTERVAL 7 DAY)) as nextdate
			FROM prescription_drugs pd
					JOIN drugs d ON pd.drug_id = d.drugs_id
					JOIN prescription p ON pd.p_id = p.p_id
                    WHERE DATE(p.p_date)>='$dt'
                    AND DATE(p.p_date) <= DATE_ADD('$dt', INTERVAL 7 DAY)
				GROUP BY d.drugs_name, prescDate
				ORDER BY prescDate";
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
}function check_between($mysqli) {
    $error = 'false';
    $start = strtoupper(getRequestPostDefault('start', 'null'));
    $end = strtoupper(getRequestPostDefault('end', 'null'));
    $sql = "SELECT DISTINCT pd.p_id, pd.drug_id, SUM( pd.addedQuantity ) AS quantity, count(d.drugs_id) AS cnt, d.drugs_name, d.drugs_quantity, d.total_stock, p.p_id, 
			date( p.p_date ) prescDate, date(DATE_ADD(p.p_date, INTERVAL 7 DAY)) as nextdate
			FROM prescription_drugs pd
					JOIN drugs d ON pd.drug_id = d.drugs_id
					JOIN prescription p ON pd.p_id = p.p_id
                    WHERE DATE(p.p_date)>='$start'
                    AND DATE(p.p_date) <= '$end'
				GROUP BY d.drugs_name, prescDate
				ORDER BY prescDate";
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
function check_monthly($mysqli) {
    $error = 'false';
    $month = strtoupper(getRequestPostDefault('month', 'null'));
    $year = strtoupper(getRequestPostDefault('year', 'null'));
    $sql = "SELECT DISTINCT pd.p_id, pd.drug_id, SUM( pd.addedQuantity ) AS quantity, count(d.drugs_id) AS cnt, d.drugs_name, d.drugs_quantity, d.total_stock, p.p_id, 
			date( p.p_date ) prescDate
			FROM prescription_drugs pd
					JOIN drugs d ON pd.drug_id = d.drugs_id
					JOIN prescription p ON pd.p_id = p.p_id
                    WHERE MONTH(p.p_date)='$month' AND YEAR(p.p_date)='$year'
				GROUP BY d.drugs_name, prescDate
				ORDER BY prescDate";
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
}function check_yearly($mysqli) {
    $error = 'false';
    $year = strtoupper(getRequestPostDefault('year', 'null'));
    $sql = "SELECT DISTINCT pd.p_id, pd.drug_id, SUM( pd.addedQuantity ) AS quantity, count(d.drugs_id) AS cnt, d.drugs_name, d.drugs_quantity, d.total_stock, p.p_id, 
			date( p.p_date ) prescDate
			FROM prescription_drugs pd
					JOIN drugs d ON pd.drug_id = d.drugs_id
					JOIN prescription p ON pd.p_id = p.p_id
                    WHERE YEAR(p.p_date)='$year'
				GROUP BY d.drugs_name, prescDate
				ORDER BY prescDate";
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