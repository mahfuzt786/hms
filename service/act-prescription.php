<?php

session_start();

require_once '../includes/constants.php';
require_once '../includes/database-config.php'; /* Database Settings */
require_once '../includes/util.php';


/*  When a user click the login button */
$action = $_REQUEST['action']; //Calling program must pass action

if ($action == "checkEmp") {
    checkEmp($mysqli);
}
elseif  ($action == "getSuggest" )
{
    $ListofSearch['0'] =  getSuggest($mysqli);
    echo json_encode($ListofSearch);
}
else {
    throw new Exception("Unknown Action: " + $action);
}

//if (isset($_POST['frmLogin']))
function checkEmp($mysqli) {
    $error = 'false';
    $eid = strtoupper(getRequestPostDefault('eid', 'null'));
    $sql = "SELECT employee.*
            FROM wtfindin_hms.employee
            WHERE e_emp_id='$eid'";
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        throw new Exception($mysqli->error);
    } else {
        $row = $arRes->fetch_object();
        if (mysqli_num_rows($arRes) == 0) {
            echo 0;
            return false;
        } else {
            echo $row->e_name;
            return true;
        }
    }
}

    /** auto Complete drugs **/
    function getSuggest($mysqli)
    {
 
        $searchText 		   = getRequestPostDefault('searchText', 'null');
        $searchText            = str_replace(' ', '%', $searchText);
        
        $sqlLikeReverseName 	= createReverseNameSql(getRequestPostDefault('searchText', 'null'));
        
        $sql    = " SELECT DISTINCT CONCAT(drugs_cat ,' - ', drugs_name) AS name, drugs_name, drugs_id AS ID, drugs_price, drugscategory.drugs_cat_id
                      FROM wtfindin_hms.drugs
                        JOIN wtfindin_hms.drugscategory
                            ON drugs.drugs_cat_id = drugscategory.drugs_cat_id
                     WHERE (drugs_name LIKE '%$searchText%' ".$sqlLikeReverseName.")
                       AND isAvailable = 'Y'
                   ORDER BY name";

        $arRes  = $mysqli->query($sql);
        if (!$arRes)
        {
            echo "Error in search -> ". $mysqli->error;
        }
        if ( empty($arRes ) ) {
            return null;
        }
	
        $allResults = array();
        while ( $arRow = $arRes->fetch_object()) {
            $allResults[] = $arRow;
        }
        return $allResults;
    }

?>