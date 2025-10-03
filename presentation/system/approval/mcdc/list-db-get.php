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
mcdc_new_registration.mcdc_application_id,
mcdc_new_registration.mcdc_owner_name,
mcdc_new_registration.mcdc_pd_approval,
mcdc_new_registration.mcdc_last_modified_on,
mcdc_payment_detail.payment_detail_institute_id,
mcdc_payment_detail.payment_type
FROM
mcdc_new_registration
Inner Join mcdc_payment_detail ON mcdc_new_registration.mcdc_application_id = mcdc_payment_detail.payment_detail_institute_id
          order by mcdc_application_id asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		
		
		$response['id'][]=$row['mcdc_application_id'];
		$response['ownerName'][]=$row['mcdc_owner_name'];
		$response['crDate'][]=$row['mcdc_last_modified_on'];
		$response['paymentType'][]=$row['payment_type'];
		$response['approveStatus'][]=$row['mcdc_pd_approval'];
		
		}

  echo json_encode($response);
  
}else if($requestType=='loadInstituteDetail'){
	 $id = $_REQUEST['id'];
  $sql="SELECT
mcdc_new_registration.mcdc_application_id,
mcdc_new_registration.mcdc_owner_name,
mcdc_new_registration.mcdc_owner_relationship,
mcdc_new_registration.mcdc_owner_address,
mcdc_new_registration.mcdc_institute_name,
mcdc_new_registration.mcdc_institute_address,
mcdc_new_registration.mcdc_province_id,
mcdc_new_registration.mcdc_district_id,
mcdc_new_registration.mcdc_pd_approval,
mcdc_staff_information.st_info_institute_id,
mcdc_staff_information.st_info_hours_of_practice,
mcdc_institute_information.ins_info_record_keeping_id,
mcdc_institute_information.ins_info_visiting_speciality_availability,
mcdc_institute_information.ins_info_dental_lab_facility,
mcdc_institute_information.ins_info_x_ray_facility,
mcdc_institute_information.ins_info_emargancy_kit_availability,
mcdc_institute_information.ins_info_other_facility,
mcdc_institute_information.ins_info_owner,
mcdc_institute_information.ins_info_practice_type,
mcdc_institute_information.ins_info_speciality,
mcdc_institute_information.ins_info_disposal_method,
mcdc_institute_information.ins_info_instruments_dressings,
mcdc_payment_detail.payment_detail_institute_id,
mcdc_payment_detail.payment_detail_id,
mcdc_payment_detail.payment_amount,
mcdc_payment_detail.payment_date,
mcdc_payment_detail.payment_branch,
mcdc_payment_detail.payment_type,
mcdc_payment_detail.payment_silp_name,
tbl_district.dis_id,
tbl_district.dis_name,
tbl_province.pro_name,
tbl_record_keep.record_type,
tbl_record_keep.record_keep_id,
tbl_owner.ownership
FROM
mcdc_new_registration
Left Join mcdc_staff_information ON mcdc_new_registration.mcdc_application_id = mcdc_staff_information.st_info_institute_id
Left Join mcdc_institute_information ON mcdc_new_registration.mcdc_application_id = mcdc_institute_information.ins_info_institute_id
Left Join mcdc_payment_detail ON mcdc_new_registration.mcdc_application_id = mcdc_payment_detail.payment_detail_institute_id
Inner Join tbl_district ON mcdc_new_registration.mcdc_district_id = tbl_district.dis_id
left Join tbl_province ON mcdc_new_registration.mcdc_province_id = tbl_province.pro_id
left Join tbl_record_keep ON mcdc_institute_information.ins_info_record_keeping_id = tbl_record_keep.record_keep_id
left Join tbl_owner ON mcdc_institute_information.ins_info_owner = tbl_owner.ownership_id
where mcdc_new_registration.mcdc_application_id=$id
";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		$response['aId']=$row['mcdc_application_id'];
		$response['ownerName']=$row['mcdc_owner_name'];
		$response['relationsip']=$row['mcdc_owner_relationship'];
		$response['owAddress']=$row['mcdc_owner_address'];
		$response['insName']=$row['mcdc_institute_name'];
		$response['insAddress']=$row['mcdc_institute_address'];
		$response['province']= $row['pro_name'];
		$response['district']= $row['dis_name'];
		$response['approvalStatus']=$row['mcdc_pd_approval'];
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





