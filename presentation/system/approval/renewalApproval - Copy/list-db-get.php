<?php

session_start();
$backwardSeparator = "../../../../";
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
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $sql="SELECT
institute_registration.ins_application_id,
institute_registration.ins_type_id,
institute_registration.ins_institute_name,
institute_payment_detail.payment_date,
institute_payment_detail.payment_type,
institute_payment_detail.payment_is_approval
FROM
institute_registration
Inner Join institute_payment_detail ON institute_registration.ins_application_id = institute_payment_detail.payment_detail_institute_id
where is_renew=1  order by ins_application_id asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		
		
		$response['id'][]=$row['ins_application_id'];
		$response['ownerName'][]=$row['ins_institute_name'];
		$response['crDate'][]=$row['payment_date'];
		$response['paymentType'][]=$row['payment_type'];
		$response['approveStatus'][]=$row['payment_is_approval'];
		
		}

  echo json_encode($response);
  
}else if($requestType=='loadInstituteDetail'){
	 $id = $_REQUEST['id'];
  $sql="SELECT
tbl_province.pro_name,
tbl_district.dis_name,
institute_registration.ins_application_id,
institute_registration.ins_type_id,
institute_registration.ins_owner_name,
institute_registration.ins_owner_relationship,
institute_registration.ins_owner_offic_address,
institute_registration.ins_owner_address,
institute_registration.ins_institute_name,
institute_registration.ins_institute_address,
institute_registration.ins_telephone,
institute_registration.ins_email,
institute_registration.ins_status
FROM
institute_registration
Inner Join tbl_province ON institute_registration.ins_province_id = tbl_province.pro_id
Inner Join tbl_district ON institute_registration.ins_district_id = tbl_district.dis_id
";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		$response['aId']=$row['ins_application_id'];
		$response['ownerName']=$row['ins_owner_name'];
		$response['relationsip']=$row['ins_owner_relationship'];
		$response['owAddress']=$row['ins_owner_address'];
		$response['insName']=$row['ins_institute_name'];
		$response['insAddress']=$row['ins_institute_address'];
		$response['province']= $row['pro_name'];
		$response['district']= $row['dis_name'];
		$response['approvalStatus']=$row['ins_status'];
		//------------------------------------------------------------------------------------------------
		$response['slmc']=$row['st_info_slmc_reg_no'];
		$response['is_gov_officer']=$row['st_info_is_gov_officer'];
		$response['gov_is_name']=$row['st_info_gov_ins_name'];
		$response['prac_houre']= $row['st_info_hours_of_practice'];
		//------------------------------------------------------------------------------------------------
		$response['rec_keeping']=$row['record_type'];
		$response['speciality_availability']=$row['ins_info_visiting_speciality_availability'];
		$response['lab_facility']=$row['ins_info_dental_lab_facility'];
		$response['x_ray_facility']= $row['ins_info_x_ray_facility'];
		$response['em_kit_availability']=$row['ins_info_emargancy_kit_availability'];
		$response['other_facility']=$row['ins_info_other_facility'];
		$response['ownership']=$row['ownership'];
		$response['prac_type']= $row['ins_info_practice_type'];
		$response['speciality_info']=$row['ins_info_speciality'];
		$response['disposal_method']=$row['ins_info_disposal_method'];
		$response['instrument_dressings']=$row['ins_info_instruments_dressings'];
		//------------------------------------------------------------------------------------------------
		$response['payAmont']=$row['payment_amount'];
		$response['payDate']=$row['payment_date'];
		$response['payBranch']=$row['payment_branch'];
		$response['payType']= $row['payment_type'];
		$response['payImageName']	=$row['payment_silp_name'];
		//------------------------------------------------------------------------------------------------
		}
  echo json_encode($response);
	}

?>





