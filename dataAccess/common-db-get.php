<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-06
 */
//session_start();
//$mainPath = $_SESSION['MAIN_PATH'];
session_start();
$backwardSeparator = "../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

require_once $backwardSeparator.'dataAccess/connector.php';

//use presentation\system\masterData\classes\cls_sys_location;
//
//$model = new cls_sys_location($db);
  
$requestType 	= $_REQUEST['requestType'];
$response = [];
// =======================================================
//         Get Ajax Retrive URL
// =======================================================
if($requestType=='getAjaxGetUrl'){
  $menuId = $_REQUEST['menu_id'];
  $sql = "select sym_url from sys_menus where sym_id='$menuId'";
  $result = $db->singleQuery($sql);
  $response['url'] = '';
  if($row = mysqli_fetch_array($result)){
    $url = $row['sym_url'];
    $response['url'] = explode('.', $url)[0]."-db-get.php";
  }
  echo json_encode($response);
}
elseif($requestType=='getPrintUrl'){
  $menuId = $_REQUEST['menu_id'];
  $sql = "select sym_url from sys_menus where sym_id='$menuId'";
  $result = $db->singleQuery($sql);
  $response['url'] = '';
  if($row = mysqli_fetch_array($result)){
    $url = $row['sym_url'];
    $response['url'] = explode('.', $url)[0]."Print.php";
  }
  echo json_encode($response);
}
elseif($requestType=='getPageUrl'){
  $menuId = $_REQUEST['menu_id'];
  $sql = "select sym_url from sys_menus where sym_id='$menuId'";
  $result = $db->singleQuery($sql);
  $response['url'] = '';
  if($row = mysqli_fetch_array($result)){
    $url = $row['sym_url'];
    $response['url'] = $url;
  }
  echo json_encode($response);
}
//elseif($requestType=='getDownloadUrl'){
//  $fileId = $_REQUEST['file_id'];
//  $sql = "select dfi_url 
//          from dms_trn_file 
//              inner join dms_file_permission on dfp_file_category_id=dfi_file_category_id
//          where dfi_id='$fileId' and dfp_user_id='$userId' and dfi_company_id='$userCompanyId' and dfp_status='1' and dfp_is_deleted='0'";
//  $result = $db->singleQuery($sql);
//  $response['url'] = '';
//  if($row = mysqli_fetch_array($result)){
//    $url = $row['dfi_url'];
//    $response['url'] = $url;
//  }
//  else{
//    header('HTTP/1.1 500 Internal Server Error');
//    header('Content-type: text/plain');
//    exit("You don't have to permissions to access this file.");
//  }
//  echo json_encode($response);
//}
?>





