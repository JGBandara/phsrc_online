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
fpdm_new_registration.fpdm_application_id,
fpdm_new_registration.fpdm_owner_name,
fpdm_new_registration.fpdm_pd_approval,
fpdm_new_registration.fpdm_last_modified_on,
fpdm_payment_detail.payment_detail_institute_id,
fpdm_payment_detail.payment_type
FROM
fpdm_new_registration
Inner Join fpdm_payment_detail ON fpdm_new_registration.fpdm_application_id = fpdm_payment_detail.payment_detail_institute_id
          order by fpdm_application_id asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		
		
		$response['id'][]=$row['fpdm_application_id'];
		$response['ownerName'][]=$row['fpdm_owner_name'];
		$response['crDate'][]=$row['fpdm_last_modified_on'];
		$response['paymentType'][]=$row['payment_type'];
		$response['approveStatus'][]=$row['fpdm_pd_approval'];
		
		}

  echo json_encode($response);
  
}else if($requestType=='loadInstituteDetail'){
	 $id = $_REQUEST['id'];
  $sql="SELECT
fpdm_new_registration.fpdm_application_id,
fpdm_new_registration.fpdm_owner_name,
fpdm_new_registration.fpdm_owner_relationship,
fpdm_new_registration.fpdm_owner_address,
fpdm_new_registration.fpdm_institute_name,
fpdm_new_registration.fpdm_institute_address,
fpdm_new_registration.fpdm_province_id,
fpdm_new_registration.fpdm_district_id,
fpdm_new_registration.fpdm_pd_approval,
fpdm_staff_information.st_info_institute_id,
fpdm_staff_information.st_info_hours_of_practice,
fpdm_institute_information.ins_info_record_keeping_id,
fpdm_institute_information.ins_info_visiting_speciality_availability,
fpdm_institute_information.ins_info_dental_lab_facility,
fpdm_institute_information.ins_info_x_ray_facility,
fpdm_institute_information.ins_info_emargancy_kit_availability,
fpdm_institute_information.ins_info_other_facility,
fpdm_institute_information.ins_info_owner,
fpdm_institute_information.ins_info_practice_type,
fpdm_institute_information.ins_info_speciality,
fpdm_institute_information.ins_info_disposal_method,
fpdm_institute_information.ins_info_instruments_dressings,
fpdm_payment_detail.payment_detail_institute_id,
fpdm_payment_detail.payment_detail_id,
fpdm_payment_detail.payment_amount,
fpdm_payment_detail.payment_date,
fpdm_payment_detail.payment_branch,
fpdm_payment_detail.payment_type,
fpdm_payment_detail.payment_silp_name,
tbl_district.dis_id,
tbl_district.dis_name,
tbl_province.pro_name,
tbl_record_keep.record_type,
tbl_record_keep.record_keep_id,
tbl_owner.ownership
FROM
fpdm_new_registration
Left Join fpdm_staff_information ON fpdm_new_registration.fpdm_application_id = fpdm_staff_information.st_info_institute_id
Left Join fpdm_institute_information ON fpdm_new_registration.fpdm_application_id = fpdm_institute_information.ins_info_institute_id
Left Join fpdm_payment_detail ON fpdm_new_registration.fpdm_application_id = fpdm_payment_detail.payment_detail_institute_id
Inner Join tbl_district ON fpdm_new_registration.fpdm_district_id = tbl_district.dis_id
left Join tbl_province ON fpdm_new_registration.fpdm_province_id = tbl_province.pro_id
left Join tbl_record_keep ON fpdm_institute_information.ins_info_record_keeping_id = tbl_record_keep.record_keep_id
left Join tbl_owner ON fpdm_institute_information.ins_info_owner = tbl_owner.ownership_id
where fpdm_new_registration.fpdm_application_id=$id
";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		$response['aId']=$row['fpdm_application_id'];
		$response['ownerName']=$row['fpdm_owner_name'];
		$response['relationsip']=$row['fpdm_owner_relationship'];
		$response['owAddress']=$row['fpdm_owner_address'];
		$response['insName']=$row['fpdm_institute_name'];
		$response['insAddress']=$row['fpdm_institute_address'];
		$response['province']= $row['pro_name'];
		$response['district']= $row['dis_name'];
		$response['approvalStatus']=$row['fpdm_pd_approval'];
		//------------------------------------------------------------------------------------------------
		$response['slmc']=$row['st_info_slmc_reg_no'];
		//$response['is_gov_officer']=$row['st_info_is_gov_officer'];
		//$response['gov_is_name']=$row['st_info_gov_ins_name'];
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





