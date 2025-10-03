
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

include  "{$backwardSeparator}dataAccess/serverAccessController.php";
//require_once $backwardSeparator.'dataAccess/connector.php';

use classes\cls_auto_number;
use classes\cls_approval;
use presentation\system\masterData\classes\cls_sys_user_location;

$model = new cls_sys_user_location($db);

$response = [];
$autoNoType = "userLocation";   
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
$locations    = $_REQUEST['location'];
//--------------------------------------------
//$fileCategoryId           = isset($_REQUEST['cboFileCategoryId'])?trim($_REQUEST['cboFileCategoryId']):null;
//$userId           = isset($_REQUEST['cboUserId'])?trim($_REQUEST['cboUserId']):null;
//$remarks           = isset($_REQUEST['txtRemarks'])?trim($_REQUEST['txtRemarks']):null;
//$status           = isset($_REQUEST['cboStatus'])?trim($_REQUEST['cboStatus']):null;
$companyId           = isset($userCompanyId)?$userCompanyId:null;
$createdBy           = isset($userId)?$userId:null;
$lastModifiedBy      = isset($userId)?$userId:null;
$deletedBy           = isset($userId)?$userId:null;
//$details = json_decode($_REQUEST['detailList'], true);

// =======================================================
//         Update
// =======================================================
if($requestType=='edit'){
  try{
    $db->begin();  
    if(!$intEditx){
      throw new exception('Permission is Denied ...');
    }
    if(!is_array($locations)){
      throw new exception('Locations are not selected ...');
    }
    $sql="update `sys_user_location`
          set
            syo_status='0',
            syo_is_deleted='1',
            syo_last_modified_by='$lastModifiedBy',
            syo_last_modified_on='". time()."'
          where syo_user_id='$id' and syo_company_id='$userCompanyId'";
    $result = $db->batchQuery($sql);
//    print_r($locations);
    foreach ($locations as $locId) {
      $sql = "select syo_id
              from sys_user_location 
              where syo_company_id='$userCompanyId' and syo_location_id='$locId' and syo_user_id='$id'";
      $result = $db->batchQuery($sql);
      if($row = mysqli_fetch_array($result)){
        $recordId = $row['syo_id'];
        //Update data to transaction header*******************************************
        $sql = "update `sys_user_location`
              set
                syo_location_id='$locId',
                syo_user_id='$id',
                syo_status='1',
                syo_is_deleted='0',
                syo_company_id='$companyId',
                syo_last_modified_by='$lastModifiedBy',
                syo_last_modified_on='". time()."'
              where syo_id='$recordId' and syo_company_id='$userCompanyId'";
      }
      else{
        $sql="insert into `sys_user_location`
                (syo_location_id, syo_user_id, syo_remarks, syo_status, syo_company_id, syo_created_by, syo_created_on)
              values 
                ('$locId', '$id', '', '1', '$companyId', '$createdBy', '". time()."')";
      }
      $finalResult = $db->batchQuery($sql);
      $entryId = $id;           
      
    }
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $response['no'] 	= $noReference; 
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

    $response['type'] 		= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 			= $sql;                
  }
  
} // End If - Update
echo json_encode($response);    
?>





