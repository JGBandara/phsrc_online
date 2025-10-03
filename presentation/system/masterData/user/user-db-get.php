
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-08
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

use presentation\system\masterData\classes\cls_sys_users;

$model = new cls_sys_users($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $model->syu_id=$id;
  $response = $model->getRecords();
  echo json_encode($response);
  
}
elseif($requestType=='loadSearchCombo'){
  $model->syu_is_deleted = 0;
  $model->syu_company_id = $userCompanyId;
  echo $model->combo(true);
}
elseif($requestType=='loadPartial'){
  try{
    $recordId = $_REQUEST['record_id'];
    $model->syu_id = $recordId;
    $model->syu_company_id = $userCompanyId;
    $model = $model->findModel();
    ob_start();
//    echo "janaka";
    include "./userPartialView.php";
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
elseif($requestType=='randomPassword'){
  $id = $_REQUEST['id'];
  $model->syu_id = $id;
  $model->syu_company_id = $userCompanyId;
  $model = $model->findModel();
  $response['name'] = $model->syu_full_name;
  $data1 = '123456789';
  $data2 = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
  $data3 = 'abcefghjkmnpqrstuvwxyz';
  $data4 = '@#$';
  $response['password'] = str_shuffle(substr(str_shuffle($data1), 0, 2).substr(str_shuffle($data2), 0, 2).substr(str_shuffle($data3), 0, 2).substr(str_shuffle($data4), 0, 2));
  echo json_encode($response);
}
?>





