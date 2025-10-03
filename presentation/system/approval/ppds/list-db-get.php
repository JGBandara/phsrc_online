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
ppds_new_registration.ppds_application_id,
ppds_new_registration.ppds_owner_name,
ppds_new_registration.ppds_pd_approval,
ppds_new_registration.ppds_last_modified_on,
ppds_payment_detail.payment_detail_institute_id,
ppds_payment_detail.payment_type
FROM
ppds_new_registration
Inner Join ppds_payment_detail ON ppds_new_registration.ppds_application_id = ppds_payment_detail.payment_detail_institute_id
          order by ppds_application_id asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		
		
		$response['id'][]=$row['ppds_application_id'];
		$response['ownerName'][]=$row['ppds_owner_name'];
		$response['crDate'][]=$row['ppds_last_modified_on'];
		$response['paymentType'][]=$row['payment_type'];
		$response['approveStatus'][]=$row['ppds_pd_approval'];
		
		}

  echo json_encode($response);
  
}else if($requestType=='loadInstituteDetail'){
	 $id = $_REQUEST['id'];
  $sql="SELECT
ppds_new_registration.ppds_application_id,
ppds_new_registration.ppds_owner_name,
ppds_new_registration.ppds_owner_relationship,
ppds_new_registration.ppds_owner_address,
ppds_new_registration.ppds_institute_name,
ppds_new_registration.ppds_institute_address,
ppds_new_registration.ppds_province_id,
ppds_new_registration.ppds_district_id,
ppds_new_registration.ppds_pd_approval,
ppds_staff_information.st_info_institute_id,
ppds_staff_information.st_info_slmc_reg_no,
ppds_staff_information.st_info_is_gov_officer,
ppds_staff_information.st_info_gov_ins_name,
ppds_staff_information.st_info_hours_of_practice,
ppds_institute_information.ins_info_record_keeping_id,
ppds_institute_information.ins_info_visiting_speciality_availability,
ppds_institute_information.ins_info_dental_lab_facility,
ppds_institute_information.ins_info_x_ray_facility,
ppds_institute_information.ins_info_emargancy_kit_availability,
ppds_institute_information.ins_info_other_facility,
ppds_institute_information.ins_info_owner,
ppds_institute_information.ins_info_practice_type,
ppds_institute_information.ins_info_speciality,
ppds_institute_information.ins_info_disposal_method,
ppds_institute_information.ins_info_instruments_dressings,
ppds_payment_detail.payment_detail_institute_id,
ppds_payment_detail.payment_detail_id,
ppds_payment_detail.payment_amount,
ppds_payment_detail.payment_date,
ppds_payment_detail.payment_branch,
ppds_payment_detail.payment_type,
ppds_payment_detail.payment_silp_name,
ppds_staff_information.st_info_prac_type_privet_dental,
tbl_district.dis_id,
tbl_district.dis_name,
tbl_province.pro_name,
tbl_record_keep.record_type,
tbl_record_keep.record_keep_id,
tbl_owner.ownership
FROM
ppds_new_registration
Left Join ppds_staff_information ON ppds_new_registration.ppds_application_id = ppds_staff_information.st_info_institute_id
Left Join ppds_institute_information ON ppds_new_registration.ppds_application_id = ppds_institute_information.ins_info_institute_id
Left Join ppds_payment_detail ON ppds_new_registration.ppds_application_id = ppds_payment_detail.payment_detail_institute_id
Inner Join tbl_district ON ppds_new_registration.ppds_district_id = tbl_district.dis_id
left Join tbl_province ON ppds_new_registration.ppds_province_id = tbl_province.pro_id
left Join tbl_record_keep ON ppds_institute_information.ins_info_record_keeping_id = tbl_record_keep.record_keep_id
left Join tbl_owner ON ppds_institute_information.ins_info_owner = tbl_owner.ownership_id
where ppds_new_registration.ppds_application_id=$id
";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		$response['aId']=$row['ppds_application_id'];
		$response['ownerName']=$row['ppds_owner_name'];
		$response['relationsip']=$row['ppds_owner_relationship'];
		$response['owAddress']=$row['ppds_owner_address'];
		$response['insName']=$row['ppds_institute_name'];
		$response['insAddress']=$row['ppds_institute_address'];
		$response['province']= $row['pro_name'];
		$response['district']= $row['dis_name'];
		$response['approvalStatus']=$row['ppds_pd_approval'];
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





