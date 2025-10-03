
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

require "{$backwardSeparator}autoLoad.php";

require_once $backwardSeparator.'dataAccess/connector.php';

//use presentation\system\masterData\classes\cls_sys_permission;

//$model = new cls_sys_permission($db);
  
$requestType 	= $_REQUEST['requestType'];
$response = [];

// =======================================================
//         Load Permission Grid
// =======================================================
if($requestType=='loadPermissionGrid'){
  $roleId = $_REQUEST['roleId'];
  $module = $_REQUEST['module'];
  // Get Permission Column Count
  $sql = "show columns from sys_menus";
  $result = $db->singleQuery($sql);
  $columns = [];
  while($row = mysqli_fetch_assoc($result)){
    $columns[] = $row;
  }
  $columnsName = [];
  $menuColumnsName = [];
  for ($index = 8; $index < count($columns)-4; $index++) {
    $columnNames = explode('_',$columns[$index]['Field']);
    $name = "";
    foreach ($columnNames as $key => $value) {
      $name .= ($key==0)?'syn': '_'.$value;
    }
    $menuColumnsName[] = $columns[$index]['Field'];
    $columnsName[] = $name;
  }
  // Get Menu List
  echo json_encode(menuList(0, $menuColumnsName, $columnsName));
  
}
// =======================================================
//         Load Permission Grid
// =======================================================
elseif($requestType=='loadRoleDetails'){
  $roleId = $_REQUEST['roleId'];
  $sql = "select syr_remarks from sys_roles where syr_id='$roleId'";
  $result = $db->singleQuery($sql);
  if($row = mysqli_fetch_array($result)){
    $response['details'] = $row['syr_remarks'];
  }
  else{
    $response['details'] = "";
  }
  echo json_encode($response);
  
}
// =======================================================
//         Load Details
// =======================================================
//if($requestType=='loadDetails'){
//  $id = $_REQUEST['id'];
//  $model->syp_menu_id=$id;
//  $response = $model->getRecords();
//  echo json_encode($response);
//  
//}
//elseif($requestType=='loadSearchCombo'){
//  $model->syp_is_deleted = 0;
//  $model->syp_company_id = $userCompanyId;
//  echo $model->combo(true);
//}

?>





