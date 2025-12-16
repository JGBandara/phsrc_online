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
   $sql = "select lt_id, lt_code, lt_name
            from lt_mst_tests
            where lt_company_id='$userCompanyId' and lt_is_deleted='0' 
            order by trim(lt_code) asc
            ";
    	$result=$db->singleQuery($sql);
    $html = "<option value=\"\"></option>";
    while($row=mysqli_fetch_array($result)){
        $html .= "<option value='".$row['lt_id']."'>".$row['lt_code'].' - '.$row['lt_name']."</option>";
    }
    echo $html;
}

if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $sql="SELECT
lt_code, lt_name, lt_description, lt_status
FROM
lt_mst_tests
where lt_id=$id and lt_company_id='$userCompanyId' and lt_is_deleted='0'
order by lt_code asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		
		
		$response['lt_code'][]=$row['lt_code'];
		$response['lt_name'][]=$row['lt_name'];
		$response['lt_description'][]=$row['lt_description'];
		$response['lt_status'][]=$row['lt_status'];
		
		}

  echo json_encode($response);
  
}

?>





