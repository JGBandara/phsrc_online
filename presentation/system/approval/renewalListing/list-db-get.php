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

if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
 $sql="SELECT 
    institute_registration.ins_application_id,   
    institute_registration.ins_type_id,   
    institute_registration.reg_no,   
    DATE(institute_payment_detail.payment_detail_created_on) AS payment_date,   
    institute_payment_detail.payment_type, 
	institute_payment_detail.reject_remark,  
    institute_payment_detail.payment_reg_fee,   
    CASE 
        WHEN institute_payment_detail.payment_is_approval IN (1) THEN 'Approved'
        WHEN institute_payment_detail.payment_is_approval IN (2, 12, 9) THEN 'Rejected'
        WHEN institute_payment_detail.payment_is_approval IN (10) THEN 'Checked'
		WHEN institute_payment_detail.payment_is_approval IN (11) THEN 'Recommended'
		WHEN institute_payment_detail.payment_is_approval IN (0) THEN 'Pending'
        ELSE 'Unknown'
    END AS payment_is_approval,   
    institute_registration.ins_institute_name,   
    man_institute_main.cat_name,   
    man_institute_main.main_cat_id   
FROM 
    institute_registration   
INNER JOIN 
    institute_payment_detail 
    ON institute_registration.ins_application_id = institute_payment_detail.payment_detail_institute_id   
INNER JOIN 
    man_institute_main 
    ON institute_registration.ins_type_id = man_institute_main.main_cat_id 
Inner Join 
	sys_user_location 
	ON institute_registration.ins_province_id = sys_user_location.syo_location_id
Inner Join 
	sys_users 
	ON sys_user_location.syo_user_id = sys_users.syu_id
where sys_users.syu_id='$userId' and sys_user_location.syo_is_deleted='0'
ORDER BY 
    institute_payment_detail.payment_date DESC;";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
			
		$response['id'][]=$row['ins_application_id'];
		$response['regNo'][]=$row['reg_no'];
		$response['ownerName'][]=$row['ins_institute_name'];
		$response['crDate'][]=$row['payment_date'];
		$response['paymentType'][]=$row['payment_type'];
		$response['regAmount'][]=$row['payment_reg_fee'];
		$response['cat_name'][]=$row['cat_name'];
		$response['remark'][]=$row['reject_remark'];
		$response['approveStatus'][]=$row['payment_is_approval'];
		
		}
  echo json_encode($response);
  
}else if($requestType=='loadInstituteDetail'){
	 $id = $_REQUEST['id'];
    $sql="SELECT
   institute_registration.ins_application_id,
   institute_registration.ins_owner_name,
   institute_registration.ins_owner_relationship,
   institute_registration.ins_owner_offic_address,
   institute_registration.ins_owner_address,
   institute_registration.ins_institute_name,
   institute_registration.ins_institute_address,
   institute_registration.ins_telephone,
   institute_registration.ins_mobile,
   institute_registration.ins_email,
   institute_registration.ins_website,
   sys_district.syd_name AS dis_name,
   sys_province.syv_name AS pro_name,
   institute_payment_detail.payment_detail_institute_id,
   institute_payment_detail.payment_is_approval
   FROM
   institute_registration
   Inner Join sys_province ON institute_registration.ins_province_id = sys_province.syv_id
   Inner Join sys_district ON institute_registration.ins_district_id = sys_district.syd_id
   Inner Join institute_payment_detail ON institute_registration.ins_application_id = institute_payment_detail.payment_detail_institute_id
where institute_registration.ins_application_id='$id'
";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		$response['aId']=$row['ins_application_id'];
		$response['ownerName']=$row['ins_owner_name'];
		$response['relationsip']=$row['ins_owner_relationship'];
		$response['owAddress']=$row['ins_owner_address'];
		$response['insName']=$row['ins_institute_name'];
		$response['insAddress']=$row['ins_institute_address'];
        $response['ins_telephone']= $row['ins_telephone'];
		$response['ins_mobile']= $row['ins_mobile'];
        $response['ins_email']= $row['ins_email'];
		$response['ins_website']= $row['ins_website'];
		$response['province']= $row['pro_name'];
		$response['district']= $row['dis_name'];
		$response['approvalStatus']=$row['payment_is_approval'];
        $response['approval']	=$row['payment_is_approval'];
		}
                $sqlStfIn="SELECT
