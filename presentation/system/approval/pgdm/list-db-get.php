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
pgdm_new_registration.pgdm_application_id,
pgdm_new_registration.pgdm_owner_name,
pgdm_new_registration.pgdm_pd_approval
FROM
pgdm_new_registration
          order by pgdm_application_id asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$response['id'][]=$row['pgdm_application_id'];
		$response['ownerName'][]=$row['pgdm_owner_name'];
		$response['approveStatus'][]=$row['pgdm_pd_approval'];
		
		}

  echo json_encode($response);
  
}else if($requestType=='loadInstituteDetail'){
	 $id = $_REQUEST['id'];
  $sql="SELECT
pgdm_new_registration.pgdm_application_id,
pgdm_new_registration.pgdm_owner_name,
pgdm_new_registration.pgdm_owner_relationship,
pgdm_new_registration.pgdm_owner_address,
pgdm_new_registration.pgdm_institute_name,
pgdm_new_registration.pgdm_institute_address,
pgdm_new_registration.pgdm_province_id,
pgdm_new_registration.pgdm_district_id,
pgdm_new_registration.pgdm_pd_approval,
pgdm_staff_information.st_info_institute_id,
pgdm_staff_information.st_info_slmc_reg_no,
pgdm_staff_information.st_info_is_gov_officer,
pgdm_staff_information.st_info_gov_ins_name,
pgdm_staff_information.st_info_hours_of_practice,
pgdm_institute_information.ins_info_record_keeping_id,
pgdm_institute_information.ins_info_visiting_speciality_availability,
pgdm_institute_information.ins_info_dental_lab_facility,
pgdm_institute_information.ins_info_x_ray_facility,
pgdm_institute_information.ins_info_emargancy_kit_availability,
pgdm_institute_information.ins_info_other_facility,
pgdm_institute_information.ins_info_owner,
pgdm_institute_information.ins_info_practice_type,
pgdm_institute_information.ins_info_speciality,
pgdm_institute_information.ins_info_disposal_method,
pgdm_institute_information.ins_info_instruments_dressings,
pgdm_payment_detail.payment_detail_institute_id,
pgdm_payment_detail.payment_detail_id,
pgdm_payment_detail.payment_amount,
pgdm_payment_detail.payment_date,
pgdm_payment_detail.payment_branch,
pgdm_payment_detail.payment_type,
pgdm_staff_information.st_info_prac_type_privet_dental,
tbl_district.dis_id,
tbl_district.dis_name,
tbl_province.pro_name,
tbl_record_keep.record_type,
tbl_record_keep.record_keep_id,
tbl_owner.ownership
FROM
pgdm_new_registration
Left Join pgdm_staff_information ON pgdm_new_registration.pgdm_application_id = pgdm_staff_information.st_info_institute_id
Left Join pgdm_institute_information ON pgdm_new_registration.pgdm_application_id = pgdm_institute_information.ins_info_institute_id
Left Join pgdm_payment_detail ON pgdm_new_registration.pgdm_application_id = pgdm_payment_detail.payment_detail_institute_id
Inner Join tbl_district ON pgdm_new_registration.pgdm_district_id = tbl_district.dis_id
left Join tbl_province ON pgdm_new_registration.pgdm_province_id = tbl_province.pro_id
left Join tbl_record_keep ON pgdm_institute_information.ins_info_record_keeping_id = tbl_record_keep.record_keep_id
left Join tbl_owner ON pgdm_institute_information.ins_info_owner = tbl_owner.ownership_id
where pgdm_new_registration.pgdm_application_id=$id
";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		$response['aId']=$row['pgdm_application_id'];
		$response['ownerName']=$row['pgdm_owner_name'];
		$response['relationsip']=$row['pgdm_owner_relationship'];
		$response['owAddress']=$row['pgdm_owner_address'];
		$response['insName']=$row['pgdm_institute_name'];
		$response['insAddress']=$row['pgdm_institute_address'];
		$response['province']= $row['pro_name'];
		$response['district']= $row['dis_name'];
		$response['approvalStatus']=$row['pgdm_pd_approval'];
		}

  echo json_encode($response);
	
	
	
	
	}

?>





