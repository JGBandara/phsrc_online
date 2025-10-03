<?php
session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

require_once $backwardSeparator.'dataAccess/connector.php';

use presentation\hrm\masterData\classes\cls_hrm_employee_information;

$model = new cls_hrm_employee_information($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  
  $sql= "select ins_faci_institute_id,ins_no_of_bed,ins_no_of_room,ins_no_of_ward,ins_radio_service,ins_no_of_license,ins_waste_disposal,ins_inst_dress,ins_emergency_kit from institute_facility where ins_faci_institute_id= $id";
  
  $result=$db->singleQuery($sql);
  while($row=mysqli_fetch_array($result)){
	  $response['noBed'] = $row['ins_no_of_bed'];
	  $response['noRoom'] = $row['ins_no_of_room'];
	  $response['noWard'] = $row['ins_no_of_ward'];
	  $response['radioSer'] = $row['ins_radio_service'];
	  $response['noLicense'] = $row['ins_no_of_license'];
	  $response['disposal'] = $row['ins_waste_disposal'];
	  $response['instDress'] = $row['ins_inst_dress'];
	  $response['emgKit'] = $row['ins_emergency_kit'];
	  
	  }
 
			$sql = "select
				facility_id,facility_detail_value,facility_description
				from phnh_facility_detail
				where facility_detail_institute_id=$id order by facility_detail_id
				";
		$result = $db->singleQuery($sql);
		$arrDetail1;
		while($row=mysqli_fetch_array($result))
		{
			$val1['facility']		= $row['facility_id'];
			$val1['value'] 	= $row['facility_detail_value'];
			$val1['description']	= $row['facility_description'];
			
			$arrDetail1[] = $val1;
		}
		$response['detailVal1'] = $arrDetail1;
//-----------------------------------------------------------------------------


  echo json_encode($response);
  
}
elseif($requestType=='loadSearchCombo'){
  $sql="SELECT
ins_application_id,
ins_institute_name
FROM
institute_registration where ins_is_deleted='0' and ins_type_id='10' and ins_created_by=$userId and approval_status!=1
          order by ins_application_id asc";
		  $html = "<option vlaue=\"\"></option>";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		$html .= "<option value=\"".$row['ins_application_id']."\">".$row['ins_institute_name']."</option>";
		}
	echo $html;		  
		  
}
elseif($requestType=='loadPartial'){
  try{
    $recordId = $_REQUEST['record_id'];
    $model->emi_id = $recordId;
    $model->emi_company_id = $userCompanyId;
    $model = $model->findModel();
    ob_start();
//    echo "janaka";
    include "./employeeInformationPartialView.php";
    $value = ob_get_clean();
    $response['content'] 	= $value;
    $response['type'] 	= 'pass';
    $response['msg'] 	= 'Saved successfully.';
  }catch(Exception $e){
    $response['type'] 	= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 		= $sql;                
  }
  echo json_encode($response);
}
?>





