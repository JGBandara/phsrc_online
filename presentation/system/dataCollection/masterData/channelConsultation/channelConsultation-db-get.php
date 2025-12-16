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
   $sql = "select chn_id, chn_code, chn_name
            from chn_mst_consultation
            where chn_company_id='$userCompanyId' and chn_is_deleted='0' 
            order by trim(chn_code) asc
            ";
    	$result=$db->singleQuery($sql);
    $html = "<option value=\"\"></option>";
    while($row=mysqli_fetch_array($result)){
        $html .= "<option value='".$row['chn_id']."'>".$row['chn_code'].' - '.$row['chn_name']."</option>";
    }
    echo $html;
}

if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $sql="SELECT
chn_code, chn_name, chn_no, chn_description, chn_status
FROM
chn_mst_consultation
where chn_id=$id and chn_company_id='$userCompanyId' and chn_is_deleted='0'
order by chn_code asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		
		
		$response['chn_code'][]=$row['chn_code'];
		$response['chn_name'][]=$row['chn_name'];
        $response['chn_no'][]=$row['chn_no'];
		$response['chn_description'][]=$row['chn_description'];
		$response['chn_status'][]=$row['chn_status'];
		
		}

  echo json_encode($response);
  
}

?>





