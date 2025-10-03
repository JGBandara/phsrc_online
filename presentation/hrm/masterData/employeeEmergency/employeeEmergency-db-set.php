
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-09
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
use presentation\hrm\masterData\classes\cls_hrm_employee_emergency;

$model = new cls_hrm_employee_emergency($db);

$response = [];
$autoNoType = "employeeEmergency";   
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//--------------------------------------------
$fullName           = isset($_REQUEST['txtFullName'])?trim($_REQUEST['txtFullName']):null;
$relationship           = isset($_REQUEST['txtRelationship'])?trim($_REQUEST['txtRelationship']):null;
$homeAddress           = isset($_REQUEST['txtHomeAddress'])?trim($_REQUEST['txtHomeAddress']):null;
$homeTelephone           = isset($_REQUEST['txtHomeTelephone'])?trim($_REQUEST['txtHomeTelephone']):null;
$officeAddress           = isset($_REQUEST['txtOfficeAddress'])?trim($_REQUEST['txtOfficeAddress']):null;
$officeTelephone           = isset($_REQUEST['txtOfficeTelephone'])?trim($_REQUEST['txtOfficeTelephone']):null;
$mobileNo           = isset($_REQUEST['txtMobileNo'])?trim($_REQUEST['txtMobileNo']):null;
$emergencyContact           = isset($_REQUEST['txtEmergencyContact'])?trim($_REQUEST['txtEmergencyContact']):null;
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
//      $noReference	= $clsAutoNo->encodeNo($autoNo,"Em");
    }
    elseif($amStatus == "Manual"){
      $noReference	= $no;
    }
    //Add data to transaction header*******************************************
    $sql="insert into `hrm_employee_emergency`
            (eme_id, eme_full_name, eme_relationship, eme_home_address, eme_home_telephone, eme_office_address, eme_office_telephone, eme_mobile_no, eme_emergency_contact, eme_remarks, eme_status, eme_company_id, eme_created_by, eme_created_on)
              values 
                ('$id', '$fullName', '$relationship', '$homeAddress', '$homeTelephone', '$officeAddress', '$officeTelephone', '$mobileNo', '$emergencyContact', '$remarks', '$status', '$companyId', '$createdBy', '". time()."')";
                
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
    $sql = "select * from hrm_employee_emergency where eme_id='$id' and eme_company_id='$userCompanyId'";
    $result = $db->batchQuery($sql);
    if($row = mysqli_fetch_row($result)){
      //Update data to transaction header*******************************************
      $sql="update `hrm_employee_emergency`
            set
              eme_id='$id',
              eme_full_name='$fullName',
              eme_relationship='$relationship',
              eme_home_address='$homeAddress',
              eme_home_telephone='$homeTelephone',
              eme_office_address='$officeAddress',
              eme_office_telephone='$officeTelephone',
              eme_mobile_no='$mobileNo',
              eme_emergency_contact='$emergencyContact',
              eme_remarks='$remarks',
              eme_status='$status',
              eme_company_id='$companyId',
              eme_last_modified_by='$lastModifiedBy',
              eme_last_modified_on='". time()."'
            where eme_id='$id' and eme_company_id='$userCompanyId'";
    }
    else{
      //Add data to transaction header*******************************************
      $sql = "insert into `hrm_employee_emergency`
                (eme_id, eme_full_name, eme_relationship, eme_home_address, eme_home_telephone, eme_office_address, eme_office_telephone, eme_mobile_no, eme_emergency_contact, eme_remarks, eme_status, eme_company_id, eme_created_by, eme_created_on)
              values 
                ('$id', '$fullName', '$relationship', '$homeAddress', '$homeTelephone', '$officeAddress', '$officeTelephone', '$mobileNo', '$emergencyContact', '$remarks', '$status', '$companyId', '$createdBy', '". time()."')";
      
    }
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
    
    $sql="update `hrm_employee_emergency`
          set
            eme_is_deleted = '1',
            eme_deleted_on = '". time()."',
            eme_deleted_by = '$userId'
          where eme_id='$id' and eme_company_id='$userCompanyId'";
                
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





