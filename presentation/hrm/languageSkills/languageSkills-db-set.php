
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-24
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
use presentation\hrm\classes\cls_hrm_trn_language_skills;

$model = new cls_hrm_trn_language_skills($db);

$response = [];
$autoNoType = "languageSkills";   
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//--------------------------------------------
$employeeId           = isset($_REQUEST['cboEmployeeId'])?trim($_REQUEST['cboEmployeeId']):null;
$languageId           = isset($_REQUEST['cboLanguageId'])?trim($_REQUEST['cboLanguageId']):null;
$skillTypeId           = isset($_REQUEST['cboSkillTypeId'])?$_REQUEST['cboSkillTypeId']:null;
$meritId           = isset($_REQUEST['cboMeritId'])?$_REQUEST['cboMeritId']:null;
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
//      $noReference	= $clsAutoNo->encodeNo($autoNo,"La");
    }
    elseif($amStatus == "Manual"){
      $noReference	= $no;
    }
    
    $finalResult = true;
    
    foreach ($skillTypeId as $k=>$skillType) {
      //Add data to transaction header*******************************************
      $sql="insert into `hrm_trn_language_skills`
              (lgs_employee_id, lgs_language_id, lgs_skill_type_id, lgs_merit_id, lgs_remarks, lgs_status, lgs_company_id, lgs_created_by, lgs_created_on)
                values 
                  ('$employeeId', '$languageId', '$skillType', '$meritId[$k]', '$remarks', '$status', '$companyId', '$createdBy', '". time()."')";

      $finalResult = $finalResult && $db->batchQuery($sql);
    }
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
    $finalResult = true;
    
    foreach ($skillTypeId as $k=>$skillType) {
      $sql = "select *
              from hrm_trn_language_skills
              where lgs_employee_id='$employeeId' and lgs_skill_type_id='$skillType' and lgs_language_id='$languageId' and lgs_company_id='$userCompanyId' and lgs_is_deleted='0'";
      $result = $db->batchQuery($sql);
      if(mysqli_num_rows($result)>0){
          //Update data to transaction header*******************************************
        $sql="update `hrm_trn_language_skills`
              set
                lgs_employee_id='$employeeId',
                lgs_language_id='$languageId',
                lgs_skill_type_id='$skillType',
                lgs_merit_id='$meritId[$k]',
                lgs_remarks='$remarks',
                lgs_status='$status',
                lgs_company_id='$companyId',
                lgs_last_modified_by='$lastModifiedBy',
                lgs_last_modified_on='". time()."'
              where lgs_employee_id='$employeeId' and lgs_skill_type_id='$skillType' and lgs_language_id='$languageId' and lgs_company_id='$userCompanyId' ";
      }
      else{
        //Add data to transaction header*******************************************
        $sql="insert into `hrm_trn_language_skills`
                (lgs_employee_id, lgs_language_id, lgs_skill_type_id, lgs_merit_id, lgs_remarks, lgs_status, lgs_company_id, lgs_created_by, lgs_created_on)
                  values 
                    ('$employeeId', '$languageId', '$skillType', '$meritId[$k]', '$remarks', '$status', '$companyId', '$createdBy', '". time()."')";
      }
      $finalResult = $finalResult && $db->batchQuery($sql);
    }
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
    
    $sql="update `hrm_trn_language_skills`
          set
            lgs_is_deleted = '1',
            lgs_deleted_on = '". time()."',
            lgs_deleted_by = '$userId'
          where lgs_employee_id='$employeeId' and lgs_language_id='$languageId' and lgs_company_id='$userCompanyId' and  lgs_is_deleted='0'";
                
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





