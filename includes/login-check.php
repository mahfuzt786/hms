<?php

session_start();

require_once 'constants.php';
require_once 'database-config.php'; /* Database Settings */
require_once 'util.php';


/*  When a user click the login button */
$action = $_REQUEST['action']; //Calling program must pass action

if ($action == "confirmLogin") {
    confirmLogin($mysqli);
} else if ($action == "changePassword") {
    changePassword($mysqli);
} else if ($action == "oldPassCheck") {
    oldPassCheck($mysqli);
} else if ($action == "addCategory") {
    addCategory($mysqli);
} else if ($action == "cat") {
    cat($mysqli);
} else if ($action == "catdesc") {
    catdesc($mysqli);
} else if ($action == "editCategory") {
    editCategory($mysqli);
} else if ($action == "delete_cat") {
    deleteCategory($mysqli);
} else if ($action == "show_drug") {
    show_drug($mysqli);
} else if ($action == "addDrug") {
    add_drug($mysqli);
} else if ($action == "retrieve_drug_detail") {
    retrieve_drug_detail($mysqli);
} else if ($action == "retrieve_drug_category") {
    retrieve_drug_category($mysqli);
} else if ($action == "editDrug") {
    editDrug($mysqli);
} else if ($action == "delete_drug") {
    delete_drug($mysqli);
} else if ($action == "checkEmp") {
    checkEmp($mysqli);
} else if ($action == "medicine_listbox") {
    medicine_listbox($mysqli);
} else if ($action == "medicine_listbox_main") {
    medicine_listbox_main($mysqli);
} else if ($action == "addEmployee") {
    addEmployee($mysqli);
} else if ($action == "checkEmployeeId") {
    checkEmployeeId($mysqli);
} else {
    throw new Exception("Unknown Action: " + $action);
}

//if (isset($_POST['frmLogin']))
function checkEmployeeId($mysqli) {
    $error = 'false';
    $empid = getRequestPostDefault('empid', 'null');
    $sql = "SELECT employee.*
            FROM wtfindin_hms.employee
            WHERE e_emp_id='$empid'";
    $arRes = $mysqli->query($sql);
    if (mysqli_num_rows($arRes) != 0) {
        echo 'duplicate';
    }else{
        echo 'done';
    }
    return true;
}

function addEmployee($mysqli) {
    $error = 'false';
    $empid = getRequestPostDefault('empid', 'null');
    $desid = getRequestPostDefault('desid', 'null');
    $name = getRequestPostDefault('name', 'null');
    $salary = getRequestPostDefault('salary', 'null');
    $age = getRequestPostDefault('age', 'null');
    $gender = getRequestPostDefault('gender', 'null');
    $address = getRequestPostDefault('address', 'null');

    if (addEmployeeDetail($empid, $desid, $name, $salary, $age, $gender, $address, $mysqli)) {
        echo 'done';
    } else {
        echo 'Error in Adding Employee detail !!';
    }
}

function addEmployeeDetail($empid, $desid, $name, $salary, $age, $gender, $address, $mysqli) {
    $empid = strtoupper($empid);
    $sql = "INSERT  INTO wtfindin_hms.employee (e_emp_id, e_des_id, e_name, e_salary, e_age, e_gender, e_address)
            VALUE ('$empid', '$desid', '$name', '$salary', '$age', '$gender', '$address')";
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        throw new Exception($mysqli->error);
    }
    return true;
}

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

function delete_drug($mysqli) {
    $error = 'false';
    $id = getRequestPostDefault('id', 'null');

    if (delete_drug_detail($id, $mysqli)) {
        echo 'done';
    } else {
        echo 'Error in Deleting Drug !!';
    }
}

function editDrug($mysqli) {
    $error = 'false';
    $did = getRequestPostDefault('did', 'null');
    $cat = getRequestPostDefault('cat', 'null');
    $name = getRequestPostDefault('name', 'null');
    $desc = getRequestPostDefault('desc', 'null');
    $price = getRequestPostDefault('price', 'null');
    $company = getRequestPostDefault('company', 'null');
    $man_d = getRequestPostDefault('man_d', 'null');
    $exp_d = getRequestPostDefault('exp_d', 'null');
    $quantity = getRequestPostDefault('quantity', 'null');

    if (edit_editDrug($did, $cat, $name, $desc, $price, $company, $man_d, $exp_d, $quantity, $mysqli)) {
        echo 'done';
    } else {
        echo 'Error in Adding Drug detail !!';
    }
}

