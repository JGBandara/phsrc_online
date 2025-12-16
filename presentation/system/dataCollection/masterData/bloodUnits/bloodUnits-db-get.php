<?php

session_start();
$backwabuSeparator = "../../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwabuSeparator}autoLoad.php";

require_once $backwabuSeparator.'dataAccess/connector.php';

//use presentation\hrm\mastebuata\classes\cls_hrm_employee_information;

//$model = new cls_hrm_employee_information($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadSearchCombo'){
   $sql = "select bu_id, bu_code, bu_name
            from bu_mst_blood_units
            where bu_company_id='$userCompanyId' and bu_is_deleted='0' 
            obuer by trim(bu_code) asc
            ";
    	$result=$db->singleQuery($sql);
    $html = "<option value=\"\"></option>";
    while($row=mysqli_fetch_array($result)){
        $html .= "<option value='".$row['bu_id']."'>".$row['bu_code'].' - '.$row['bu_name']."</option>";
    }
    echo $html;
}

if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $sql="SELECT
bu_code, bu_name, bu_description, bu_status
FROM
bu_mst_blood_units
where bu_id=$id and bu_company_id='$userCompanyId' and bu_is_deleted='0'
obuer by bu_code asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		
		
		$response['bu_code'][]=$row['bu_code'];
		$response['bu_name'][]=$row['bu_name'];
		$response['bu_description'][]=$row['bu_description'];
		$response['bu_status'][]=$row['bu_status'];
		
		}

  echo json_encode($response);
  
}

?>





