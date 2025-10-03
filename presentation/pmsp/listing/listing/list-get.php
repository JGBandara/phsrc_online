<?php
	session_start();
	$backwardSeparator = "../../../../";
	$mainPath 	= $_SESSION['mainPath'];
	$userId 	= $_SESSION['userId'];
	$requestType 	= $_REQUEST['requestType'];
	/*$id = $_REQUEST['id'];*/
require_once $backwardSeparator.'dataAccess/connector.php';
	
	
	/////////// load part /////////////////////
	
		
		
if($requestType=='loadDetails'){
	
	$id=$_REQUEST['id'];
	
	$sql="SELECT
pay_recept_print.recipt_id,
pay_recept_print.reg_no,
pay_recept_print.reg_year,
pay_recept_print.reg_date,
pay_recept_print.recipt_no,
pay_recept_print.our_ref,
pay_recept_print.pay_type,
pay_recept_print.cheque_no,
pay_recept_print.amount,
reg_ins_comm.reg_no,
reg_ins_comm.institute_id,
pay_recept_print.reg_id,
reg_ins_comm.address,
man_institute_main.cat_name
FROM
pay_recept_print
Inner Join reg_ins_comm ON pay_recept_print.reg_id = reg_ins_comm.institute_id
Inner Join man_institute_main ON reg_ins_comm.mainCat_id = man_institute_main.main_cat_id
	WHERE pay_recept_print.recipt_id='$id'";
	$result=$db->RunQuery($sql);
	
	while($row=mysql_fetch_array($result)){
		$response['reg_no']=$row['reg_no'];
	 $response['reg_year']=$row['reg_year'];
	 $response['reg_no']=$row['reg_no'];
	 $response['reg_date']=$row['reg_date'];
	 $response['recipt_no']=$row['recipt_no'];
	  $response['our_ref']=$row['our_ref'];
	  $response['pay_type']=$row['pay_type'];
	 $response['cheque_no']=$row['cheque_no'];
	 $response['amount']=$row['amount'];
	 $response['address']=$row['address'];
	  $response['cat_name']=$row['cat_name'];
		
		}
		echo json_encode($response);
	
	}		

?>