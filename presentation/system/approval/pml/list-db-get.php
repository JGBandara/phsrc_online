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
pml_new_registration.pml_application_id,
pml_new_registration.pml_owner_name,
pml_new_registration.pml_pd_approval
FROM
pml_new_registration
          order by pml_application_id asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$response['id'][]=$row['pml_application_id'];
		$response['ownerName'][]=$row['pml_owner_name'];
		$response['approveStatus'][]=$row['pml_pd_approval'];
		
		}

  echo json_encode($response);
  
}else if($requestType=='loadInstituteDetail'){
	 $id = $_REQUEST['id'];
  $sql="SELECT
pml_new_registration.pml_application_id,
pml_new_registration.pml_owner_name,
pml_new_registration.pml_owner_relationship,
pml_new_registration.pml_owner_address,
pml_new_registration.pml_institute_name,
pml_new_registration.pml_institute_address,
pml_new_registration.pml_province_id,
pml_new_registration.pml_district_id,
pml_new_registration.pml_pd_approval,
pml_staff_information.st_info_institute_id,
pml_staff_information.st_info_slmc_reg_no,
pml_staff_information.st_info_is_gov_officer,
pml_staff_information.st_info_gov_ins_name,
pml_staff_information.st_info_hours_of_practice,
pml_institute_information.ins_info_record_keeping_id,
pml_institute_information.ins_info_visiting_speciality_availability,
pml_institute_information.ins_info_dental_lab_facility,
pml_institute_information.ins_info_x_ray_facility,
pml_institute_information.ins_info_emargancy_kit_availability,
pml_institute_information.ins_info_other_facility,
pml_institute_information.ins_info_owner,
pml_institute_information.ins_info_practice_type,
pml_institute_information.ins_info_speciality,
pml_institute_information.ins_info_disposal_method,
pml_institute_information.ins_info_instruments_dressings,
pml_payment_detail.payment_detail_institute_id,
pml_payment_detail.payment_detail_id,
pml_payment_detail.payment_amount,
pml_payment_detail.payment_date,
pml_payment_detail.payment_branch,
pml_payment_detail.payment_type,
pml_staff_information.st_info_prac_type_privet_dental,
tbl_district.dis_id,
tbl_district.dis_name,
tbl_province.pro_name,
tbl_record_keep.record_type,
tbl_record_keep.record_keep_id,
tbl_owner.ownership
FROM
pml_new_registration
Left Join pml_staff_information ON pml_new_registration.pml_application_id = pml_staff_information.st_info_institute_id
Left Join pml_institute_information ON pml_new_registration.pml_application_id = pml_institute_information.ins_info_institute_id
Left Join pml_payment_detail ON pml_new_registration.pml_application_id = pml_payment_detail.payment_detail_institute_id
Inner Join tbl_district ON pml_new_registration.pml_district_id = tbl_district.dis_id
left Join tbl_province ON pml_new_registration.pml_province_id = tbl_province.pro_id
left Join tbl_record_keep ON pml_institute_information.ins_info_record_keeping_id = tbl_record_keep.record_keep_id
left Join tbl_owner ON pml_institute_information.ins_info_owner = tbl_owner.ownership_id
where pml_new_registration.pml_application_id=$id
";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		$response['aId']=$row['pml_application_id'];
		$response['ownerName']=$row['pml_owner_name'];
		$response['relationsip']=$row['pml_owner_relationship'];
		$response['owAddress']=$row['pml_owner_address'];
		$response['insName']=$row['pml_institute_name'];
		$response['insAddress']=$row['pml_institute_address'];
		$response['province']= $row['pro_name'];
		$response['district']= $row['dis_name'];
		$response['approvalStatus']=$row['pml_pd_approval'];
		}

  echo json_encode($response);
	
	
	
	
	}

?>





