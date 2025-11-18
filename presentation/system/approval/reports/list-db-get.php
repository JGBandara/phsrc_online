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
 
 $sql="SELECT 
    institute_registration.ins_application_id,   
    institute_registration.ins_type_id,   
    institute_registration.reg_no,   
    institute_payment_detail.payment_date,   
    institute_payment_detail.payment_type,   
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
where sys_users.syu_id='$userId' and institute_payment_detail.payment_is_approval='1' and sys_user_location.syo_is_deleted='0'
ORDER BY 
    institute_payment_detail.payment_date DESC;";
		//  where institute_registration.ins_province_id=$userLocationId
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
			
		$response['id'][]=$row['ins_application_id'];
		$response['ownerName'][]=$row['ins_institute_name'];
		$response['crDate'][]=$row['payment_date'];
		$response['paymentType'][]=$row['payment_type'];
		$response['regAmount'][]=$row['payment_reg_fee'];
		$response['cat_name'][]=$row['cat_name'];
		$response['approveStatus'][]=$row['payment_is_approval'];
		
		}
  echo json_encode($response);
  
}
?>





