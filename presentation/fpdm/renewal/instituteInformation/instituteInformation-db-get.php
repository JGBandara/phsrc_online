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
ins_info_x_ray_facility,
ins_info_emargancy_kit_availability,
ins_info_other_facility,
ins_info_owner,
ins_info_practice_type,
ins_info_speciality,
ins_info_disposal_method,
ins_info_instruments_dressings,
ins_info_appoinment_system
FROM
fpdm_institute_information
where ins_info_institute_id=$id ";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$response['Rec_keeping']=$row['ins_info_record_keeping_id'];
		$response['visitingSpeciality']=$row['ins_info_visiting_speciality_availability'];
		$response['XRayFacility']=$row['ins_info_x_ray_facility'];
		$response['emargancyKit']=$row['ins_info_emargancy_kit_availability'];
		$response['otherFacility'] =$row['ins_info_other_facility'];
		$response['owner']= $row['ins_info_owner'];
		$response['pracType']= $row['ins_info_practice_type'];
		$response['speciality'] =$row['ins_info_speciality'];
		$response['disposalMethod']= $row['ins_info_disposal_method'];
		$response['insDressing']= $row['ins_info_instruments_dressings'];
		$response['appoinmentSystem']= $row['ins_info_appoinment_system'];
		
		}
		

  echo json_encode($response);
  
}
elseif($requestType=='loadSearchCombo'){
  $sql="SELECT
fpds_new_registration.fpds_application_id,
fpds_new_registration.fpds_owner_name,
fpds_new_registration.fpds_owner_relationship,
fpds_new_registration.fpds_owner_address,
fpds_new_registration.fpds_institute_name,
fpds_new_registration.fpds_institute_address,
fpds_new_registration.fpds_province_id,
fpds_new_registration.fpds_district_id,
fpds_new_registration.fpds_is_deleted
FROM
fpds_new_registration
          order by fpds_application_id asc";
		  $html = "<option vlaue=\"\"></option>";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$html .= "<option value=\"".$row['fpds_application_id']."\">".$row['fpds_institute_name']."</option>";
		
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