institute_staff_information.st_info_institute_id,
institute_staff_information.st_info_hours_of_practice,
institute_staff_information.st_info_is_gov_officer,
institute_staff_information.st_info_gov_ins_name
FROM
institute_staff_information
where
institute_staff_information.st_info_institute_id=$id";
                $resultStfIn=$db->singleQuery($sqlStfIn);
                while($row=  mysqli_fetch_array($resultStfIn)){
                    $response['st_info_hours_of_practice']=$row['st_info_hours_of_practice'];
                    $response['st_info_is_gov_officer']=$row['st_info_is_gov_officer'];
                    $response['st_info_gov_ins_name']=$row['st_info_gov_ins_name'];
                }
                
                
                
                $sqlsft = "SELECT
institute_staff_information_stf_detail.institute_id,
institute_staff_information_stf_detail.Name,
institute_staff_information_stf_detail.Qulification,
institute_staff_information_stf_detail.institute,
institute_staff_information_stf_detail.country,
institute_staff_information_stf_detail.post_gradu,
institute_staff_information_stf_detail.speciality,
institute_staff_information_stf_detail.Register_id
FROM
institute_staff_information_stf_detail
where institute_staff_information_stf_detail.institute_id='$id'
				";
		$resultsft = $db->singleQuery($sqlsft);
		$arrDetail1;
		while($row=mysqli_fetch_array($resultsft))
		{
			$val1['Name'] 		= $row['Name'];
			$val1['Qulification'] 	= $row['Qulification'];
			$val1['institute'] 	= $row['institute'];
			$val1['country'] 	= $row['country'];
			$val1['post_gradu'] 	= $row['post_gradu'];
			$val1['speciality'] 	= $row['speciality'];
			$val1['Register_id'] 	= $row['Register_id'];
			
			$arrDetail1[] = $val1;
		}
		$response['detailVal1'] = $arrDetail1;
                
                //-----------------------------------------------------------------------------
			$sqlMgt = "SELECT
institute_staff_information_managment_detail.institute_id,
institute_staff_information_managment_detail.position_id,
institute_staff_information_managment_detail.name,
institute_staff_information_managment_detail.contact_detail,
institute_staff_information_managment_detail.info,
tbl_position.position_name
FROM
institute_staff_information_managment_detail
Inner Join tbl_position ON institute_staff_information_managment_detail.position_id = tbl_position.position_id
where institute_staff_information_managment_detail.institute_id='$id'
				";
		$resultMgt = $db->singleQuery($sqlMgt);
		$arrDetail2;
		while($row=mysqli_fetch_array($resultMgt))
		{
			$val2['position']= $row['position_name'];
			$val2['name'] 	= $row['name'];
			$val2['contact'] = $row['contact_detail'];
			$val2['info']	= $row['info'];
			
			$arrDetail2[] = $val2;
		}
		$response['detailVal2'] = $arrDetail2;
                
                $sqlins="SELECT
				institute_information.ins_info_institute_id,
				institute_information.ins_date_of_stablishment,
				institute_information.ins_br_no,
				institute_registration.ins_profile,
				tbl_owner.ownership,
				institute_information.ins_type,
				institute_information.ins_boi_registration,
				institute_registration.reg_no
				FROM
				institute_information
				left Join tbl_owner ON institute_information.ins_ownership = tbl_owner.ownership_id
				inner Join institute_registration ON institute_information.ins_info_institute_id = institute_registration.ins_application_id 
				where institute_information.ins_info_institute_id='$id'
";
	$resultins=$db->singleQuery($sqlins);
	while($row=mysqli_fetch_array($resultins)){
		$response['stDate']=$row['ins_date_of_stablishment'];
		$response['brNo']=$row['ins_br_no'];
		$response['boiReg']=$row['ins_boi_registration'];
		$response['ins_type']=$row['ins_type'];
		$response['ownership']=$row['ownership'];
		$response['ins_profile']	=$row['ins_profile'];
		$response['reg_no']	=$row['reg_no'];
		}
    $sqlfaci= "select ins_faci_institute_id,ins_no_of_bed,ins_no_of_room,ins_no_of_ward,ins_radio_service,ins_no_of_license,ins_waste_disposal,ins_inst_dress,ins_emergency_kit from institute_facility where ins_faci_institute_id= '$id'";
  
  $resultfaci=$db->singleQuery($sqlfaci);
  while($row=mysqli_fetch_array($resultfaci)){
	  $response['noBed'] = $row['ins_no_of_bed'];
	  $response['noRoom'] = $row['ins_no_of_room'];
	  $response['noWard'] = $row['ins_no_of_ward'];
	  $response['radioSer'] = $row['ins_radio_service'];
	  $response['noLicense'] = $row['ins_no_of_license'];
	  $response['disposal'] = $row['ins_waste_disposal'];
	  $response['instDress'] = $row['ins_inst_dress'];
	  $response['emgKit'] = $row['ins_emergency_kit'];
	  
	  }  
          $sqlfdet = "SELECT
