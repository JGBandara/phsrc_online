
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-23
 */
//session_start();
//$mainPath = $_SESSION['MAIN_PATH'];
session_start();
$backwardSeparator = "../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

require_once $backwardSeparator.'dataAccess/connector.php';

use presentation\hrm\classes\cls_hrm_trn_other_qualification;

$model = new cls_hrm_trn_other_qualification($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $model->eoq_id=$id;
  $response = $model->getRecords();
  echo json_encode($response);
  
}
elseif($requestType=='loadSearchCombo'){
  $model->eoq_is_deleted = 0;
  $model->eoq_company_id = $userCompanyId;
  echo $model->combo(true);
}
elseif($requestType=='loadPartial'){
  try{
    $recordId = $_REQUEST['record_id'];
    $model->eoq_id = $recordId;
    $model->eoq_company_id = $userCompanyId;
    $model = $model->findModel();
    ob_start();
//    echo "janaka";
    include "./otherQualificationPartialView.php";
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





