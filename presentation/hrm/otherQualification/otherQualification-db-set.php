
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-23
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
use presentation\hrm\classes\cls_hrm_trn_other_qualification;

$model = new cls_hrm_trn_other_qualification($db);

$response = [];
$autoNoType = "otherQualification";   
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//--------------------------------------------
$employeeId           = isset($_REQUEST['cboEmployeeId'])?trim($_REQUEST['cboEmployeeId']):null;
$qualificationCategoryId           = isset($_REQUEST['cboQualificationCategoryId'])?trim($_REQUEST['cboQualificationCategoryId']):null;
$qualificationTypeId           = isset($_REQUEST['cboQualificationTypeId'])?trim($_REQUEST['cboQualificationTypeId']):null;
$name           = isset($_REQUEST['txtName'])?trim($_REQUEST['txtName']):null;
$stream           = isset($_REQUEST['txtStream'])?trim($_REQUEST['txtStream']):null;
$institute           = isset($_REQUEST['txtInstitute'])?trim($_REQUEST['txtInstitute']):null;
$qualificationStatus           = isset($_REQUEST['txtQualificationStatus'])?trim($_REQUEST['txtQualificationStatus']):null;
$year           = isset($_REQUEST['txtYear'])?trim($_REQUEST['txtYear']):null;
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
//      $noReference	= $clsAutoNo->encodeNo($autoNo,"Ot");
    }
    elseif($amStatus == "Manual"){
      $noReference	= $no;
    }
        //Add data to transaction header*******************************************
    $sql="insert into `hrm_trn_other_qualification`
            (eoq_employee_id, eoq_qualification_category_id, eoq_qualification_type_id, eoq_name, eoq_stream, eoq_institute, eoq_qualification_status, eoq_year, eoq_remarks, eoq_status, eoq_company_id, eoq_created_by, eoq_created_on)
              values 
                ('$employeeId', '$qualificationCategoryId', '$qualificationTypeId', '$name', '$stream', '$institute', '$qualificationStatus', '$year', '$remarks', '$status', '$companyId', '$createdBy', '". time()."')";
                
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
    $sql="update `hrm_trn_other_qualification`
          set
            eoq_employee_id='$employeeId',
            eoq_qualification_category_id='$qualificationCategoryId',
            eoq_qualification_type_id='$qualificationTypeId',
            eoq_name='$name',
            eoq_stream='$stream',
            eoq_institute='$institute',
            eoq_qualification_status='$qualificationStatus',
            eoq_year='$year',
            eoq_remarks='$remarks',
            eoq_status='$status',
            eoq_company_id='$companyId',
            eoq_last_modified_by='$lastModifiedBy',
            eoq_last_modified_on='". time()."'
          where eoq_id='$id' and eoq_company_id='$userCompanyId' ";
                
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
    
    $sql="update `hrm_trn_other_qualification`
          set
            eoq_is_deleted = '1',
            eoq_deleted_on = '". time()."',
            eoq_deleted_by = '$userId'
          where eoq_id='$id' and eoq_company_id='$userCompanyId' ";
                
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





