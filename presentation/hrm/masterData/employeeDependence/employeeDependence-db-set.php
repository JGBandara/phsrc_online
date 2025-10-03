
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-10
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
use presentation\hrm\masterData\classes\cls_hrm_employee_dependence;

$model = new cls_hrm_employee_dependence($db);

$response = [];
$autoNoType = "employeeDependence";   
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//--------------------------------------------
$employeeId           = isset($_REQUEST['cboEmployeeId'])?trim($_REQUEST['cboEmployeeId']):null;
$fullName           = isset($_REQUEST['txtFullName'])?trim($_REQUEST['txtFullName']):null;
$dateOfBirth           = isset($_REQUEST['dtpDateOfBirth'])?trim($_REQUEST['dtpDateOfBirth']):null;
$nicNo           = isset($_REQUEST['txtNicNo'])?trim($_REQUEST['txtNicNo']):null;
$telephone           = isset($_REQUEST['txtTelephone'])?trim($_REQUEST['txtTelephone']):null;
$entitledDeathDonation           = isset($_REQUEST['optEntitledDeathDonation'])?trim($_REQUEST['optEntitledDeathDonation']):null;
$entitledMedicalBenifits           = isset($_REQUEST['optEntitledMedicalBenifits'])?trim($_REQUEST['optEntitledMedicalBenifits']):null;
$providentFundNominee           = isset($_REQUEST['optProvidentFundNominee'])?trim($_REQUEST['optProvidentFundNominee']):null;
$living           = isset($_REQUEST['optLiving'])?trim($_REQUEST['optLiving']):null;
$workType           = isset($_REQUEST['optWorkType'])?trim($_REQUEST['optWorkType']):null;
$workingAddress           = isset($_REQUEST['txtWorkingAddress'])?trim($_REQUEST['txtWorkingAddress']):null;
$workingTelephone           = isset($_REQUEST['txtWorkingTelephone'])?trim($_REQUEST['txtWorkingTelephone']):null;
$permanentAddress           = isset($_REQUEST['txtPermanentAddress'])?trim($_REQUEST['txtPermanentAddress']):null;
$mobile           = isset($_REQUEST['txtMobile'])?trim($_REQUEST['txtMobile']):null;
$sameOffice           = isset($_REQUEST['optSameOffice'])?trim($_REQUEST['optSameOffice']):null;
$maritalStatusId           = isset($_REQUEST['cboMaritalStatusId'])?trim($_REQUEST['cboMaritalStatusId']):null;
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
    $sql="insert into `hrm_employee_dependence`
            (emd_employee_id, emd_full_name, emd_date_of_birth, emd_nic_no, emd_telephone, emd_entitled_death_donation, emd_entitled_medical_benifits, emd_provident_fund_nominee, emd_living, emd_work_type, emd_working_address, emd_working_telephone, emd_permanent_address, emd_mobile, emd_same_office, emd_marital_status_id, emd_remarks, emd_status, emd_company_id, emd_created_by, emd_created_on)
              values 
                ('$employeeId', '$fullName', '$dateOfBirth', '$nicNo', '$telephone', '$entitledDeathDonation', '$entitledMedicalBenifits', '$providentFundNominee', '$living', '$workType', '$workingAddress', '$workingTelephone', '$permanentAddress', '$mobile', '$sameOffice', '$maritalStatusId', '$remarks', '$status', '$companyId', '$createdBy', '". time()."')";
                
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
    $sql="update `hrm_employee_dependence`
          set
            emd_employee_id='$employeeId',
            emd_full_name='$fullName',
            emd_date_of_birth='$dateOfBirth',
            emd_nic_no='$nicNo',
            emd_telephone='$telephone',
            emd_entitled_death_donation='$entitledDeathDonation',
            emd_entitled_medical_benifits='$entitledMedicalBenifits',
            emd_provident_fund_nominee='$providentFundNominee',
            emd_living='$living',
            emd_work_type='$workType',
            emd_working_address='$workingAddress',
            emd_working_telephone='$workingTelephone',
            emd_permanent_address='$permanentAddress',
            emd_mobile='$mobile',
            emd_same_office='$sameOffice',
            emd_marital_status_id='$maritalStatusId',
            emd_remarks='$remarks',
            emd_status='$status',
            emd_company_id='$companyId',
            emd_last_modified_by='$lastModifiedBy',
            emd_last_modified_on='". time()."'
          where emd_id='$id' and emd_company_id='$userCompanyId'";
                
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
    
    $sql="update `hrm_employee_dependence`
          set
            emd_is_deleted = '1',
            emd_deleted_on = '". time()."',
            emd_deleted_by = '$userId'
          where emd_id='$id' and emd_company_id='$userCompanyId'";
                
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





