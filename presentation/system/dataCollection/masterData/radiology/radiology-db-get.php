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
   $sql = "select rd_id, rd_code, rd_name
            from rd_mst_radiology
            where rd_company_id='$userCompanyId' and rd_is_deleted='0' 
            order by trim(rd_code) asc
            ";
    	$result=$db->singleQuery($sql);
    $html = "<option value=\"\"></option>";
    while($row=mysqli_fetch_array($result)){
        $html .= "<option value='".$row['rd_id']."'>".$row['rd_code'].' - '.$row['rd_name']."</option>";
    }
    echo $html;
}

if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $sql="SELECT
rd_code, rd_name, rd_description, rd_status
FROM
rd_mst_radiology
where rd_id=$id and rd_company_id='$userCompanyId' and rd_is_deleted='0'
order by rd_code asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		
		
		$response['rd_code'][]=$row['rd_code'];
		$response['rd_name'][]=$row['rd_name'];
		$response['rd_description'][]=$row['rd_description'];
		$response['rd_status'][]=$row['rd_status'];
		
		}

  echo json_encode($response);
  
}

?>





