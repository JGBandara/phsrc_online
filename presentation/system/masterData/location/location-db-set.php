
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-07
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
use presentation\system\masterData\classes\cls_sys_location;

$model = new cls_sys_location($db);

$response = [];
$autoNoType = "location";   
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//--------------------------------------------
$code           = isset($_REQUEST['txtCode'])?trim($_REQUEST['txtCode']):null;
$name           = isset($_REQUEST['txtName'])?trim($_REQUEST['txtName']):null;
$address           = isset($_REQUEST['txtAddress'])?trim($_REQUEST['txtAddress']):null;
$street           = isset($_REQUEST['txtStreet'])?trim($_REQUEST['txtStreet']):null;
$city           = isset($_REQUEST['txtCity'])?trim($_REQUEST['txtCity']):null;
$phoneNo           = isset($_REQUEST['txtPhoneNo'])?trim($_REQUEST['txtPhoneNo']):null;
$faxNo           = isset($_REQUEST['txtFaxNo'])?trim($_REQUEST['txtFaxNo']):null;
$email           = isset($_REQUEST['txtEmail'])?trim($_REQUEST['txtEmail']):null;
$attendanceFormat           = isset($_REQUEST['txtAttendanceFormat'])?trim($_REQUEST['txtAttendanceFormat']):null;
$zipCode           = isset($_REQUEST['txtZipCode'])?trim($_REQUEST['txtZipCode']):null;
$remarks           = isset($_REQUEST['txtRemarks'])?trim($_REQUEST['txtRemarks']):null;
$status           = isset($_REQUEST['cboStatus'])?trim($_REQUEST['cboStatus']):null;
$companyId           = isset($userCompanyId)?$userCompanyId:null;
$createdBy           = isset($userId)?$userId:null;
$lastModifiedBy           = isset($userId)?$userId:null;
$deletedBy           = isset($userId)?$userId:null;
//$details = json_decode($_REQUEST['detailList'], true);

// =======================================================
//         Insert
// =======================================================
if($requestType=='add'){
  try{
    $db->begin();      
    if(!$intAddx){
      throw new exception('Permission is Denied ...');
    }
    // Number Generation *******************************************
    if($anStatus == "Auto"){
//      $clsAutoNo = new cls_auto_number($db, $userCompanyId, $userLocationId);
//      $autoNo = $clsAutoNo->getAutoNo($autoNoType);
//      $noReference	= $clsAutoNo->encodeNo($autoNo,"Lo");
    }
    elseif($amStatus == "Manual"){
      $noReference	= $no;
    }
        //Add data to transaction header*******************************************
    $sql="insert into `sys_location`
            (syl_code, syl_name, syl_address, syl_street, syl_city, syl_phone_no, syl_fax_no, syl_email, syl_attendance_format, syl_zip_code, syl_remarks, syl_status, syl_company_id, syl_created_by, syl_created_on)
              values 
                ('$code', '$name', '$address', '$street', '$city', '$phoneNo', '$faxNo', '$email', '$attendanceFormat', '$zipCode', '$remarks', '$status', '$companyId', '$createdBy', '". time()."')";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $db->insertId;           
    
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
  
} // End If - Insert
// =======================================================
//         Update
// =======================================================
elseif($requestType=='edit'){
  try{
    $db->begin();  
    if(!$intEditx){
      throw new exception('Permission is Denied ...');
    }
        //Update data to transaction header*******************************************
    $sql="update `sys_location`
          set
            syl_code='$code',
            syl_name='$name',
            syl_address='$address',
            syl_street='$street',
            syl_city='$city',
            syl_phone_no='$phoneNo',
            syl_fax_no='$faxNo',
            syl_email='$email',
            syl_attendance_format='$attendanceFormat',
            syl_zip_code='$zipCode',
            syl_remarks='$remarks',
            syl_status='$status',
            syl_company_id='$companyId',
            syl_last_modified_by='$lastModifiedBy',
            syl_last_modified_on='". time()."'
          where syl_id='$id' and syl_company_id='$userCompanyId'";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;           
    
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
  try{
    $db->begin();      
    if(!$intDeletex){
      throw new exception('Permission is Denied ...');
    }
    
    $sql="update `sys_location`
          set
            syl_is_deleted = '1',
            syl_deleted_on = '". time()."',
            syl_deleted_by = '$userId'
          where syl_id='$id' and syl_company_id='$userCompanyId'";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;           
    
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
  
} // End If - Delete

echo json_encode($response);    
?>





