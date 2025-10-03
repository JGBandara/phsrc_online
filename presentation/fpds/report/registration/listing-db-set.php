<?php
session_start();
ob_start();
$backwardSeparator = "../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

require_once $backwardSeparator.'dataAccess/connector.php';
	
	/////////// parameters /////////////////////////////
	$requestType 	= $_REQUEST['requestType'];
	$id 			= $_REQUEST['id'];
	$comment		= $_REQUEST['comment'];
	$txtEfDate		= $_REQUEST['txtEfDate'];
	date_default_timezone_set("Asia/Colombo");
	$approv_date = date('Y-m-d H:i:s');
	$id=$_REQUEST['id'];
	/////////// approval /////////////////////
	if($requestType=='attendanceProceed')
	{	
		$year=$_REQUEST['id'];
		
		
		 $sql="SELECT
hrm_employee_information.emi_id,
hrm_employee_information.emi_is_deleted
FROM
hrm_employee_information
where hrm_employee_information.emi_is_deleted='0'";

$result=$db->singleQuery($sql);
while($row=mysqli_fetch_array($result)){
	 $empId=$row['emi_id'];
	
	 $sqlType="SELECT
hrm_mst_leave_type.ltp_id,
hrm_mst_leave_type.ltp_default_count,
hrm_mst_leave_type.ltp_is_deleted
FROM
hrm_mst_leave_type
where hrm_mst_leave_type.ltp_is_deleted='0'";

$resultType=$db->singleQuery($sqlType);
while($rowType=mysqli_fetch_array($resultType)){
	
	$lvTypeId=$rowType['ltp_id'];
	 $lvCount=$rowType['ltp_default_count'];
	
	
	 $sqlfinal="INSERT INTO prl_trn_leave_balance (leave_year,salary_bal_emp_id,salary_bal_leave_type,salary_bal_count,ltp_created_by,ltp_created_on) VALUES('$year','$empId','$lvTypeId','$lvCount','$userId',now())";
	$resultfinal=$db->singleQuery($sqlfinal);
	}
	
	
	}
		
		
	}

	echo json_encode($response);


?>