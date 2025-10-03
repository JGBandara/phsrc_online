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
phnh_new_registration.phnh_application_id,
phnh_new_registration.phnh_owner_name,
phnh_new_registration.phnh_pd_approval
FROM
phnh_new_registration
          order by phnh_application_id asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$response['id'][]=$row['phnh_application_id'];
		$response['ownerName'][]=$row['phnh_owner_name'];
		$response['approveStatus'][]=$row['phnh_pd_approval'];
		
		}

  echo json_encode($response);
  
}else if($requestType=='loadInstituteDetail'){
	 $id = $_REQUEST['id'];
  $sql="SELECT
phnh_new_registration.phnh_application_id,
phnh_new_registration.phnh_owner_name,
phnh_new_registration.phnh_owner_relationship,
phnh_new_registration.phnh_owner_address,
phnh_new_registration.phnh_institute_name,
phnh_new_registration.phnh_institute_address,
phnh_new_registration.phnh_province_id,
phnh_new_registration.phnh_district_id,
phnh_new_registration.phnh_pd_approval,
phnh_staff_information.st_info_institute_id,
phnh_staff_information.st_info_slmc_reg_no,
phnh_staff_information.st_info_is_gov_officer,
phnh_staff_information.st_info_gov_ins_name,
phnh_staff_information.st_info_hours_of_practice,
phnh_institute_information.ins_info_record_keeping_id,
phnh_institute_information.ins_info_visiting_speciality_availability,
phnh_institute_information.ins_info_dental_lab_facility,
phnh_institute_information.ins_info_x_ray_facility,
phnh_institute_information.ins_info_emargancy_kit_availability,
phnh_institute_information.ins_info_other_facility,
phnh_institute_information.ins_info_owner,
phnh_institute_information.ins_info_practice_type,
phnh_institute_information.ins_info_speciality,
phnh_institute_information.ins_info_disposal_method,
phnh_institute_information.ins_info_instruments_dressings,
phnh_payment_detail.payment_detail_institute_id,
phnh_payment_detail.payment_detail_id,
phnh_payment_detail.payment_amount,
phnh_payment_detail.payment_date,
phnh_payment_detail.payment_branch,
phnh_payment_detail.payment_type,
phnh_staff_information.st_info_prac_type_privet_dental,
tbl_district.dis_id,
tbl_district.dis_name,
tbl_province.pro_name,
tbl_record_keep.record_type,
tbl_record_keep.record_keep_id,
tbl_owner.ownership
FROM
phnh_new_registration
Left Join phnh_staff_information ON phnh_new_registration.phnh_application_id = phnh_staff_information.st_info_institute_id
Left Join phnh_institute_information ON phnh_new_registration.phnh_application_id = phnh_institute_information.ins_info_institute_id
Left Join phnh_payment_detail ON phnh_new_registration.phnh_application_id = phnh_payment_detail.payment_detail_institute_id
Inner Join tbl_district ON phnh_new_registration.phnh_district_id = tbl_district.dis_id
left Join tbl_province ON phnh_new_registration.phnh_province_id = tbl_province.pro_id
left Join tbl_record_keep ON phnh_institute_information.ins_info_record_keeping_id = tbl_record_keep.record_keep_id
left Join tbl_owner ON phnh_institute_information.ins_info_owner = tbl_owner.ownership_id
where phnh_new_registration.phnh_application_id=$id
";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		$response['aId']=$row['phnh_application_id'];
		$response['ownerName']=$row['phnh_owner_name'];
		$response['relationsip']=$row['phnh_owner_relationship'];
		$response['owAddress']=$row['phnh_owner_address'];
		$response['insName']=$row['phnh_institute_name'];
		$response['insAddress']=$row['phnh_institute_address'];
		$response['province']= $row['pro_name'];
		$response['district']= $row['dis_name'];
		$response['approvalStatus']=$row['phnh_pd_approval'];
		}

  echo json_encode($response);
	
	
	
	
	}

?>





