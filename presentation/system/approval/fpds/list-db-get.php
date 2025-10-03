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
fpds_new_registration.fpds_application_id,
fpds_new_registration.fpds_owner_name,
fpds_new_registration.fpds_pd_approval,
fpds_new_registration.fpds_last_modified_on,
fpds_payment_detail.payment_detail_institute_id,
fpds_payment_detail.payment_type
FROM
fpds_new_registration
Inner Join fpds_payment_detail ON fpds_new_registration.fpds_application_id = fpds_payment_detail.payment_detail_institute_id
          order by fpds_application_id asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		
		
		$response['id'][]=$row['fpds_application_id'];
		$response['ownerName'][]=$row['fpds_owner_name'];
		$response['crDate'][]=$row['fpds_last_modified_on'];
		$response['paymentType'][]=$row['payment_type'];
		$response['approveStatus'][]=$row['fpds_pd_approval'];
		
		}

  echo json_encode($response);
  
}else if($requestType=='loadInstituteDetail'){
	 $id = $_REQUEST['id'];
  $sql="SELECT
fpds_new_registration.fpds_application_id,
fpds_new_registration.fpds_owner_name,
fpds_new_registration.fpds_owner_relationship,
fpds_new_registration.fpds_owner_address,
fpds_new_registration.fpds_institute_name,
fpds_new_registration.fpds_institute_address,
fpds_new_registration.fpds_province_id,
fpds_new_registration.fpds_district_id,
fpds_new_registration.fpds_pd_approval,
fpds_staff_information.st_info_institute_id,
fpds_staff_information.st_info_slmc_reg_no,
fpds_staff_information.st_info_is_gov_officer,
fpds_staff_information.st_info_gov_ins_name,
fpds_staff_information.st_info_hours_of_practice,
fpds_institute_information.ins_info_record_keeping_id,
fpds_institute_information.ins_info_visiting_speciality_availability,
fpds_institute_information.ins_info_dental_lab_facility,
fpds_institute_information.ins_info_x_ray_facility,
fpds_institute_information.ins_info_emargancy_kit_availability,
fpds_institute_information.ins_info_other_facility,
fpds_institute_information.ins_info_owner,
fpds_institute_information.ins_info_practice_type,
fpds_institute_information.ins_info_speciality,
fpds_institute_information.ins_info_disposal_method,
fpds_institute_information.ins_info_instruments_dressings,
fpds_payment_detail.payment_detail_institute_id,
fpds_payment_detail.payment_detail_id,
fpds_payment_detail.payment_amount,
fpds_payment_detail.payment_date,
fpds_payment_detail.payment_branch,
fpds_payment_detail.payment_type,
fpds_payment_detail.payment_silp_name,
fpds_staff_information.st_info_prac_type_privet_dental,
tbl_district.dis_id,
tbl_district.dis_name,
tbl_province.pro_name,
tbl_record_keep.record_type,
tbl_record_keep.record_keep_id,
tbl_owner.ownership
FROM
fpds_new_registration
Left Join fpds_staff_information ON fpds_new_registration.fpds_application_id = fpds_staff_information.st_info_institute_id
Left Join fpds_institute_information ON fpds_new_registration.fpds_application_id = fpds_institute_information.ins_info_institute_id
Left Join fpds_payment_detail ON fpds_new_registration.fpds_application_id = fpds_payment_detail.payment_detail_institute_id
Inner Join tbl_district ON fpds_new_registration.fpds_district_id = tbl_district.dis_id
left Join tbl_province ON fpds_new_registration.fpds_province_id = tbl_province.pro_id
left Join tbl_record_keep ON fpds_institute_information.ins_info_record_keeping_id = tbl_record_keep.record_keep_id
left Join tbl_owner ON fpds_institute_information.ins_info_owner = tbl_owner.ownership_id
where fpds_new_registration.fpds_application_id=$id
";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		$response['aId']=$row['fpds_application_id'];
		$response['ownerName']=$row['fpds_owner_name'];
		$response['relationsip']=$row['fpds_owner_relationship'];
		$response['owAddress']=$row['fpds_owner_address'];
		$response['insName']=$row['fpds_institute_name'];
		$response['insAddress']=$row['fpds_institute_address'];
		$response['province']= $row['pro_name'];
		$response['district']= $row['dis_name'];
		$response['approvalStatus']=$row['fpds_pd_approval'];
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





