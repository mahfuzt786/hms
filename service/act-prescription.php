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
elseif ($action == "addPres") {
    addPres($mysqli);
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
        
        $sql    = " SELECT DISTINCT CONCAT(drugs_cat ,' - ', drugs_name) AS name, drugs_name, drugs_id AS ID, drugs_price, drugscategory.drugs_cat_id, drugs_quantity
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
	
	/** add prescription **/
	function addPres($mysqli)
	{
		$doctor_id       		= cleanValue($mysqli, getPost('doctor_id'));
        $patientType         	= cleanValue($mysqli, getPost('patientType'));
        $employee_id   			= cleanValue($mysqli, getPost('employee_id'));
		$empName				= cleanValue($mysqli, getPost('emp-name'));
        $p_remark               = cleanValue($mysqli, getPost('p_remark'));
        $p_note                	= cleanValue($mysqli, getPost('p_note'));
        
        $drug_id                = getPost('drugs_id');
        $drugCatId              = getPost('drugCatId');
        $addedQuantity          = getPost('addedQuantity');
		$drugs_total            = getPost('drugs_total');
		$drugsTotalQ            = getPost('drugsTotalQ');
		
		$validPresc				= validPresc($mysqli);
		
		if($validPresc=='valid') {
			$errorz='1';
			
			$sql=("INSERT INTO wtfindin_hms.prescription (doctor_id, patient_type, employee_id, empName, p_remark, p_note)
						VALUES ( '$doctor_id','$patientType','$employee_id','$empName','$p_remark','$p_note')");
				    
			$insert_user = $mysqli->query($sql);
			if (!$insert_user) {
				echo "Error in adding into prescription -> ". $mysqli->error;
			}
			else {
				$errorz='0';
			}
			
			$prescriptionId=  $mysqli->insert_id;
			
			
			// Create insert SQL insert values
			$sqlInsertValues = "";
			$sqlUpdateDrugs = "";
			for($i=0;$i<sizeof($drug_id);$i++)
			{
				if ($i > 0) { 
					$sqlInsertValues  .= ", ";                     
				}
				$newDrugsTotalQ = 0;
				
				$newDrugsTotalQ = $drugsTotalQ[$i] - $addedQuantity[$i];
				
				$sqlInsertValues    .= " ( '$prescriptionId','$drug_id[$i]','$drugCatId[$i]','$addedQuantity[$i]','$drugs_total[$i]')";
				
				$sqlUpdate  = "UPDATE wtfindin_hms.drugs SET drugs_quantity = '$newDrugsTotalQ' WHERE drugs_id = '$drug_id[$i]'";
				
				// Execute SQL
				$update_userIngre = $mysqli->query($sqlUpdate);
				
				if (!$update_userIngre) {
					$errorz='1';
					echo "Error in updating drugs quantity -> ". $mysqli->error;
				}
				else {
					$errorz='0';
				}
			}
			
			if($errorz == '0')
			{
				// Create Insert Ingredient SQL
				$sqlInsert  = "INSERT INTO wtfindin_hms.prescription_drugs (p_id, drug_id, drugCatId, addedQuantity, drugs_total) VALUES " . $sqlInsertValues;
				
				// Execute SQL
				$insert_userIngre = $mysqli->query($sqlInsert);
				
				if (!$insert_userIngre) {
					echo "Error in inserting drugs -> ". $mysqli->error;
				}
				else {
					$errorz='0';
				}
			}
			
			if($errorz=='0')   {
				echo "done";
			}
		}
		else {
			echo $validGranule;
		}
	}
	
	function validPresc($mysqli)
	{
		$doctor_id       		= cleanValue($mysqli, getPost('doctor_id'));
        $patientType         	= cleanValue($mysqli, getPost('patientType'));
        $employee_id   			= cleanValue($mysqli, getPost('employee_id'));
		$empName				= cleanValue($mysqli, getPost('emp-name'));
        $p_remark               = cleanValue($mysqli, getPost('p_remark'));
        $p_note                	= cleanValue($mysqli, getPost('p_note'));
		
		$drug_id                = getPost('drugs_id');
	
		if( $doctor_id== 'null' || $doctor_id== null)
        {
            return "Please Select a Doctor";
        }
		elseif($patientType == 'null' || $patientType== null) {
			return "Please select Patient type";
		}
		elseif( $employee_id== 'null' || $employee_id== null )
        {
            return "Please enter employee id";
        }
		elseif( $empName== 'null' || $empName== null )
        {
            return "Please enter employee name";
        }
		elseif($p_remark == 'null' || $p_remark== null) {
			return "Please enter remark";
		}
		elseif($p_note == 'null' || $p_note== null) {
			return "Please enter note";
		}
		elseif(sizeof($drug_id) < 1)
		{
			return 'Please enter minimum 1 drug in Prescription';
		}
		else {
			return "valid";
		}
	}
?>