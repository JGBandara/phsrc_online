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
          order by ins_application_id asc";
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
institute_registration.ins_website,
sys_province.syv_name,
sys_district.syd_name,
institute_registration.ins_province_id,
institute_registration.ins_district_id,
institute_registration.ins_status,
institute_information.ins_date_of_stablishment,
institute_information.ins_br_no,
institute_information.ins_boi_registration,
institute_information.ins_is_pvt_hospital,
institute_information.ins_is_nursing_home,
institute_information.ins_is_mat_home,
institute_information.ins_is_medical_center,
institute_information.ins_is_screen_center,
institute_information.ins_is_day_care,
institute_information.ins_is_channel_consultation,
institute_information.ins_is_automated,
institute_information.ins_is_semi_automated,
institute_information.ins_is_mobile_lab,
institute_information.ins_is_collecting_center,
institute_information.ins_is_group,
institute_information.ins_is_individual,
institute_information.ins_is_fulltime,
institute_information.ins_other,
institute_information.ins_is_pub_company,
institute_information.ins_is_pvt_company,
institute_information.ins_is_pro_pvt_hospital,
institute_information.ins_is_co_hospital,
institute_information.ins_is_std_hospital,
institute_information.ins_is_com_base,
institute_information.ins_is_manual,
institute_information.ins_is_pvt_hs_ns_home,
institute_information.ins_is_pvt_dental,
institute_information.ins_own_other,
institute_information.ins_practice_hr,
institute_information.ins_company_type,
institute_facility.ins_faci_id,
institute_facility.ins_no_of_bed,
institute_facility.ins_no_of_room,
institute_facility.ins_no_of_ward,
institute_facility.ins_radio_service,
institute_facility.ins_no_of_license,
institute_facility.ins_waste_disposal,
institute_facility.ins_inst_dress,
institute_facility.ins_emergency_kit,
institute_facility.ins_no_of_ambulance,
institute_facility.ins_am_modal,
institute_facility.ins_health_staff,
institute_facility.ins_rmv_reg,
institute_staff_information.st_info_id,
institute_staff_information.st_info_prac_type_group,
institute_staff_information.st_info_prac_type_induvidual,
institute_staff_information.st_info_prac_type_other,
institute_staff_information.st_info_slmc_reg_no,
institute_staff_information.st_info_hours_of_practice,
institute_staff_information.st_info_is_gov_officer,
institute_staff_information.st_info_gov_ins_name,
institute_staff_information.st_info_status,
institute_payment_detail.payment_reg_year,
institute_payment_detail.payment_reg_fee,
institute_payment_detail.payment_stamp_fee,
institute_payment_detail.payment_amount,
institute_payment_detail.payment_date,
institute_payment_detail.payment_branch,
institute_payment_detail.payment_silp_name,
institute_payment_detail.payment_type,
institute_payment_detail.payment_reg_type_id,
institute_payment_detail.payment_is_approval
FROM
institute_registration
left Join institute_staff_information ON institute_registration.ins_application_id = institute_staff_information.st_info_institute_id
left Join institute_information ON institute_registration.ins_application_id = institute_information.ins_info_institute_id
left Join institute_facility ON institute_registration.ins_application_id = institute_facility.ins_faci_institute_id
left Join institute_payment_detail ON institute_registration.ins_application_id = institute_payment_detail.payment_detail_institute_id
left Join sys_province ON institute_registration.ins_province_id = sys_province.syv_id
left Join sys_district ON institute_registration.ins_district_id = sys_district.syd_id
where institute_registration.ins_application_id=$id
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
		$response['approvalStatus']=1;
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
		$response['approval']	=$row['payment_is_approval'];
		//------------------------------------------------------------------------------------------------
		}
  echo json_encode($response);
	}

?>





