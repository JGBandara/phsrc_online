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

include  "{$backwardSeparator}dataAccess/serverAccessController.php";

//require_once '../class/cls_sys_permission.php';
//require_once $backwardSeparator.'dataAccess/connector.php';
//require_once $backwardSeparator.'class/cls_auto_number.php';
//require_once $backwardSeparator.'class/cls_approval.php';
//use presentation\system\masterData\classes\cls_sys_permission;

//$model = new cls_sys_permission($db);

$response = [];

$requestType 	= $_REQUEST['requestType'];
//$anStatus       = $_REQUEST['anStatus'];
//$id             = $_REQUEST['cboSearch'];
//$details = json_decode($_REQUEST['detailList'], true);

// =======================================================
//         Update
// =======================================================
if($requestType=='applyRole'){
  $grantUserId = $_REQUEST['grant_user_id'];
  $roleId = $_REQUEST['role_id'];
  try{
    $db->begin();  
    if(!$intEditx){
      throw new exception('Permission is Denied ...');
    }
    // Get Column names
    $sql = "show columns from sys_menus";
    $result = $db->batchQuery($sql);
    $columns = [];
    while($row = mysqli_fetch_assoc($result)){
      $columns[] = $row;
    }
    $columnsName = [];
    for ($index = 8; $index < count($columns)-4; $index++) {
      $columnNames = explode('_',$columns[$index]['Field']);
      $name = "";
      foreach ($columnNames as $key => $value) {
        $name .= ($key==0)?'': '_'.$value;
      }
      $columnsName[] = $name;
    }
    // Get Role Permissions
    // -----------------------------
    $sql = "select * from sys_role_permission where syn_role_id='$roleId'";
    $resultPer = $db->batchQuery($sql);
    $finalResult = true;
    while($rowPer = mysqli_fetch_array($resultPer)){
      $menuId = $rowPer['syn_menu_id'];
      $sql = "select * from sys_permission where syp_user_id='$grantUserId' and syp_menu_id='$menuId' and syp_location_id='$userLocationId' and syp_company_id='$userCompanyId'";
      $result = $db->batchQuery($sql);
      if($row = mysqli_fetch_array($result)){
        $sql = "update `sys_permission`
                set";
        foreach($columnsName as $field){
          $sql .= " syp".$field."=syp".$field." or ".$rowPer['syn'.$field].",";
        }
        $sql = substr($sql,0,-1);
        $sql.= " where syp_menu_id='$menuId' and syp_user_id='$grantUserId' and syp_location_id='$userLocationId' and syp_company_id='$userCompanyId'";
      }
      else{
        $values = "";
        $sql = "insert into sys_permission (syp_user_id, syp_menu_id, syp_location_id, syp_company_id";
        foreach($columnsName as $field){
          $sql .= ", syp".$field;
          $values .= ", '".$rowPer['syn'.$field]."'";
        }
        $sql .= ") values ('".$grantUserId."', '".$menuId."'".", '".$userLocationId."'".", '".$userCompanyId."'".$values.")";     
      }
      $finalResult = $finalResult && $db->batchQuery($sql);
    }
    
    // ============================   Approval Entry    ================
//    $clsApprove = new cls_approval($db, $userCompanyId, $userLocationId, $userId);
//    $clsApprove->newApprovalEntry($autoNoType, $entryId, $noReference, true);
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $response['no'] 	= $noReference; 
        $response['id'] 	= $entryId;
        $db->commit();
        // commit auto number
//        $clsAutoNo->setAutoNoCommit($autoNoType, $autoNo);
    }
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
        $db->rollback();//roalback
        // rollback auto number
//        $clsAutoNo->setAutoNoRollback($autoNoType, $autoNo);
    }
            
  }catch(Exception $e){

    $db->rollback();//roalback
    // rollback auto number
//    $clsAutoNo->setAutoNoRollback($autoNoType, $autoNo);

    $response['type'] 		= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 			= $sql;                
  }
  
} // End If - Update
echo json_encode($response);    
?>





