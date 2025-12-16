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
   $sql = "select dl_id, dl_code, dl_name
            from dl_mst_deliveries
            where dl_company_id='$userCompanyId' and dl_is_deleted='0' 
            order by trim(dl_code) asc
            ";
    	$result=$db->singleQuery($sql);
    $html = "<option value=\"\"></option>";
    while($row=mysqli_fetch_array($result)){
        $html .= "<option value='".$row['dl_id']."'>".$row['dl_code'].' - '.$row['dl_name']."</option>";
    }
    echo $html;
}

if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $sql="SELECT
dl_code, dl_name, dl_description, dl_status
FROM
dl_mst_deliveries
where dl_id=$id and dl_company_id='$userCompanyId' and dl_is_deleted='0'
order by dl_code asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		
		
		$response['dl_code'][]=$row['dl_code'];
		$response['dl_name'][]=$row['dl_name'];
		$response['dl_description'][]=$row['dl_description'];
		$response['dl_status'][]=$row['dl_status'];
		
		}

  echo json_encode($response);
  
}

?>





