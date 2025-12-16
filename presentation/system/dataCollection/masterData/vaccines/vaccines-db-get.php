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
   $sql = "select vc_id, vc_code, vc_name
            from vc_mst_vaccines
            where vc_company_id='$userCompanyId' and vc_is_deleted='0' 
            order by trim(vc_code) asc
            ";
    	$result=$db->singleQuery($sql);
    $html = "<option value=\"\"></option>";
    while($row=mysqli_fetch_array($result)){
        $html .= "<option value='".$row['vc_id']."'>".$row['vc_code'].' - '.$row['vc_name']."</option>";
    }
    echo $html;
}

if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $sql="SELECT
vc_code, vc_name, vc_description, vc_status
FROM
vc_mst_vaccines
where vc_id=$id and vc_company_id='$userCompanyId' and vc_is_deleted='0'
order by vc_code asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		
		
		$response['vc_code'][]=$row['vc_code'];
		$response['vc_name'][]=$row['vc_name'];
		$response['vc_description'][]=$row['vc_description'];
		$response['vc_status'][]=$row['vc_status'];
		
		}

  echo json_encode($response);
  
}

?>





