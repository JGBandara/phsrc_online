
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-05-31
 */
//session_start();
//$mainPath = $_SESSION['MAIN_PATH'];
session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require_once '../class/cls_sys_menus.php';
require_once $backwardSeparator.'dataAccess/connector.php';

$model = new cls_sys_menus($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $model->sym_id=$id;
  $response = $model->getRecords();
  echo json_encode($response);
  
}
elseif($requestType=='loadSearchCombo'){
  $model->sym_is_deleted = 0;
  $model->sym_company_id = $userCompanyId;
  echo $model->combo(true);
}
?>





