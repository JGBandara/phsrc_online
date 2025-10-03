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
st_info_prac_type_group,
st_info_prac_type_induvidual,
st_info_prac_type_other,
st_info_hours_of_practice
FROM
fpdm_staff_information
where st_info_institute_id=$id ";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		$response['group']=$row['st_info_prac_type_group'];
		$response['induvidual'] =$row['st_info_prac_type_induvidual'];
		$response['other']= $row['st_info_prac_type_other'];
		$response['practice_hours']= $row['st_info_hours_of_practice'];
		}
		
		//--------------------------------------------------
			$sql = "select
				off_detail_name,off_detail_category,off_detail_place,off_detail_type
				from fpdm_staff_information_officer_detail
				where off_detail_institute_id=$id order by off_detail_id
				";
		$result = $db->singleQuery($sql);
		$arrDetail1;
		while($row=mysqli_fetch_array($result))
		{
			$val1['name']		= $row['off_detail_name'];
			$val1['category'] 	= $row['off_detail_category'];
			$val1['place']	= $row['off_detail_place'];
			$val1['type']	= $row['off_detail_type'];
			
			$arrDetail1[] = $val1;
		}
		$response['detailVal1'] = $arrDetail1;
//-----------------------------------------------------------------------------

//-----------------------------------------------------------------------------
			$sqlQualification = "select
				qualification_detail_name,qualification_detail_qualification,qualification_detail_basic,qualification_detail_post_graduate,qualification_detail_year,qualification_detail_university,qualification_detail_country,qualification_detail_slmc_no,qualification_detail_slmc_date
				from fpdm_staff_information_qualification_detail
				where qualification_detail_institute_id=$id order by qualification_detail_id
				";
		$resultQualification = $db->singleQuery($sqlQualification);
		$arrDetail3;
		while($row=mysqli_fetch_array($resultQualification))
		{
			$val3['qualiName']= $row['qualification_detail_name'];
			$val3['qualification'] 	= $row['qualification_detail_qualification'];
			$val3['basic']	= $row['qualification_detail_basic'];
			$val3['postGraduate']	= $row['qualification_detail_post_graduate'];
			$val3['qualiYear']	= $row['qualification_detail_year'];
			$val3['postUniversity']	= $row['qualification_detail_university'];
			$val3['country']	= $row['qualification_detail_country'];
			$val3['slmcNo']	= $row['qualification_detail_slmc_no'];
			$val3['slmcDate']	= $row['qualification_detail_slmc_date'];
			
			$arrDetail3[] = $val3;
		}
		$response['detailVal3'] = $arrDetail3;
//-----------------------------------------------------------------------------

  echo json_encode($response);
  
}
elseif($requestType=='loadSearchCombo'){
  $sql="SELECT
fpdm_new_registration.fpdm_application_id,
fpdm_new_registration.fpdm_owner_name,
fpdm_new_registration.fpdm_owner_relationship,
fpdm_new_registration.fpdm_owner_address,
fpdm_new_registration.fpdm_institute_name,
fpdm_new_registration.fpdm_institute_address,
fpdm_new_registration.fpdm_province_id,
fpdm_new_registration.fpdm_district_id,
fpdm_new_registration.fpdm_is_deleted
FROM
fpdm_new_registration
          order by fpdm_application_id asc";
		  $html = "<option vlaue=\"\"></option>";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$html .= "<option value=\"".$row['fpdm_application_id']."\">".$row['fpdm_institute_name']."</option>";
		
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





