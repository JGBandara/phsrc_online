<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-22
 */
//session_start();
//$mainPath = $_SESSION['MAIN_PATH'];
session_start();
$backwardSeparator = "../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

include  "{$backwardSeparator}dataAccess/serverAccessController.php";
//require_once $backwardSeparator.'dataAccess/connector.php';

//use classes\cls_auto_number;
//use classes\cls_approval;
use presentation\hrm\classes\cls_hrm_trn_job_status;

$model = new cls_hrm_trn_job_status($db);

$response = [];
$autoNoType = "jobStatus";   
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//--------------------------------------------
$employeeId           = isset($_REQUEST['cboEmployeeId'])?trim($_REQUEST['cboEmployeeId']):null;
$employmentTypeId           = isset($_REQUEST['cboEmploymentTypeId'])?trim($_REQUEST['cboEmploymentTypeId']):null;
$startDate           = isset($_REQUEST['dtpStartDate'])?trim($_REQUEST['dtpStartDate']):null;
$endDate           = isset($_REQUEST['dtpEndDate'])?trim($_REQUEST['dtpEndDate']):null;
$statutoryClassificationId           = isset($_REQUEST['cboStatutoryClassificationId'])?trim($_REQUEST['cboStatutoryClassificationId']):null;
$employmentCategoryId           = isset($_REQUEST['cboEmploymentCategoryId'])?trim($_REQUEST['cboEmploymentCategoryId']):null;
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
//      $noReference	= $clsAutoNo->encodeNo($autoNo,"Jo");
    }
    elseif($amStatus == "Manual"){
      $noReference	= $no;
    }
    // Old Job Status set as Inactive
    $sql="update `hrm_trn_job_status`
          set
            ejs_status = '21',
            ejs_last_modified_by='$lastModifiedBy',
            ejs_last_modified_on='". time()."'
          where ejs_employee_id='$employeeId' and ejs_company_id='$userCompanyId' ";
                
    $finalResult = $db->batchQuery($sql);
        //Add data to transaction header*******************************************
    $sql="insert into `hrm_trn_job_status`
            (ejs_employee_id, ejs_employment_type_id, ejs_start_date, ejs_end_date, ejs_statutory_classification_id, ejs_employment_category_id, ejs_remarks, ejs_status, ejs_company_id, ejs_created_by, ejs_created_on)
              values 
                ('$employeeId', '$employmentTypeId', '$startDate', '$endDate', '$statutoryClassificationId', '$employmentCategoryId', '$remarks', '1', '$companyId', '$createdBy', '". time()."')";
                
    $finalResult = $finalResult && $db->batchQuery($sql);
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
    $sql="update `hrm_trn_job_status`
          set
            ejs_employee_id='$employeeId',
            ejs_employment_type_id='$employmentTypeId',
            ejs_start_date='$startDate',
            ejs_end_date='$endDate',
            ejs_statutory_classification_id='$statutoryClassificationId',
            ejs_employment_category_id='$employmentCategoryId',
            ejs_remarks='$remarks',
            ejs_company_id='$companyId',
            ejs_last_modified_by='$lastModifiedBy',
            ejs_last_modified_on='". time()."'
          where ejs_id='$id' and ejs_company_id='$userCompanyId' ";
                
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
    
    $sql="update `hrm_trn_job_status`
          set
            ejs_is_deleted = '1',
            ejs_deleted_on = '". time()."',
            ejs_deleted_by = '$userId'
          where ejs_id='$id' and ejs_company_id='$userCompanyId' ";
                
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





