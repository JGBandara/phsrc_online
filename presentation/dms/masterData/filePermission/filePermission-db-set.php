
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
use presentation\dms\masterData\classes\cls_dms_file_permission;

$model = new cls_dms_file_permission($db);

$response = [];
$autoNoType = "filePermission";   
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
$permissions    = $_REQUEST['permission'];
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
    if(!is_array($permissions)){
      throw new exception('Permissions are not selected ...');
    }
    $sql="update `dms_file_permission`
          set
            dfp_status='0',
            dfp_is_deleted='1',
            dfp_last_modified_by='$lastModifiedBy',
            dfp_last_modified_on='". time()."'
          where dfp_user_id='$id' and dfp_company_id='$userCompanyId' and dfp_location_id='$userLocationId'";
    $result = $db->batchQuery($sql);
//    print_r($permissions);
    foreach ($permissions as $catId) {
      $sql = "select dfp_id
              from dms_file_permission 
              where dfp_company_id='$userCompanyId' and dfp_location_id='$userLocationId' and dfp_file_category_id='$catId' and dfp_user_id='$id'";
      $result = $db->batchQuery($sql);
      if($row = mysqli_fetch_array($result)){
        $recordId = $row['dfp_id'];
        //Update data to transaction header*******************************************
        $sql="update `dms_file_permission`
              set
                dfp_file_category_id='$catId',
                dfp_user_id='$id',
                dfp_status='1',
                dfp_is_deleted='0',
                dfp_company_id='$companyId',
                dfp_last_modified_by='$lastModifiedBy',
                dfp_last_modified_on='". time()."'
              where dfp_id='$recordId' and dfp_company_id='$userCompanyId' and dfp_location_id='$userLocationId'";
      }
      else{
        $sql="insert into `dms_file_permission`
                (dfp_file_category_id, dfp_user_id, dfp_remarks, dfp_status, dfp_location_id, dfp_company_id, dfp_created_by, dfp_created_on)
              values 
                ('$catId', '$id', '', '1', '$userLocationId', '$companyId', '$createdBy', '". time()."')";
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





