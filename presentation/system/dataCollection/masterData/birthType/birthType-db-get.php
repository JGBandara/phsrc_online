<?php

session_start();
$backwardSeparator = "../../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

require_once $backwardSeparator.'dataAccess/connector.php';

//use presentation\hrm\masterData\classes\cls_hrm_employee_information;

//$model = new cls_hrm_employee_information($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadSearchCombo'){
   $sql = "select bt_id, bt_code, bt_name
            from bt_mst_birth_type
            where bt_company_id='$userCompanyId' and bt_is_deleted='0' 
            order by trim(bt_code) asc
            ";
    	$result=$db->singleQuery($sql);
    $html = "<option value=\"\"></option>";
    while($row=mysqli_fetch_array($result)){
        $html .= "<option value='".$row['bt_id']."'>".$row['bt_code'].' - '.$row['bt_name']."</option>";
    }
    echo $html;
}

if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $sql="SELECT
bt_code, bt_name, bt_description, bt_status
FROM
bt_mst_birth_type
where bt_id=$id and bt_company_id='$userCompanyId' and bt_is_deleted='0'
order by bt_code asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		
		
		$response['bt_code'][]=$row['bt_code'];
		$response['bt_name'][]=$row['bt_name'];
		$response['bt_description'][]=$row['bt_description'];
		$response['bt_status'][]=$row['bt_status'];
		
		}

  echo json_encode($response);
  
}

?>





