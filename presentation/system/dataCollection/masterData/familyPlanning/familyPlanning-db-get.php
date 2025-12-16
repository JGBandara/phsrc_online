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
   $sql = "select fp_id, fp_code, fp_name
            from fp_mst_method
            where fp_company_id='$userCompanyId' and fp_is_deleted='0' 
            order by trim(fp_code) asc
            ";
    	$result=$db->singleQuery($sql);
    $html = "<option value=\"\"></option>";
    while($row=mysqli_fetch_array($result)){
        $html .= "<option value='".$row['fp_id']."'>".$row['fp_code'].' - '.$row['fp_name']."</option>";
    }
    echo $html;
}

if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $sql="SELECT
fp_code, fp_name, fp_description, fp_status
FROM
fp_mst_method
where fp_id=$id and fp_company_id='$userCompanyId' and fp_is_deleted='0'
order by fp_code asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		
		
		$response['fp_code'][]=$row['fp_code'];
		$response['fp_name'][]=$row['fp_name'];
		$response['fp_description'][]=$row['fp_description'];
		$response['fp_status'][]=$row['fp_status'];
		
		}

  echo json_encode($response);
  
}

?>





