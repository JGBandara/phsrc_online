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
   $sql = "select dc_id, dc_code, dc_name
            from dc_mst_diseases
            where dc_company_id='$userCompanyId' and dc_is_deleted='0' 
            order by trim(dc_code) asc
            ";
    	$result=$db->singleQuery($sql);
    $html = "<option value=\"\"></option>";
    while($row=mysqli_fetch_array($result)){
        $html .= "<option value='".$row['dc_id']."'>".$row['dc_code'].' - '.$row['dc_name']."</option>";
    }
    echo $html;
}

if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $sql="SELECT
dc_code, dc_name, dc_description, dc_status
FROM
dc_mst_diseases
where dc_id=$id and dc_company_id='$userCompanyId' and dc_is_deleted='0'
order by dc_code asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		
		
		$response['dc_code'][]=$row['dc_code'];
		$response['dc_name'][]=$row['dc_name'];
		$response['dc_description'][]=$row['dc_description'];
		$response['dc_status'][]=$row['dc_status'];
		
		}

  echo json_encode($response);
  
}

?>





