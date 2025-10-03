
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

use presentation\system\masterData\classes\cls_sys_permission;

require_once $backwardSeparator.'dataAccess/connector.php';

$model = new cls_sys_permission($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Permission Grid
// =======================================================
if($requestType=='loadPermissionGrid'){
  $assignUserId = $_REQUEST['userId'];
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
      $name .= ($key==0)?'syp': '_'.$value;
    }
    $menuColumnsName[] = $columns[$index]['Field'];
    $columnsName[] = $name;
  }
  // Get Menu List
  echo json_encode(menuList(0, $menuColumnsName, $columnsName));
  
}
// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $model->syp_menu_id = $id;
  $model->syp_location_id = $userLocationId;
  $model->syp_company_id = $userCompanyId;
  $response = $model->getRecords();
  echo json_encode($response);
  
}
elseif($requestType=='loadSearchCombo'){
  $model->syp_is_deleted = 0;
  $model->syp_company_id = $userCompanyId;
  echo $model->combo(true);
}

function menuList($parentId, $menuColumnsName, $columnsName){
  global $db;
  global $assignUserId;
  global $module;
  global $userCompanyId;
  global $userLocationId;
 
  // Get First Level Menu Items
  $sql = "select *
          from sys_menus 
          where sym_status='1' and sym_module='$module' and sym_parent_id='$parentId'
          order by sym_module asc, sym_behaviour asc, sym_name asc ";
  $result0 = $db->singleQuery($sql);
  $menuList = [];
  while($row0 = mysqli_fetch_array($result0)){
    $menu = [];
    $menuId = $row0['sym_id'];
    $parentId = $row0['sym_parent_id'];
    $behaviour = $row0['sym_behaviour'];
    $menuLabel = $row0['sym_name'];
    $moduleName = $row0['sym_module'];
    $menu['id'] = $menuId;
    $menu['label'] = $menuLabel;
    $menu['parent'] = $parentId;
    $menu['beha'] = $behaviour;
    $menu['module'] = $moduleName;
    // Get Menu actions
    $actions = [];
    foreach ($menuColumnsName as $k=>$menuField) {
      $actions[$columnsName[$k]] = $row0[$menuField];
    }
    $menu['actions'] = $actions;
    // Get Menu Permissions
    $sql = "select *
          from sys_permission 
          where syp_menu_id='$menuId' and syp_user_id='$assignUserId' and syp_company_id='$userCompanyId' and syp_location_id='$userLocationId'";
    $resultPermission0 = $db->singleQuery($sql);
    $permissions = [];
    if($rowPer0= mysqli_fetch_array($resultPermission0)){
      foreach ($columnsName as $k=>$columnName) {
        $permissions[$columnName] = $rowPer0[$columnName];
      }
    }
    else{
      foreach ($columnsName as $k=>$columnName) {
        $permissions[$columnName] = 0;
      }
    }
    $menu['permission'] = $permissions;
    // Check Has Child
    $sql = "select *
            from sys_menus
            where sym_parent_id='$menuId'";
    $resultChild = $db->singleQuery($sql);
    if(mysqli_num_rows($resultChild)>0){
      $menu['sub_menu'] = menuList($menuId, $menuColumnsName, $columnsName);
    }
    else{
      $menu['sub_menu'] = [];
    }
    // get Sub menus 
    $menuList[] = $menu;
  }
  return $menuList;
}
?>





