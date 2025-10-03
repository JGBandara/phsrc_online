<?php
session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

require_once $backwardSeparator.'dataAccess/connector.php';  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $sql="SELECT
st_info_is_gov_officer,
st_info_gov_ins_name
FROM
institute_staff_information
where st_info_institute_id=$id ";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$response['is_gov_officer']=$row['st_info_is_gov_officer'];
		$response['ins_name']=$row['st_info_gov_ins_name'];
		}
		
		//--------------------------------------------------
			$sql = "select
				Name,Qulification,institute,country,post_gradu,speciality,Register_id
				from institute_staff_information_stf_detail
				where institute_id=$id order by institute_id
				";
		$result = $db->singleQuery($sql);
		$arrDetail1;
		while($row=mysqli_fetch_array($result))
		{
			$val1['Name'] 		= $row['Name'];
			$val1['Qulification'] 	= $row['Qulification'];
			$val1['institute'] 	= $row['institute'];
			$val1['country'] 		= $row['country'];
			$val1['post_gradu'] 	= $row['post_gradu'];
			$val1['speciality'] 	= $row['speciality'];
			$val1['Register_id'] 	= $row['Register_id'];
			
			$arrDetail1[] = $val1;
		}
		$response['detailVal1'] = $arrDetail1;
//-----------------------------------------------------------------------------

//-----------------------------------------------------------------------------
			$sqlMgt = "SELECT
institute_id,
position_id,
name,
contact_detail,
info
FROM
institute_staff_information_managment_detail
where institute_id=$id
				";
		$resultMgt = $db->singleQuery($sqlMgt);
		$arrDetail2;
		while($row=mysqli_fetch_array($resultMgt))
		{
			$val2['position']= $row['position_id'];
			$val2['name'] 	= $row['name'];
			$val2['contact']	= $row['contact_detail'];
			$val2['info']	= $row['info'];
			
			$arrDetail2[] = $val2;
		}
		$response['detailVal2'] = $arrDetail2;
//-----------------------------------------------------------------------------

//-----------------------------------------------------------------------------
			$sqlQualification = "select				qualification_detail_name,qualification_detail_qualification,qualification_detail_basic,qualification_detail_post_graduate,qualification_detail_year,qualification_detail_university,qualification_detail_country
				from institute_staff_information_qualification_detail
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
institute_registration where ins_is_deleted='0' and ins_type_id='9' and ins_created_by=$userId and approval_status!=1
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





