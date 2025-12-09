<?php

session_start();
$backwardSeparator = "../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

include  "{$backwardSeparator}dataAccess/serverAccessController.php";
//require_once $backwardSeparator.'dataAccess/connector.php';

use classes\cls_auto_number;
use classes\cls_approval;
use presentation\dms\classes\cls_dms_trn_file;
use presentation\dms\classes\cls_dms;
use presentation\system\masterData\classes\cls_sys_users;

$model = new cls_dms_trn_file($db);

$response = [];
$autoNoType = "file";   
  
$requestType 	= $_REQUEST['requestType'];
//$anStatus       = $_REQUEST['anStatus'];
//$id             = $_REQUEST['cboSearch'];
////--------------------------------------------
//$fileName           = isset($_REQUEST['txtFileName'])?trim($_REQUEST['txtFileName']):null;
//$fileExtension           = isset($_REQUEST['txtFileExtension'])?trim($_REQUEST['txtFileExtension']):null;
//$storeLocation           = isset($_REQUEST['txtStoreLocation'])?trim($_REQUEST['txtStoreLocation']):null;
//$url           = isset($_REQUEST['txtUrl'])?trim($_REQUEST['txtUrl']):null;
//$referenceNo           = isset($_REQUEST['txtReferenceNo'])?trim($_REQUEST['txtReferenceNo']):null;
//$referenceId           = isset($_REQUEST['cboReferenceId'])?trim($_REQUEST['cboReferenceId']):null;
//$fileCategoryId           = isset($_REQUEST['cboFileCategoryId'])?trim($_REQUEST['cboFileCategoryId']):null;
//$fileVersion           = isset($_REQUEST['txtFileVersion'])?trim($_REQUEST['txtFileVersion']):null;
//$metaData           = isset($_REQUEST['txtMetaData'])?trim($_REQUEST['txtMetaData']):null;
//$remarks           = isset($_REQUEST['txtRemarks'])?trim($_REQUEST['txtRemarks']):null;
//$status           = isset($_REQUEST['cboStatus'])?trim($_REQUEST['cboStatus']):null;
//$companyId           = isset($userCompanyId)?$userCompanyId:null;
//$createdBy           = isset($userId)?$userId:null;
//$lastModifiedBy           = isset($userId)?$userId:null;
//$deletedBy           = isset($userId)?$userId:null;
//$details = json_decode($_REQUEST['detailList'], true);

