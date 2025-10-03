
<?php

session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

require_once $backwardSeparator.'dataAccess/connector.php';

use presentation\hrm\masterData\classes\cls_hrm_employee_information;

$model = new cls_hrm_employee_information($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $sql="SELECT
payment_amount,
payment_date,
payment_branch,
payment_type
FROM
fpdm_payment_detail
          order by payment_detail_institute_id asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$response['payAmount']  =$row['payment_amount'];
		$response['paymentDate']=$row['payment_date'];
		$response['paymentBranch']  =$row['payment_branch'];
		$response['paymentType']    =$row['payment_type'];
		}

  echo json_encode($response);
  
}
elseif($requestType=='loadSearchCombo'){
  $sql="SELECT
fpdm_new_registration.fpdm_application_id,
fpdm_new_registration.fpdm_owner_name,
fpdm_new_registration.fpdm_owner_relationship,
fpdm_new_registration.fpdm_owner_address,
fpdm_new_registration.fpdm_institute_name,
fpdm_new_registration.fpdm_institute_address,
fpdm_new_registration.fpdm_province_id,
fpdm_new_registration.fpdm_district_id,
fpdm_new_registration.fpdm_is_deleted
FROM
fpdm_new_registration
          order by fpdm_application_id asc";
		  $html = "<option vlaue=\"\"></option>";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$html .= "<option value=\"".$row['fpdm_application_id']."\">".$row['fpdm_institute_name']."</option>";
		
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
//    echo "janaka";
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





