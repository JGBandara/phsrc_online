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
    institute_payment_detail.payment_reg_year,
    DATE(institute_payment_detail.payment_detail_created_on) AS payment_date,   
    institute_payment_detail.payment_type, 
	institute_payment_detail.reject_remark,
    institute_payment_detail.payment_reg_fee,   
    CASE 
        WHEN institute_payment_detail.payment_is_approval IN (1) THEN 'Approved'
        WHEN institute_payment_detail.payment_is_approval IN (2, 12, 9, 30, 31) THEN 'Rejected'
        WHEN institute_payment_detail.payment_is_approval IN (10) THEN 'Checked'
		WHEN institute_payment_detail.payment_is_approval IN (11) THEN 'Recommended'
		WHEN institute_payment_detail.payment_is_approval IN (0) THEN 'Pending'
		WHEN institute_payment_detail.payment_is_approval IN (18) THEN 'Approved by PHSRC Officer'
		WHEN institute_payment_detail.payment_is_approval IN (19) THEN 'Approved by Manager'
		WHEN institute_payment_detail.payment_is_approval IN (20) THEN 'Approved by Secretary'
		WHEN institute_payment_detail.payment_is_approval IN (21) THEN 'Approved by First Committee Member'
		WHEN institute_payment_detail.payment_is_approval IN (22) THEN 'Approved by Second Committee Member'
		WHEN institute_payment_detail.payment_is_approval IN (23) THEN 'Approved by Third Committee Member'
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
		$response['cat_name'][]=$row['cat_name'];
		$response['regNo'][]=$row['reg_no'];
		$response['ownerName'][]=$row['ins_institute_name'];
		$response['year'][]=$row['payment_reg_year'];
		$response['approveStatus'][]=$row['payment_is_approval'];
		
		}
  echo json_encode($response);
  
}else if($requestType=='loadInstituteDetail'){
	 $id = $_REQUEST['id'];
 $sql="SELECT
   institute_registration.ins_application_id,
   institute_payment_detail.payment_detail_institute_id,
   institute_payment_detail.payment_is_approval,
   institute_registration.reg_no,   
   institute_registration.ins_institute_name,  
   date(institute_payment_detail.payment_detail_created_on) AS payment_detail_created_on,
   date(institute_payment_detail.payment_checked_date) AS payment_checked_date,
   date(institute_payment_detail.payment_approved_date) AS payment_approved_date,
   date(institute_payment_detail.payment_manager_approved_date) AS payment_manager_approved_date,
   date(institute_payment_detail.payment_date) AS payment_date,
   date(institute_payment_detail.payment_secretary_approval_date) AS payment_secretary_approval_date
   FROM
   institute_registration
   Inner Join institute_payment_detail ON institute_registration.ins_application_id = institute_payment_detail.payment_detail_institute_id
where institute_registration.ins_application_id='$id'
";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		$response['aId']=$row['ins_application_id'];
		$response['recomendDate']=$row['payment_approved_date'];
		$response['checkedDate']=$row['payment_checked_date'];
		$response['managerApprovedDate']=$row['payment_manager_approved_date'];
		$response['paymentDate']=$row['payment_date'];
		$response['appSubmitDate']=$row['payment_detail_created_on'];
		$response['approvalStatus']=$row['payment_is_approval'];
        $response['approval']	=$row['payment_is_approval'];
		$response['secretaryApprovalDate']=$row['payment_secretary_approval_date'];
        $response['regNo']=$row['reg_no'];
        $response['insName']=$row['ins_institute_name'];
		}

        $sqlfdet = "
SELECT *
FROM (
    SELECT 
        'First Committee Member' AS member,
        ipd.payment_com_first_approval_by AS approved_by,
        u1.syu_full_name AS name,
        ipd.payment_com_first_approval_date AS date,
        CASE 
            WHEN ipd.payment_is_approval = 21 THEN 'Approved'
            WHEN ipd.payment_is_approval IN (2,12,9,30,31) THEN 'Rejected'
            ELSE 'Pending'
        END AS status,
        1 AS sort_order
    FROM institute_payment_detail ipd
    LEFT JOIN sys_users u1 
        ON u1.syu_id = ipd.payment_com_first_approval_by
    WHERE ipd.payment_detail_institute_id = '$id'


    UNION ALL

    SELECT 
        'Second Committee Member',
        ipd.payment_com_second_approval_by,
        u2.syu_full_name,
        ipd.payment_com_second_approval_date,
        CASE 
            WHEN ipd.payment_is_approval = 22 THEN 'Approved'
            WHEN ipd.payment_is_approval IN (2,12,9,30,31) THEN 'Rejected'
            ELSE 'Pending'
        END,
        2
    FROM institute_payment_detail ipd
    LEFT JOIN sys_users u2 
        ON u2.syu_id = ipd.payment_com_second_approval_by
    WHERE ipd.payment_detail_institute_id = '$id'

    UNION ALL

    SELECT 
        'Third Committee Member',
        ipd.payment_com_third_approval_by,
        u3.syu_full_name,
        ipd.payment_com_third_approval_date,
        CASE 
            WHEN ipd.payment_is_approval = 23 THEN 'Approved'
            WHEN ipd.payment_is_approval IN (2,12,9,30,31) THEN 'Rejected'
            ELSE 'Pending'
        END,
        3
    FROM institute_payment_detail ipd
    LEFT JOIN sys_users u3 
        ON u3.syu_id = ipd.payment_com_third_approval_by
    WHERE ipd.payment_detail_institute_id = '$id'
) AS committee
ORDER BY sort_order
LIMIT 0, 1000";

		$resultfdet = $db->singleQuery($sqlfdet);
		$arrDetail3;
		while($row=mysqli_fetch_array($resultfdet))
		{
			$val3['member']		= $row['member'];
			$val3['name'] 	= $row['name'];
			$val3['date']	= $row['date'];
            $val3['status']	= $row['status'];
			$arrDetail3[] = $val3;
		}
		$response['detailVal3'] = $arrDetail3;

          echo json_encode($response);
	}

?>





