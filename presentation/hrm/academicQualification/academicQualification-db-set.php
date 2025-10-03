
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
use presentation\hrm\classes\cls_hrm_trn_academic_qualification;

$model = new cls_hrm_trn_academic_qualification($db);

$response = [];
$autoNoType = "academicQualification";   
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//--------------------------------------------
$employeeId           = isset($_REQUEST['cboEmployeeId'])?trim($_REQUEST['cboEmployeeId']):null;
$typeId           = isset($_REQUEST['cboTypeId'])?trim($_REQUEST['cboTypeId']):null;
$streamId           = isset($_REQUEST['cboStreamId'])?trim($_REQUEST['cboStreamId']):null;
$institute           = isset($_REQUEST['txtInstitute'])?trim($_REQUEST['txtInstitute']):null;
$year           = isset($_REQUEST['txtYear'])?trim($_REQUEST['txtYear']):null;
$indexNo           = isset($_REQUEST['txtIndexNo'])?trim($_REQUEST['txtIndexNo']):null;
$remarks           = isset($_REQUEST['txtRemarks'])?trim($_REQUEST['txtRemarks']):null;
$status           = isset($_REQUEST['cboStatus'])?trim($_REQUEST['cboStatus']):null;
$locationId           = isset($userLocationId)?$userLocationId:null;
$companyId           = isset($userCompanyId)?$userCompanyId:null;
$createdBy           = isset($userId)?$userId:null;
$lastModifiedBy           = isset($userId)?$userId:null;
$deletedBy           = isset($userId)?$userId:null;
$newDataRows = json_decode($_REQUEST['newData'], true);
$deletedDataIds = json_decode($_REQUEST['deletedData'], true);

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
//      $noReference	= $clsAutoNo->encodeNo($autoNo,"Ac");
    }
    elseif($amStatus == "Manual"){
      $noReference	= $no;
    }
        //Add data to transaction header*******************************************
    $sql = "insert into `hrm_trn_academic_qualification`
              (eaq_employee_id, eaq_type_id, eaq_stream_id, eaq_institute, eaq_year, eaq_index_no, eaq_remarks, eaq_status, eaq_location_id, eaq_company_id, eaq_created_by, eaq_created_on)
            values 
              ('$employeeId', '$typeId', '$streamId', '$institute', '$year', '$indexNo', '$remarks', '$status', '$locationId', '$companyId', '$createdBy', '". time()."')";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $db->insertId;  
    //Add data to transaction Details *******************************************
  foreach($newDataRows as $dataRow){
    $sql = "insert into `hrm_trn_academic_qualification_details`
              (eaqd_qualification_id, eaqd_subject_id, eaqd_grade, eaqd_remarks, eaqd_location_id, eaqd_company_id, eaqd_created_by, eaqd_created_on)
            values 
              ('". $entryId ."', '".$dataRow['detSubjectId']."', '".$dataRow['detGrade']."', '".$dataRow['detRemarks']."', '". $userLocationId ."', '". $userCompanyId ."', '". $userId ."', '". time()."')";
                
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
    $sql="update `hrm_trn_academic_qualification`
          set
            eaq_employee_id='$employeeId',
            eaq_type_id='$typeId',
            eaq_stream_id='$streamId',
            eaq_institute='$institute',
            eaq_year='$year',
            eaq_index_no='$indexNo',
            eaq_remarks='$remarks',
            eaq_status='$status',
            eaq_location_id='$locationId',
            eaq_last_modified_by='$lastModifiedBy',
            eaq_last_modified_on='". time()."'
          where eaq_id='$id' and eaq_company_id='$userCompanyId'  and eaq_location_id='$userLocationId'";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;   
    //Update data to transaction details *******************************************
    foreach($newDataRows as $dataRow){
      if($dataRow['detId']===""){
        $sql = "insert into `hrm_trn_academic_qualification_details`
              (eaqd_qualification_id, eaqd_subject_id, eaqd_grade, eaqd_remarks, eaqd_location_id, eaqd_company_id, eaqd_created_by, eaqd_created_on)
            values 
              ('". $entryId ."', '".$dataRow['detSubjectId']."', '".$dataRow['detGrade']."', '".$dataRow['detRemarks']."', '". $userLocationId ."', '". $userCompanyId ."', '". $userId ."', '". time()."')";
      }
      else{
        $sql = "update `hrm_trn_academic_qualification_details`
                set
                  eaqd_qualification_id='". $entryId ."',
                  eaqd_subject_id='".$dataRow['detSubjectId']."',
                  eaqd_grade='".$dataRow['detGrade']."',
                  eaqd_remarks='".$dataRow['detRemarks']."',
                  eaqd_location_id='". $userLocationId ."',
                  eaqd_company_id='". $userCompanyId ."',
                  eaqd_last_modified_by='". $userId ."',
                  eaqd_last_modified_on='". time()."'
                where eaqd_id='".$dataRow['detId']."' and eaqd_company_id='$userCompanyId'  and eaqd_location_id='$userLocationId'";
      }
                
      $finalResult = $finalResult && $db->batchQuery($sql);
    }
    // Change status as Delete for removed details *********************************
    foreach($deletedDataIds as $deleteRow){
      $sql = "update `hrm_trn_academic_qualification_details`
              set
                eaqd_status='0',
                eaqd_is_deleted='1',
                eaqd_deleted_on='". time() ."',
                eaqd_deleted_by='". $userId ."'
              where eaqd_id='".$deleteRow."' and eaqd_company_id='$userCompanyId'  and eaqd_location_id='$userLocationId'";
    
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
// =======================================================
//         Delete
// =======================================================
elseif($requestType=='delete'){
  try{
    $db->begin();      
    if(!$intDeletex){
      throw new exception('Permission is Denied ...');
    }
    
    $sql="update `hrm_trn_academic_qualification`
          set
            eaq_status = '0',
            eaq_is_deleted = '1',
            eaq_deleted_on = '". time()."',
            eaq_deleted_by = '$userId'
          where eaq_id='$id' and eaq_company_id='$userCompanyId'  and eaq_location_id='$userLocationId'";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;        
    
    // Change status as Delete for removed details *********************************
    $sql="update `hrm_trn_academic_qualification_details`
          set
            eaqd_status = '0',
            eaqd_is_deleted = '1',
            eaqd_deleted_on = '". time()."',
            eaqd_deleted_by = '$userId'
          where eaqd_qualification_id='$id' and eaqd_company_id='$userCompanyId' and eaqd_is_deleted = '0'  and eaqd_location_id='$userLocationId'";
    
    $finalResult = $finalResult && $db->batchQuery($sql);
    
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
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 		= $sql;                
  }
  
} // End If - Delete

echo json_encode($response);    
?>