function add_drug($mysqli) {
    $error = 'false';
    $cat = getRequestPostDefault('cat', 'null');
    $name = getRequestPostDefault('name', 'null');
    $desc = getRequestPostDefault('desc', 'null');
    $price = getRequestPostDefault('price', 'null');
    $company = getRequestPostDefault('company', 'null');
    $man_d = getRequestPostDefault('man_d', 'null');
    $exp_d = getRequestPostDefault('exp_d', 'null');
    $quantity = getRequestPostDefault('quantity', 'null');

    if (add_addDrug($cat, $name, $desc, $price, $company, $man_d, $exp_d, $quantity, $mysqli)) {
        echo 'done';
    } else {
        echo 'Error in Adding Drug detail !!';
    }
}

function edit_editDrug($did, $cat, $name, $desc, $price, $company, $man_d, $exp_d, $quantity, $mysqli) {
    $sql = "UPDATE wtfindin_hms.drugs 
                SET drugs_cat_id='$cat', drugs_name='$name',
                drugs_description='$desc', drugs_price='$price',
                drugs_company='$company', drugs_manufacturing_date='$man_d',
                drugs_expiry_date='$exp_d', drugs_quantity='$quantity'
                WHERE drugs_id='$did'";
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        throw new Exception($mysqli->error);
    }
    return true;
}

function add_addDrug($cat, $name, $desc, $price, $company, $man_d, $exp_d, $quantity, $mysqli) {
    $sql = "INSERT  INTO wtfindin_hms.drugs (drugs_cat_id,drugs_name,drugs_description,drugs_price,drugs_company,drugs_quantity,drugs_manufacturing_date,drugs_expiry_date,drugs_status)
            VALUE ('$cat', '$name', '$desc', '$price', '$company', '$quantity', '$man_d', '$exp_d', 'a')";
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        throw new Exception($mysqli->error);
    }
    return true;
}

function show_drug($mysqli) {
    $error = 'false';
    $id = getRequestPostDefault('id', 'null');
    $sql = "SELECT drugs.*
            FROM wtfindin_hms.drugs
            WHERE drugs_id='$id'";
    $arRes = $mysqli->query($sql);
    $row = $arRes->fetch_object();
    $detail = array();
    $catid = $row->drugs_cat_id;

    $sql1 = "SELECT drugscategory.*
            FROM wtfindin_hms.drugscategory
            WHERE drugs_cat_id='$catid'";
    $arRes1 = $mysqli->query($sql1);
    $row1 = $arRes1->fetch_object();
    $catname = $row1->drugs_cat;

    $name = $row->drugs_name;
    $desc = $row->drugs_description;
    $price = $row->drugs_price;
    $company = $row->drugs_company;
    $quantity = $row->drugs_quantity;
    $man_d = $row->drugs_manufacturing_date;
    $exp_d = $row->drugs_expiry_date;

    $detail = array(
        0 => $catname,
        1 => $name,
        2 => $desc,
        3 => $price,
        4 => $company,
        5 => $quantity,
        6 => $man_d,
        7 => $exp_d,
    );

    echo json_encode($detail);
    return true;
}

function medicine_listbox($mysqli) {
    $error = 'false';
    $name = getRequestPostDefault('name', 'null');
    $sql = "SELECT wtfindin_hms.drugs.*
                  FROM wtfindin_hms.drugs
                  WHERE drugs_status='a' AND drugs_name LIKE '$name%'";
    $arRes = $mysqli->query($sql);

    $detail = array();
    while ($row = $arRes->fetch_assoc()) {
        $k = $row['drugs_id'];
        $v = $row['drugs_name'];

        $detail["$k"] = "$v";
    }

    echo json_encode($detail);
    return true;
}

function medicine_listbox_main($mysqli) {
    $error = 'false';
    $sql = "SELECT wtfindin_hms.drugs.*
                  FROM wtfindin_hms.drugs
                  WHERE drugs_status='a'";
    $arRes = $mysqli->query($sql);

    $detail = array();
    while ($row = $arRes->fetch_assoc()) {
        $k = $row['drugs_id'];
        $v = $row['drugs_name'];

        $detail["$k"] = "$v";
    }

    echo json_encode($detail);
    return true;
}

function retrieve_drug_category($mysqli) {
    $error = 'false';
    $sql = "SELECT drugscategory.*
            FROM wtfindin_hms.drugscategory";
    $arRes = $mysqli->query($sql);

    $detail = array();
    while ($row = $arRes->fetch_assoc()) {
        $k = $row['drugs_cat_id'];
        $v = $row['drugs_cat'];

        $detail["$k"] = "$v";
    }

    echo json_encode($detail);
    return true;
}

