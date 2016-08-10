<?php

session_start();

require_once '../includes/constants.php';
require_once '../includes/database-config.php'; /* Database Settings */
require_once '../includes/util.php';


/*  When a user click the login button */
$action = $_REQUEST['action']; //Calling program must pass action

if ($action == "check_daily") {
    check_daily($mysqli);
} else if ($action == "check_monthly_sl") {
    check_monthly_sl($mysqli);
} else if ($action == "check_yearly_sl") {
    check_yearly_sl($mysqli);
} else if ($action == "check_yearly_emp") {
    check_yearly_emp($mysqli);
} else if ($action == "check_between_sl") {
    check_between_sl($mysqli);
} else {
    throw new Exception("Unknown Action: " + $action);
}

//if (isset($_POST['frmLogin']))
function check_daily($mysqli) {
    $error = 'false';
    $dt = strtoupper(getRequestPostDefault('dt', 'null'));
    $sql = "SELECT s.*, d.*,e.e_name,e.pf_id
            FROM sick_leave s, dependent d, employee e
            WHERE s.s_id=d.sid AND e.e_emp_id=s.emp_id AND ('$dt' BETWEEN s.startDate AND s.endDate)
            ORDER BY s.sid DESC";
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        throw new Exception($mysqli->error);
    } else {
        if (mysqli_num_rows($arRes) == 0) {
            echo 'lib/tcpdf/reports/no-data.php';
            //echo "0 row found".$dt;
            return false;
        } else {
            //echo "some rows found";
            echo 'lib/tcpdf/reports/daily-sl-report.php?dat=' . $dt . '';
            return true;
        }
    }
}

function check_yearly_emp($mysqli) {
    $error = 'false';
    $year = strtoupper(getRequestPostDefault('year', 'null'));
    $empid = strtoupper(getRequestPostDefault('empid', 'null'));
    $sql = "SELECT s.*, d.*,e.e_name,e.pf_id
            FROM sick_leave s, dependent d, employee e
            WHERE s.s_id=d.sid AND e.e_emp_id=s.emp_id AND e.e_emp_id='$empid' AND('$year' BETWEEN YEAR(s.startDate) AND YEAR(s.endDate))
            ORDER BY s.sid DESC";
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        throw new Exception($mysqli->error);
    } else {
        if (mysqli_num_rows($arRes) == 0) {
            echo 'lib/tcpdf/reports/no-data.php';
            //echo "0 row found".$dt;
            return false;
        } else {
            //echo "some rows found";
            echo 'lib/tcpdf/reports/yearly-slemp-report.php?year=' . $year . '&empid=' . $empid . '';
            return true;
        }
    }
}
function check_between_sl($mysqli) {
    $error = 'false';
    $start = strtoupper(getRequestPostDefault('start', 'null'));
    $end = strtoupper(getRequestPostDefault('end', 'null'));
    $sql = "SELECT s.*, d.*,e.e_name,e.pf_id
            FROM sick_leave s, dependent d, employee e
            WHERE s.s_id=d.sid AND e.e_emp_id=s.emp_id AND ('$start' BETWEEN s.startDate AND s.endDate) OR ('$end' BETWEEN s.startDate AND s.endDate)
            ORDER BY s.sid DESC";
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        throw new Exception($mysqli->error);
    } else {
        if (mysqli_num_rows($arRes) == 0) {
            echo 'lib/tcpdf/reports/no-data.php';
            //echo "0 row found".$dt;
            return false;
        } else {
            //echo "some rows found";
            echo 'lib/tcpdf/reports/between-sl-report.php?start=' . $start . '&end='.$end.'';
            return true;
        }
    }
}

function check_monthly_sl($mysqli) {
    $error = 'false';
    $month = strtoupper(getRequestPostDefault('month', 'null'));
    $year = strtoupper(getRequestPostDefault('year', 'null'));
    $sql = "SELECT s.*, d.*,e.e_name,e.pf_id
            FROM sick_leave s, dependent d, employee e
            WHERE s.s_id=d.sid AND e.e_emp_id=s.emp_id AND (('$month' BETWEEN MONTH(s.startDate) AND MONTH(s.endDate)) AND ('$year' BETWEEN YEAR(s.startDate) AND YEAR(s.endDate)))
            ORDER BY s.sid DESC";
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        throw new Exception($mysqli->error);
    } else {
        if (mysqli_num_rows($arRes) == 0) {
            echo 'lib/tcpdf/reports/no-data.php';
            //echo "0 row found".$dt;
            return false;
        } else {
            //echo "some rows found";
            echo 'lib/tcpdf/reports/monthly-sl-report.php?month=' . $month . '&year='.$year.'';
            return true;
        }
    }
}

function check_yearly_sl($mysqli) {
    $error = 'false';
    $year = strtoupper(getRequestPostDefault('year', 'null'));
    $sql = "SELECT s.*, d.*,e.e_name,e.pf_id
            FROM sick_leave s, dependent d, employee e
            WHERE s.s_id=d.sid AND e.e_emp_id=s.emp_id AND('$year' BETWEEN YEAR(s.startDate) AND YEAR(s.endDate))
            ORDER BY s.sid DESC";
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        throw new Exception($mysqli->error);
    } else {
        if (mysqli_num_rows($arRes) == 0) {
            echo 'lib/tcpdf/reports/no-data.php';
            //echo "0 row found".$dt;
            return false;
        } else {
            //echo "some rows found";
            echo 'lib/tcpdf/reports/yearly-sl-report.php?year=' . $year . '';
            return true;
        }
    }
}

?>