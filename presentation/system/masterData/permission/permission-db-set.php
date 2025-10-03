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

use presentation\system\masterData\classes\cls_sys_permission;
//require_once $backwardSeparator.'dataAccess/connector.php';
//require_once $backwardSeparator.'class/cls_auto_number.php';
//require_once $backwardSeparator.'class/cls_approval.php';

$model = new cls_sys_permission($db);

$response = [];
$autoNoType = "permission";   

$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//$details = json_decode($_REQUEST['detailList'], true);

// =======================================================
//         Update
// =======================================================
if($requestType=='menuPermission'){
  $menuId = $_REQUEST['menu_id'];
  $grantUserId = $_REQUEST['grant_user_id'];
  $status = $_REQUEST['status'];
  $fields = $_REQUEST['fields'];
  try{
    $db->begin();  
    if(!$intEditx){
      throw new exception('Permission is Denied ...');
    }
    $sql = "select * from sys_permission where syp_user_id='$grantUserId' and syp_menu_id='$menuId' and syp_location_id='$userLocationId' and syp_company_id='$userCompanyId'";
    $result = $db->batchQuery($sql);
    if($row = mysqli_fetch_array($result)){
      //Update data to transaction header*******************************************
      $sql = "update `sys_permission`
            set";
      foreach($fields as $field){
        $sql .= " ".$field."='".$status."',";
      }
      $sql = substr($sql,0,-1);
      $sql.= " where syp_menu_id='$menuId' and syp_user_id='$grantUserId' and syp_location_id='$userLocationId' and syp_company_id='$userCompanyId'";
    }
    else{
      $valus = "";
      $sql = "insert into sys_permission (syp_user_id, syp_menu_id, syp_location_id, syp_company_id";
      foreach($fields as $field){
        $sql .= ", ".$field;
        $values .= ", '".$status."'";
      }
      $sql .= ") values ('".$grantUserId."', '".$menuId."'".", '".$userLocationId."'".", '".$userCompanyId."'".$values.")";
    }
//echo $sql;
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
  $grantUserId = $_REQUEST['grant_user_id'];
  try{
    $db->begin();      
    if(!$intDeletex){
      throw new exception('Permission is Denied ...');
    }
    
    $sql = "delete from `sys_permission`
          where syp_user_id='$grantUserId' and syp_location_id='$userLocationId' and syp_company_id='$userCompanyId'";
                
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