function retrieve_drug_detail($mysqli) {
    $error = 'false';
    $id = getRequestPostDefault('id', 'null');
    $sql = "SELECT drugs.*
            FROM wtfindin_hms.drugs
            WHERE drugs_id='$id'";
    $arRes = $mysqli->query($sql);
    $row = $arRes->fetch_object();
    $detail = array();
    $catid = $row->drugs_cat_id;
    $name = $row->drugs_name;
    $desc = $row->drugs_description;
    $price = $row->drugs_price;
    $company = $row->drugs_company;
    $man_d = $row->drugs_manufacturing_date;
    $exp_d = $row->drugs_expiry_date;
    $quantity = $row->drugs_quantity;
    $detail = array(
        0 => $catid,
        1 => $name,
        2 => $desc,
        3 => $price,
        4 => $company,
        5 => $man_d,
        6 => $exp_d,
        7 => $quantity,
    );

    echo json_encode($detail);
    return true;
}

function catdesc($mysqli) {
    $error = 'false';
    $id = getRequestPostDefault('id', 'null');
    $sql = "SELECT drugscategory.*
            FROM wtfindin_hms.drugscategory
            WHERE drugs_cat_id='$id'";
    $arRes = $mysqli->query($sql);
    $row = $arRes->fetch_object();
    $catdes = $row->drugs_cat_desc;

    echo $catdes;
    return true;
}

function cat($mysqli) {
    $error = 'false';
    $id = getRequestPostDefault('id', 'null');
    $sql = "SELECT drugscategory.*
            FROM wtfindin_hms.drugscategory
            WHERE drugs_cat_id='$id'";
    $arRes = $mysqli->query($sql);
    $row = $arRes->fetch_object();
    $cat = $row->drugs_cat;

    echo $cat;
    return true;
}

function deleteCategory($mysqli) {
    $error = 'false';
    $id = getRequestPostDefault('id', 'null');

    if (delete_cat($id, $mysqli)) {
        echo 'done';
    } else {
        echo 'Error in Deleting Category !!';
    }
}

function addCategory($mysqli) {
    $error = 'false';
    $cat = getRequestPostDefault('cat', 'null');
    $cat_desc = getRequestPostDefault('cat_desc', 'null');

    if (add_cat($cat, $cat_desc, $mysqli)) {
        echo 'done';
    } else {
        echo 'Error in Adding Category !!';
    }
}

function editCategory($mysqli) {
    $error = 'false';
    $eid = getRequestPostDefault('eid', 'null');
    $ecat = getRequestPostDefault('ecat', 'null');
    $ecat_desc = getRequestPostDefault('ecat_desc', 'null');

    if (edit_cat($eid, $ecat, $ecat_desc, $mysqli)) {
        echo 'done';
    } else {
        echo 'Error in Updating Category !!';
    }
}

function confirmLogin($mysqli) {
    $error = 'false';
    $erroremail = '';

    //$emailId= trim(stripslashes($_POST['email']));
    //$pass= trim(stripslashes($_POST['password']));

    $emailId = getRequestPostDefault('email', 'null');
    $pass = getRequestPostDefault('password', 'null');

    if (isValidIdPassword($emailId, $pass, $mysqli)) {
        echo 'done';
    } else {
        echo 'Invalid username or password.' . "<br/>" .
        'If you do not know the password, Contact us at customerservice@wtf.ind.in';
    }
}

function changePassword($mysqli) {
    $error = 'false';

    //$emailId= trim(stripslashes($_POST['email']));
    //$pass= trim(stripslashes($_POST['password']));
    $id = getRequestPostDefault('id', 'null');
    $username = getRequestPostDefault('username', 'null');
    $oldPass = getRequestPostDefault('oldPass', 'null');
    $newPass = getRequestPostDefault('newPass', 'null');
    $newPassC = getRequestPostDefault('newPassC', 'null');

    if (updatePassword($id, $username, $oldPass, $newPass, $mysqli)) {
        echo 'done';
    } else {
        echo 'Invalid Password' . "<br/>" .
        'Cannot update password';
    }
}

