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

include  "{$backwardSeparator}dataAccess/serverAccessController.php";

//require_once '../class/cls_sys_permission.php';
//require_once $backwardSeparator.'dataAccess/connector.php';
//require_once $backwardSeparator.'class/cls_auto_number.php';
//require_once $backwardSeparator.'class/cls_approval.php';

//$model = new cls_sys_permission($db);

$response = [];

$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//$details = json_decode($_REQUEST['detailList'], true);

// =======================================================
//         Update
// =======================================================
if($requestType=='menuPermission'){
  $menuId = $_REQUEST['menu_id'];
  $roleId = $_REQUEST['role_id'];
  $status = $_REQUEST['status'];
  $fields = $_REQUEST['fields'];
  try{
    $db->begin();  
    if(!$intEditx){
      throw new exception('Permission is Denied ...');
    }
    $sql = "select * from sys_role_permission where syn_role_id='$roleId' and syn_menu_id='$menuId'";
    $result = $db->batchQuery($sql);
    if($row = mysqli_fetch_array($result)){
      //Update data to transaction header*******************************************
      $sql = "update `sys_role_permission`
            set";
      foreach($fields as $field){
        $sql .= " ".$field."='".$status."',";
      }
      $sql = substr($sql,0,-1);
      $sql.= " where syn_menu_id='$menuId' and syn_role_id='$roleId'";
    }
    else{
      $values = "";
      $sql = "insert into sys_role_permission (syn_role_id, syn_menu_id";
      foreach($fields as $field){
        $sql .= ", ".$field;
        $values .= ", '".$status."'";
      }
      $sql .= ") values ('".$roleId."', '".$menuId."'".$values.")";
    }

    $finalResult = $db->batchQuery($sql);
    
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
// =======================================================
//         Delete
// =======================================================
elseif($requestType=='delete'){
  $roleId = $_REQUEST['role_id'];
  try{
    $db->begin();      
    if(!$intDeletex){
      throw new exception('Permission is Denied ...');
    }
    
    $sql = "delete from `sys_role_permission`
          where syn_role_id='$roleId'";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;           
    
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Deleted successfully.';
        $response['id'] 	= $entryId;
        $db->commit();
    }
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
        $db->rollback();//roalback
    }
            
  }catch(Exception $e){

    $db->rollback();//roalback

    $response['type'] 	= 'fail';
    $response['msg'] 	= $e->getMessage();
    $response['q'] 		= $sql;                
  }
  
} // End If - Delete

echo json_encode($response);    
?>





