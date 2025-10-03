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
  $sql="SELECT
ins_info_record_keeping_id,
ins_info_visiting_speciality_availability,
ins_info_dental_lab_facility,
ins_info_x_ray_facility,
ins_info_emargancy_kit_availability,
ins_info_other_facility,
ins_info_owner,
ins_info_practice_type,
ins_info_speciality,
ins_info_disposal_method,
ins_info_instruments_dressings
FROM
fpds_institute_information
where ins_info_institute_id=$id ";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$response['Rec_keeping']=$row['ins_info_record_keeping_id'];
		$response['visitingSpeciality']=$row['ins_info_visiting_speciality_availability'];
		$response['labFacility']=$row['ins_info_dental_lab_facility'];
		$response['XRayFacility']=$row['ins_info_x_ray_facility'];
		$response['emargancyKit']=$row['ins_info_emargancy_kit_availability'];
		$response['otherFacility'] =$row['ins_info_other_facility'];
		$response['owner']= $row['ins_info_owner'];
		$response['pracType']= $row['ins_info_practice_type'];
		$response['speciality'] =$row['ins_info_speciality'];
		$response['disposalMethod']= $row['ins_info_disposal_method'];
		$response['insDressing']= $row['ins_info_instruments_dressings'];
		
		}
		

  echo json_encode($response);
  
}
elseif($requestType=='loadSearchCombo'){
  $sql="SELECT
ins_application_id,
ins_institute_name
FROM
institute_registration
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