function isValidIdPassword($loginId, $password, $mysqli) {

    if (!filter_var($loginId, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    $sql = "SELECT user.*
					FROM wtfindin_hms.user
				   WHERE loginId='$loginId'
					 AND password='$password'";
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        throw new Exception($mysqli->error);
    }

    if (mysqli_num_rows($arRes) == 0) {
        return false;
    } else {
        $row = $arRes->fetch_object();
        //$_SESSION[SESS_USER_TYPE] = $row->userType;

        /* if ($row->userType == 'admin') {

          $_SESSION[SESS_LOGIN_ID] = $row->userId;
          $_SESSION[SESS_LOGIN_NAME] = $row->firstName . ' ' . $row->lastName;
          $agentId = '1';
          $_SESSION[SESS_ADMIN_ID] = $agentId;
          $_SESSION[SESS_ADMIN_NAME] = 'WTF Admin';
          } else { */

        $_SESSION[SESS_LOGIN_ID] = $row->userId;
        $_SESSION[SESS_LOGIN_NAME] = $row->first_name . ' ' . $row->last_name;
        //$agentId = $row->userId;
        //$_SESSION[SESS_ADMIN_ID] = $agentId;
        //$_SESSION[SESS_ADMIN_NAME] = $row->firstName . ' ' . $row->lastName;
        //}

        /**
         * Track user login date/time & ip address
         */
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $sql = "INSERT  
						INTO wtfindin_hms.userlogin 
							 (userId,remote_addr)
					   VALUE (" . $_SESSION[SESS_LOGIN_ID] . ",'" . $remote_addr . "')";
        $arRes = $mysqli->query($sql);
        if (!$arRes) {
            throw new Exception($mysqli->error);
        }

        return true;
    }
}

function updatePassword($id, $username, $oldPass, $newPass, $mysqli) {
    $sql = "SELECT user.*
            FROM wtfindin_hms.user
            WHERE userId='$id'
            AND loginId='$username'
            AND password='$oldPass'";
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        throw new Exception($mysqli->error);
    }

    if (mysqli_num_rows($arRes) == 0) {
        return false;
    } else {
        $sql = "UPDATE wtfindin_hms.user
                SET password = '$newPass' 
                WHERE userId='$id' AND loginId='$username'";
        $arRes = $mysqli->query($sql);
        if (!$arRes) {
            throw new Exception($mysqli->error);
        }
        return true;
    }
}

function oldPassCheck($mysqli) {
    $id = getRequestPostDefault('id', 'null');
    $sql = "SELECT user.*
            FROM wtfindin_hms.user
            WHERE userId='$id'";
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        throw new Exception($mysqli->error);
    }

    if (mysqli_num_rows($arRes) == 0) {
        return false;
    } else {
        $row = $arRes->fetch_object();
        $pass = $row->password;

        echo $pass;
        return true;
    }
}

function add_cat($cat, $cat_desc, $mysqli) {

    $sql = "INSERT  INTO wtfindin_hms.drugscategory (drugs_cat,drugs_cat_desc)
            VALUE ('$cat', '$cat_desc')";
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        throw new Exception($mysqli->error);
    }
    return true;
}

function edit_cat($eid, $ecat, $ecat_desc, $mysqli) {
    $sql = "SELECT drugscategory.*
            FROM wtfindin_hms.drugscategory
            WHERE drugs_cat_id='$eid'";
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        throw new Exception($mysqli->error);
    }

    if (mysqli_num_rows($arRes) == 0) {
        return false;
    } else {
        $sql = "UPDATE wtfindin_hms.drugscategory 
                SET drugs_cat='$ecat', drugs_cat_desc='$ecat_desc'
                WHERE drugs_cat_id='$eid'";
        $arRes = $mysqli->query($sql);
        if (!$arRes) {
            throw new Exception($mysqli->error);
        }
        return true;
    }
}

function delete_cat($id, $mysqli) {
    $sql = "SELECT drugscategory.*
            FROM wtfindin_hms.drugscategory
            WHERE drugs_cat_id='$id'";
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        throw new Exception($mysqli->error);
    }

    if (mysqli_num_rows($arRes) == 0) {
        return false;
    } else {
        $sql = "DELETE FROM wtfindin_hms.drugscategory WHERE drugs_cat_id='$id'";
        $arRes = $mysqli->query($sql);
        if (!$arRes) {
            throw new Exception($mysqli->error);
        }
        return true;
    }
}

function delete_drug_detail($id, $mysqli) {
    $sql = "SELECT drugs.*
            FROM wtfindin_hms.drugs
            WHERE drugs_id='$id'";
    $arRes = $mysqli->query($sql);
    if (!$arRes) {
        throw new Exception($mysqli->error);
    }

    if (mysqli_num_rows($arRes) == 0) {
        return false;
    } else {
        $sql = "DELETE FROM wtfindin_hms.drugs WHERE drugs_id='$id'";
        $arRes = $mysqli->query($sql);
        if (!$arRes) {
            throw new Exception($mysqli->error);
        }
        return true;
    }
}

?>