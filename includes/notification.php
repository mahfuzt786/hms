<?php

$total_drugs_notify = 0;
$lowcount = 0;
$exp = 0;
$ls = 0;
$x = 0;
$date = date('Y-m-d');
$sql = "SELECT wtfindin_hms.drugs.* 
            FROM wtfindin_hms.drugs
            WHERE drugs_quantity < 30 OR DATE(drugs_expiry_date) < '$date'";
$arRes = $mysqli->query($sql);
$total_drugs_notify = mysqli_num_rows($arRes);

while ($row = $arRes->fetch_assoc()) {
    $exp_dt = new dateTime($row['drugs_expiry_date']);
    if ($row['drugs_quantity'] < 30 AND $exp_dt > $date) {
        $ls = $ls + 1;
    } else {
        $x = $x + 1;
    }
}

if ($flag == 0) {
    $error = 'false';
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        throw new Exception($mysqli->error);
    } else {
        if (mysqli_num_rows($arRes) != 0) {
            $low = "<b>Low Drugs Stock :</b>";
            $expire = "<b>Drugs Expired :</b>";
            $expire.="<table>";
            $low.="<table >";
            while ($row = $arRes->fetch_assoc()) {
                $exp_dt = new dateTime($row['drugs_expiry_date']);
                if ($row['drugs_quantity'] < 30 AND $exp_dt > $date) {
                    $lowcount = $lowcount + 1;
                    $low.="<tr><td style='padding:5px;'>(" . $lowcount . ")&nbsp;&nbsp;</td><td style='padding:5px;'> " . $row['drugs_name'] . "</td><td style='padding:5px;'> ,Quantity-" . $row['drugs_quantity'] . "</td></tr>";
                } else {
                    $exp = $exp + 1;
                    $ex = new DateTime($row['drugs_expiry_date']);
                    $expired = $ex->format('j-M-Y');
                    $expire.="<tr><td style='padding:5px;'>(" . $exp . ")&nbsp;&nbsp;</td><td style='padding:5px;'> " . $row['drugs_name'] . "</td><td style='padding:5px;'>,Expired On " . $expired . "</td></tr>";
                }
                if ($lowcount >= 3 && $exp >= 3) {
                    break;
                }
            }
            $expire.="<tr><td colspan='3'><a href='manage-drugs.php#expired-drugs'>more >></a></td></tr>";
            $expire.="</table>";
            $low.="<tr><td colspan='3'><a href='manage-drugs.php'>more >></a></td></tr>";
            $low.="</table>";
            if ($lowcount != 0 && $exp != 0) {
                echo '<script>';
                echo '$(document).ready(function(){';
                echo 'Lobibox.alert("warning",
            {
                title: "Drugs Stock Notification",
                msg: "' . $low . '</br></br>' . $expire . '"
            });';
                echo '});';
                echo '</script>';
            } else if ($lowcount != 0 || $exp == 0) {
                if ($lowcount != 0) {
                    echo '<script>';
                    echo '$(document).ready(function(){';
                    echo 'Lobibox.alert("warning",
            {
                title: "Drugs Stock Notification",
                msg: "' . $low . '"
            });';
                    echo '});';
                    echo '</script>';
                } else if ($lowcount == 0 || $exp != 0) {
                    echo '<script>';
                    echo '$(document).ready(function(){';
                    echo 'Lobibox.alert("warning",
            {
                title: "Drugs Stock Notification",
                msg: "' . $expire . '"
            });';
                    echo '});';
                    echo '</script>';
                }
            }
        }
    }
}
?>