// =======================================================
//         Insert
// =======================================================
if($requestType=='upload'){
  $clsDms = new cls_dms($db, $userCompanyId, $userLocationId, $userId);
  try{
    $db->begin();      
    $finalResult = true;
    $file = $_FILES['file'];
    $refId = $_REQUEST['ref_id'];
    $refNo = $_REQUEST['ref_no'];
    $category = $_REQUEST['cat_id'];
    $metaData = $_REQUEST['meta'];
    $modelUser = new cls_sys_users($db);   
    $modelUser->syu_id = $userId;
    $modelUser = $modelUser->findModel();
   // $divisionId = $modelUser->syu_division_id;
    $divisionId = 1;
    
    $response1 = $clsDms->upload($file, $divisionId, $category, $refNo, $refId, $metaData, $backwardSeparator);  
   $sqla = "update institute_payment_detail set payment_is_approval='0' where payment_detail_institute_id='$refId' ";
    $db->singleQuery($sqla);

    if($finalResult && $response1['url'] != ""){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $response['url'] 	= $response1['url']; 
        $response['id'] 	= $response1['id']; 
        $response['file_name'] 	= $response1['file_name']; 
        $db->commit();
    }
    else{        
        $db->rollback();//roalback
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-type: text/plain');
        exit($db->errormsg);
//        $response['type'] 		= 'fail';
//        $response['msg'] 		= $db->errormsg;
//        $response['q'] 			= $sql;
    }
            
  }catch(Exception $e){
      $db->rollback();//roalback
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-type: text/plain');
        exit($e->getMessage());

//    $response['type'] 		= 'fail';
//    $response['msg'] 		= $e->getMessage();
//    $response['q'] 			= $sql;                
  }
  
} // End If - Upload
// =======================================================
//        Restore Backup
// =======================================================
elseif($requestType=='restore_backup'){
  try{
    $db->begin();  
    $finalResult = true;
    $file = $_FILES['file'];

    $filePath = $file['tmp_name'];
    if (file_exists($filePath)) {
      $zip = new ZipArchive;
      $res = $zip->open($filePath);
      if ($res === TRUE) {
        $zip->extractTo($backwardSeperator);
        $zip->close();
      } else {
        throw new Exception("File is not found.");
      }
    }    
    if($finalResult){                    
      $response['type']   = 'pass';
      $response['msg']    = 'Restored successfully.';
      $response['no']     = $noReference; 
      $response['id']     = $entryId;
      $db->commit();
    }
    else{                    
      $response['type'] 		= 'fail';
      $response['msg'] 		= $db->errormsg;
      $response['q'] 			= $sql;
      $db->rollback();
    }
            
  }catch(Exception $e){

    $db->rollback();

    $response['type'] 		= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 			= $sql;                
  }
  
} // End If - Restore Backup
// =======================================================
//         Unlink
// =======================================================
elseif($requestType=='unlink'){
  $fullUrl = $_REQUEST['fileName'];
  $id = $_REQUEST['id'];
  $clsDms = new cls_dms($db, $userCompanyId, $userLocationId, $userId);
  try{
    $db->begin();   
    
    $finalResult = true;
    $finalResult = $finalResult & $clsDms->unlink($fullUrl, $id);
    
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
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
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 		= $sql;                
  }
  
} // End If - Unlink
// =======================================================
//         Unlink By User
// =======================================================
elseif($requestType=='unlinkByUser'){
  $fullUrl = $backwardSeperator.$_REQUEST['fileName'];
  $id = $_REQUEST['id'];
  $clsDms = new cls_dms($db, $userCompanyId, $userLocationId, $userId);
  try{
    $db->begin();   
    
    $finalResult = true;
    $finalResult = $finalResult & $clsDms->unlinkByUser($fullUrl, $id);
    
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
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
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 		= $sql;                
  }
  
} // End If - Unlink By User
// =======================================================
//         Update Remarks
// =======================================================
elseif($requestType=='updateRemarks'){
  $remarks = $_REQUEST['remarks'];
  $id = $_REQUEST['id'];
  $clsDms = new cls_dms($db, $userCompanyId, $userLocationId, $userId);
  try{
    $db->begin();   
    
    $finalResult = true;
    if($id!='' && $id != 'undefined' && $id !='0'){
      $finalResult = $finalResult & $clsDms->updateRemarks($remarks, $id);
    }
    else{
      throw new Exception('File Id not submitted.');
      $finalResult = false;
    }
    
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
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
  
} // End If - Update Remarks
// =======================================================
//         Access Log
// =======================================================
elseif($requestType=='accessLog'){
  $id = $_REQUEST['id'];
  try{
    $db->begin();   
    
    $sql = "select dfi_url, if(isnull(dfp_id),'No Permission To Access', 'Access Granted') as 'remarks', dfi_status, stat_name
            from dms_trn_file
                inner join sys_status on dfi_status=stat_id
                left join dms_file_permission on dfi_file_category_id=dfp_file_category_id and dfp_user_id='$userId' and dfp_status='1' and dfp_is_deleted='0'
            where dfi_id='$id'";
    $result = $db->singleQuery($sql);
    $noPermission = true;
    if($row = mysqli_fetch_array($result)){
      $noPermission = false;
      $url = $row['dfi_url'];
      $remarks = $row['remarks']."-".$row['stat_name'];
    }
    else{
      $url = '#';
      $remarks = "No Permission To Access - ".$id;
    }

    $sql = "insert into `dms_trn_file_access_log`
                (`dfa_file_id`, `dfa_user_id`, `dfa_access_time`, `dfa_remarks`, 
                  `dfa_status`, `dfa_is_deleted`, `dfa_company_id`, `dfa_created_by`, `dfa_created_on`)
            values 
                ('$id', '$userId', now(), '$remarks',
                  '1', '0', '$userCompanyId', '$userId', '". time()."')";
    $result = $db->singleQuery($sql);
    if($noPermission){
      throw new Exception ("No Permission To Access");
    }    
    
    $response['type'] 	= 'pass';
    $response['msg'] 	= 'Saved successfully.';
    $response['url'] 	= $url;
    $response['id'] 	= $entryId;
    $db->commit();
            
  }catch(Exception $e){

    $db->rollback();//roalback

    header('HTTP/1.1 500 Internal Server Error');
    header('Content-type: text/plain');
    exit($e->getMessage());
  }
  
} // End If - Update Remarks

echo json_encode($response);    
?>





