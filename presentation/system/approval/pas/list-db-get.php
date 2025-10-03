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
pas_new_registration.pas_application_id,
pas_new_registration.pas_owner_name,
pas_new_registration.pas_pd_approval
FROM
pas_new_registration
          order by pas_application_id asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$response['id'][]=$row['pas_application_id'];
		$response['ownerName'][]=$row['pas_owner_name'];
		$response['approveStatus'][]=$row['pas_pd_approval'];
		
		}

  echo json_encode($response);
  
}else if($requestType=='loadInstituteDetail'){
	 $id = $_REQUEST['id'];
  $sql="SELECT
pas_new_registration.pas_application_id,
pas_new_registration.pas_owner_name,
pas_new_registration.pas_owner_relationship,
pas_new_registration.pas_owner_address,
pas_new_registration.pas_institute_name,
pas_new_registration.pas_institute_address,
pas_new_registration.pas_province_id,
pas_new_registration.pas_district_id,
pas_new_registration.pas_pd_approval,
pas_staff_information.st_info_institute_id,
pas_staff_information.st_info_slmc_reg_no,
pas_staff_information.st_info_is_gov_officer,
pas_staff_information.st_info_gov_ins_name,
pas_staff_information.st_info_hours_of_practice,
pas_institute_information.ins_info_record_keeping_id,
pas_institute_information.ins_info_visiting_speciality_availability,
pas_institute_information.ins_info_dental_lab_facility,
pas_institute_information.ins_info_x_ray_facility,
pas_institute_information.ins_info_emargancy_kit_availability,
pas_institute_information.ins_info_other_facility,
pas_institute_information.ins_info_owner,
pas_institute_information.ins_info_practice_type,
pas_institute_information.ins_info_speciality,
pas_institute_information.ins_info_disposal_method,
pas_institute_information.ins_info_instruments_dressings,
pas_payment_detail.payment_detail_institute_id,
pas_payment_detail.payment_detail_id,
pas_payment_detail.payment_amount,
pas_payment_detail.payment_date,
pas_payment_detail.payment_branch,
pas_payment_detail.payment_type,
pas_staff_information.st_info_prac_type_privet_dental,
tbl_district.dis_id,
tbl_district.dis_name,
tbl_province.pro_name,
tbl_record_keep.record_type,
tbl_record_keep.record_keep_id,
tbl_owner.ownership
FROM
pas_new_registration
Left Join pas_staff_information ON pas_new_registration.pas_application_id = pas_staff_information.st_info_institute_id
Left Join pas_institute_information ON pas_new_registration.pas_application_id = pas_institute_information.ins_info_institute_id
Left Join pas_payment_detail ON pas_new_registration.pas_application_id = pas_payment_detail.payment_detail_institute_id
Inner Join tbl_district ON pas_new_registration.pas_district_id = tbl_district.dis_id
left Join tbl_province ON pas_new_registration.pas_province_id = tbl_province.pro_id
left Join tbl_record_keep ON pas_institute_information.ins_info_record_keeping_id = tbl_record_keep.record_keep_id
left Join tbl_owner ON pas_institute_information.ins_info_owner = tbl_owner.ownership_id
where pas_new_registration.pas_application_id=$id
";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		$response['aId']=$row['pas_application_id'];
		$response['ownerName']=$row['pas_owner_name'];
		$response['relationsip']=$row['pas_owner_relationship'];
		$response['owAddress']=$row['pas_owner_address'];
		$response['insName']=$row['pas_institute_name'];
		$response['insAddress']=$row['pas_institute_address'];
		$response['province']= $row['pro_name'];
		$response['district']= $row['dis_name'];
		$response['approvalStatus']=$row['pas_pd_approval'];
		}

  echo json_encode($response);
	
	
	
	
	}

?>