institute_facility_detail.facility_id,
institute_facility_detail.facility_detail_value,
institute_facility_detail.facility_description,
tbl_facility.facility_name
FROM
institute_facility_detail
Inner Join tbl_facility ON institute_facility_detail.facility_id = tbl_facility.facility_id
				where institute_facility_detail.facility_detail_institute_id='$id' order by institute_facility_detail.facility_detail_id
				";
		$resultfdet = $db->singleQuery($sqlfdet);
		$arrDetail3;
		while($row=mysqli_fetch_array($resultfdet))
		{
			$val3['facility']		= $row['facility_name'];
			$val3['value'] 	= $row['facility_detail_value'];
			$val3['description']	= $row['facility_description'];
			
			$arrDetail3[] = $val3;
		}
		$response['detailVal3'] = $arrDetail3;
                //------------------------------------------------------------------------------------
              $sql = "select dfi_id, dfi_file_name, dfi_file_extension, dfi_store_location, dfi_url, dfi_reference_no, dfi_reference_id, 
		dfg_name, dfc_name, dfi_file_version, dfi_meta_data, dfi_remarks, ifnull(stat_name,'') as `status`, 
		if(dfi_is_deleted='1','Yes','No') as `is deleted`, ifnull(dfp_id,0) as `permission`
        from dms_trn_file
          inner join dms_file_category on dfi_file_category_id=dfc_id
          inner join dms_file_group on dfc_file_group_id=dfg_id
          left join sys_status on dfi_status=stat_id
          left join dms_file_permission on dfp_file_category_id=dfi_file_category_id  and dfp_status='1' and dfp_is_deleted='0'
        where 1=1 and dfi_company_id='$userCompanyId' and dfi_reference_id='$id'  and dfi_is_deleted='0'
        order by dfc_name asc, dfi_file_name asc, dfi_file_version asc ";
  $result = $db->singleQuery($sql);
  $arr = [];
  while($row = mysqli_fetch_assoc($result)){
    $arr[] = $row;
  }
                
                $sqlpay="SELECT
pd.payment_reg_year,
pd.payment_amount,
pd.payment_date,
pd.payment_branch,
pd.payment_type,
pd.payment_silp_name,
pd.payment_reg_fee,
pd.payment_stamp_fee,
pd.payment_arrears,
pd.reject_remark,
r.receipt_payment_order_id,
r.receipt_path
FROM
institute_payment_detail pd LEFT JOIN receipts r ON pd.payment_detail_institute_id = r.receipt_institute_id AND pd.payment_reg_year = r.receipt_payment_reg_year
where pd.payment_detail_institute_id='$id'
          order by pd.payment_detail_institute_id asc";
	$resultpay=$db->singleQuery($sqlpay);
	while($row=mysqli_fetch_array($resultpay)){
		$response['regYear']  =$row['payment_reg_year'];
		$response['payAmount']  =$row['payment_amount'];
		$response['paymentDate']=$row['payment_date'];
		$response['paymentBranch']  =$row['payment_branch'];
		$response['paymentType']    =$row['payment_type'];
		$response['payImageName']	=$row['payment_silp_name'];
        $response['payment_reg_fee']  =$row['payment_reg_fee'];
		$response['payment_stamp_fee']    =$row['payment_stamp_fee'];
		$response['payment_arrears']	=$row['payment_arrears'];
		$response['reject_remark']	=$row['reject_remark'];
		$response['receipt_path']	=$row['receipt_path'];
		}
                
  echo json_encode($response);
	}
        
if($requestType=='loadDocDetails'){
  $id = $_REQUEST['id'];
  $sql = "select dfi_id, dfi_file_name, dfi_file_extension, dfi_store_location, dfi_url, dfi_reference_no, dfi_reference_id,
 dfg_name, dfc_name, dfi_file_version, dfi_meta_data, dfi_remarks, ifnull(stat_name,'') as `status`, 
		if(dfi_is_deleted='1','Yes','No') as `is deleted`
from dms_trn_file
          inner join dms_file_category on dfi_file_category_id=dfc_id
          inner join dms_file_group on dfc_file_group_id=dfg_id
          left join sys_status on dfi_status=stat_id
 where 1=1 and dfi_company_id='$userCompanyId' and dfi_reference_id='$id'  and dfi_is_deleted='0'
        order by dfc_name asc, dfi_file_name asc, dfi_file_version asc";
  $result = $db->singleQuery($sql);
  $arr = [];
  while($row = mysqli_fetch_assoc($result)){
    $arr[] = $row;
  }
  echo json_encode($arr);
}

?>





