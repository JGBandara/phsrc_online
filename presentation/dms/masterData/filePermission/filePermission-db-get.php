
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-12
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

use presentation\dms\masterData\classes\cls_dms_file_permission;
use presentation\system\masterData\classes\cls_sys_users;

$model = new cls_dms_file_permission($db);
$modelUser = new cls_sys_users($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $sql = "select dfp_file_category_id
              from dms_file_permission 
              where dfp_company_id='$userCompanyId' and dfp_location_id='$userLocationId' and dfp_is_deleted='0' and dfp_status='1' and dfp_user_id='$id'";
  $result = $db->singleQuery($sql);
  $arr = [];
  while($row = mysqli_fetch_array($result)){
    $arr[] = $row['dfp_file_category_id'];
  }
  $response['ids']=$arr;
  echo json_encode($response);
  
}
elseif($requestType=='loadSearchCombo'){
  $modelUser->syu_status = 1;
  $modelUser->syu_is_deleted = 0;
  $modelUser->syu_company_id = $userCompanyId;
  echo $modelUser->combo(true);
}
elseif($requestType=='loadPartial'){
  try{
    $recordId = $_REQUEST['record_id'];
    $model->dfp_id = $recordId;
    $model->dfp_company_id = $userCompanyId;
    $model = $model->findModel();
    ob_start();
//    echo "janaka";
    include "./filePermissionPartialView.php";
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





