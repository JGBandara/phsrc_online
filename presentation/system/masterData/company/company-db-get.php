
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-07
 */
//session_start();
//$mainPath = $_SESSION['MAIN_PATH'];
session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

require_once $backwardSeparator.'dataAccess/connector.php';

use presentation\system\masterData\classes\cls_sys_companies;

$model = new cls_sys_companies($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $model->syc_id=$id;
  $response = $model->getRecords();
  echo json_encode($response);
  
}
elseif($requestType=='loadSearchCombo'){
  $model->syc_is_deleted = 0;
  echo $model->combo(true);
}
elseif($requestType=='loadPartial'){
  try{
    $recordId = $_REQUEST['record_id'];
    $model->syc_id = $recordId;
    $model = $model->findModel();
    ob_start();
//    echo "janaka";
    include "./companyPartialView.php";
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





