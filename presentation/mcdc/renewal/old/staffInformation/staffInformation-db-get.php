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
st_info_slmc_reg_no,
st_info_is_gov_officer,
st_info_gov_ins_name,
st_info_prac_type_full_time,
st_info_prac_type_group,
st_info_prac_type_induvidual,
st_info_prac_type_nursing_home,
st_info_prac_type_privet_dental,
st_info_hours_of_practice
FROM
fpds_staff_information
where st_info_institute_id=$id ";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$response['slmc_no']=$row['st_info_slmc_reg_no'];
		$response['is_gov_officer']=$row['st_info_is_gov_officer'];
		$response['ins_name']=$row['st_info_gov_ins_name'];
		$response['full_time']=$row['st_info_prac_type_full_time'];
		$response['group']=$row['st_info_prac_type_group'];
		$response['induvidual'] =$row['st_info_prac_type_induvidual'];
		$response['nursing_home']= $row['st_info_prac_type_nursing_home'];
		$response['pvt_dental']= $row['st_info_prac_type_privet_dental'];
		$response['practice_hours']= $row['st_info_hours_of_practice'];
		}
		
		//--------------------------------------------------
			$sql = "select
				seg_detail_name,seg_detail_private,seg_detail_work_place,seg_detail_practice_i,seg_detail_practice_ii
				from fpds_staff_information_surg_detail
				where seg_detail_institute_id=$id order by seg_detail_id
				";
		$result = $db->singleQuery($sql);
		$arrDetail1;
		while($row=mysqli_fetch_array($result))
		{
			$val1['name']		= $row['seg_detail_name'];
			$val1['private'] 	= $row['seg_detail_private'];
			$val1['workplace']	= $row['seg_detail_work_place'];
			$val1['practice_i']	= $row['seg_detail_practice_i'];
			$val1['practice_ii']= $row['seg_detail_practice_ii'];
			
			$arrDetail1[] = $val1;
		}
		$response['detailVal1'] = $arrDetail1;
//-----------------------------------------------------------------------------

//-----------------------------------------------------------------------------
			$sqlCom = "select
				com_detail_name,com_detail_genaral_no,com_detail_fax_no,com_detail_mobile_no,com_detail_email
				from fpds_staff_information_communication_detail
				where com_detail_institute_id=$id order by com_detail_id
				";
		$resultcom = $db->singleQuery($sqlCom);
		$arrDetail2;
		while($row=mysqli_fetch_array($resultcom))
		{
			$val2['comName']= $row['com_detail_name'];
			$val2['genNo'] 	= $row['com_detail_genaral_no'];
			$val2['fax']	= $row['com_detail_fax_no'];
			$val2['mobNo']	= $row['com_detail_mobile_no'];
			$val2['email']	= $row['com_detail_email'];
			
			$arrDetail2[] = $val2;
		}
		$response['detailVal2'] = $arrDetail2;
//-----------------------------------------------------------------------------

//-----------------------------------------------------------------------------
			$sqlQualification = "select
				qualification_detail_name,qualification_detail_qualification,qualification_detail_basic,qualification_detail_post_graduate,qualification_detail_year,qualification_detail_university,qualification_detail_country
				from fpds_staff_information_qualification_detail
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
			
			$arrDetail3[] = $val3;
		}
		$response['detailVal3'] = $arrDetail3;
//-----------------------------------------------------------------------------

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





