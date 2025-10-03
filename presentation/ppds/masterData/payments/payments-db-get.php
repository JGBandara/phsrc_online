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

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
 $sql="SELECT
payment_reg_year, 
payment_reg_fee,
payment_stamp_fee,
payment_amount,
payment_arrears,
payment_date,
payment_branch,
payment_type,
payment_silp_name,
paymet_is_success
FROM
institute_payment_detail
where payment_detail_institute_id=$id
          order by payment_detail_institute_id asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		$response['regYear']  =$row['payment_reg_year'];
		$response['payregFee']  =$row['payment_reg_fee'];
                $response['paystFee']  =$row['payment_stamp_fee'];
                $response['payarreas']  =$row['payment_arrears'];
                $response['payAmount']  =$row['payment_amount'];
		$response['paymentDate']=$row['payment_date'];
		$response['paymentBranch']  =$row['payment_branch'];
		$response['paymentType']    =$row['payment_type'];
		$response['payImageName']	=$row['payment_silp_name'];
                $response['paymentSuccess']	=$row['paymet_is_success'];
		}
                
   
               $response['totAmount']='7500';
               $response['payarreas']  ='10000';
           
  
  echo json_encode($response);
  
}
elseif($requestType=='loadSearchCombo'){
 $sql="SELECT
ins_application_id,
ins_institute_name
FROM
institute_registration where ins_is_deleted='0' and ins_type_id='8' and ins_created_by=$userId and approval_status!=1
          order by ins_application_id asc";
		  $html = "<option vlaue=\"\"></option>";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$html .= "<option value=\"".$row['ins_application_id']."\">".$row['ins_institute_name']."</option>";
		
		}
	echo $html;		  		  
}
elseif($requestType=='loadPartial'){
  try{
    $recordId = $_REQUEST['record_id'];
    $model->emi_id = $recordId;
    $model->emi_company_id = $userCompanyId;
    $model = $model->findModel();
    ob_start();
    include "./employeeInformationPartialView.php";
    $value = ob_get_clean();
    $response['content'] 	= $value;
    $response['type'] 	= 'pass';
    $response['msg'] 	= 'Saved successfully.';
    
  }catch(Exception $e){
    $response['type'] 	= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 		= $sql;                
  }
  echo json_encode($response);
}
?>





