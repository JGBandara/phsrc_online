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
pmsp_new_registration.pmsp_application_id,
pmsp_new_registration.pmsp_owner_name,
pmsp_new_registration.pmsp_pd_approval
FROM
pmsp_new_registration
          order by pmsp_application_id asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$response['id'][]=$row['pmsp_application_id'];
		$response['ownerName'][]=$row['pmsp_owner_name'];
		$response['approveStatus'][]=$row['pmsp_pd_approval'];
		
		}

  echo json_encode($response);
  
}else if($requestType=='loadInstituteDetail'){
	 $id = $_REQUEST['id'];
  $sql="SELECT
pmsp_new_registration.pmsp_application_id,
pmsp_new_registration.pmsp_owner_name,
pmsp_new_registration.pmsp_owner_relationship,
pmsp_new_registration.pmsp_owner_address,
pmsp_new_registration.pmsp_institute_name,
pmsp_new_registration.pmsp_institute_address,
pmsp_new_registration.pmsp_province_id,
pmsp_new_registration.pmsp_district_id,
pmsp_new_registration.pmsp_pd_approval,
pmsp_staff_information.st_info_institute_id,
pmsp_staff_information.st_info_slmc_reg_no,
pmsp_staff_information.st_info_is_gov_officer,
pmsp_staff_information.st_info_gov_ins_name,
pmsp_staff_information.st_info_hours_of_practice,
pmsp_institute_information.ins_info_record_keeping_id,
pmsp_institute_information.ins_info_visiting_speciality_availability,
pmsp_institute_information.ins_info_dental_lab_facility,
pmsp_institute_information.ins_info_x_ray_facility,
pmsp_institute_information.ins_info_emargancy_kit_availability,
pmsp_institute_information.ins_info_other_facility,
pmsp_institute_information.ins_info_owner,
pmsp_institute_information.ins_info_practice_type,
pmsp_institute_information.ins_info_speciality,
pmsp_institute_information.ins_info_disposal_method,
pmsp_institute_information.ins_info_instruments_dressings,
pmsp_payment_detail.payment_detail_institute_id,
pmsp_payment_detail.payment_detail_id,
pmsp_payment_detail.payment_amount,
pmsp_payment_detail.payment_date,
pmsp_payment_detail.payment_branch,
pmsp_payment_detail.payment_type,
pmsp_staff_information.st_info_prac_type_privet_dental,
tbl_district.dis_id,
tbl_district.dis_name,
tbl_province.pro_name,
tbl_record_keep.record_type,
tbl_record_keep.record_keep_id,
tbl_owner.ownership
FROM
pmsp_new_registration
Left Join pmsp_staff_information ON pmsp_new_registration.pmsp_application_id = pmsp_staff_information.st_info_institute_id
Left Join pmsp_institute_information ON pmsp_new_registration.pmsp_application_id = pmsp_institute_information.ins_info_institute_id
Left Join pmsp_payment_detail ON pmsp_new_registration.pmsp_application_id = pmsp_payment_detail.payment_detail_institute_id
Inner Join tbl_district ON pmsp_new_registration.pmsp_district_id = tbl_district.dis_id
left Join tbl_province ON pmsp_new_registration.pmsp_province_id = tbl_province.pro_id
left Join tbl_record_keep ON pmsp_institute_information.ins_info_record_keeping_id = tbl_record_keep.record_keep_id
left Join tbl_owner ON pmsp_institute_information.ins_info_owner = tbl_owner.ownership_id
where pmsp_new_registration.pmsp_application_id=$id
";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		$response['aId']=$row['pmsp_application_id'];
		$response['ownerName']=$row['pmsp_owner_name'];
		$response['relationsip']=$row['pmsp_owner_relationship'];
		$response['owAddress']=$row['pmsp_owner_address'];
		$response['insName']=$row['pmsp_institute_name'];
		$response['insAddress']=$row['pmsp_institute_address'];
		$response['province']= $row['pro_name'];
		$response['district']= $row['dis_name'];
		$response['approvalStatus']=$row['pmsp_pd_approval'];
		}

  echo json_encode($response);
	
	
	
	
	}

?>





