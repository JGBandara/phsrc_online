
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
use presentation\hrm\masterData\classes\cls_hrm_employee_residential;

$model = new cls_hrm_employee_residential($db);

$response = [];
$autoNoType = "employeeResidential";   
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//--------------------------------------------
$permanentAddress           = isset($_REQUEST['txtPermanentAddress'])?trim($_REQUEST['txtPermanentAddress']):null;
$permanentStreet           = isset($_REQUEST['txtPermanentStreet'])?trim($_REQUEST['txtPermanentStreet']):null;
$permanentCity           = isset($_REQUEST['txtPermanentCity'])?trim($_REQUEST['txtPermanentCity']):null;
$permanentPostalCode           = isset($_REQUEST['txtPermanentPostalCode'])?trim($_REQUEST['txtPermanentPostalCode']):null;
$permanentTelephone           = isset($_REQUEST['txtPermanentTelephone'])?trim($_REQUEST['txtPermanentTelephone']):null;
$permanentMobileNo           = isset($_REQUEST['txtPermanentMobileNo'])?trim($_REQUEST['txtPermanentMobileNo']):null;
$permanentEmail           = isset($_REQUEST['txtPermanentEmail'])?trim($_REQUEST['txtPermanentEmail']):null;
$permanentCountryId           = isset($_REQUEST['cboPermanentCountryId'])?trim($_REQUEST['cboPermanentCountryId']):null;
$permanentProvinceId           = isset($_REQUEST['cboPermanentProvinceId'])?trim($_REQUEST['cboPermanentProvinceId']):null;
$permanentDistrictId           = isset($_REQUEST['cboPermanentDistrictId'])?trim($_REQUEST['cboPermanentDistrictId']):null;
$permanentDsDivisionId           = isset($_REQUEST['cboPermanentDsDivisionId'])?trim($_REQUEST['cboPermanentDsDivisionId']):null;
$permanentElectorate           = isset($_REQUEST['txtPermanentElectorate'])?trim($_REQUEST['txtPermanentElectorate']):null;
$currentAddress           = isset($_REQUEST['txtCurrentAddress'])?trim($_REQUEST['txtCurrentAddress']):null;
$currentStreet           = isset($_REQUEST['txtCurrentStreet'])?trim($_REQUEST['txtCurrentStreet']):null;
$currentCity           = isset($_REQUEST['txtCurrentCity'])?trim($_REQUEST['txtCurrentCity']):null;
$currentPostalCode           = isset($_REQUEST['txtCurrentPostalCode'])?trim($_REQUEST['txtCurrentPostalCode']):null;
$currentTelephoneGeneralLine           = isset($_REQUEST['txtCurrentTelephoneGeneralLine'])?trim($_REQUEST['txtCurrentTelephoneGeneralLine']):null;
$currentTelephoneDirectLine           = isset($_REQUEST['txtCurrentTelephoneDirectLine'])?trim($_REQUEST['txtCurrentTelephoneDirectLine']):null;
$currentMobileNo           = isset($_REQUEST['txtCurrentMobileNo'])?trim($_REQUEST['txtCurrentMobileNo']):null;
$currentFax           = isset($_REQUEST['txtCurrentFax'])?trim($_REQUEST['txtCurrentFax']):null;
$currentEmail           = isset($_REQUEST['txtCurrentEmail'])?trim($_REQUEST['txtCurrentEmail']):null;
$currentCountryId           = isset($_REQUEST['cboCurrentCountryId'])?trim($_REQUEST['cboCurrentCountryId']):null;
$currentProvinceId           = isset($_REQUEST['cboCurrentProvinceId'])?trim($_REQUEST['cboCurrentProvinceId']):null;
$currentDistrictId           = isset($_REQUEST['cboCurrentDistrictId'])?trim($_REQUEST['cboCurrentDistrictId']):null;
$currentDsDivisionId           = isset($_REQUEST['cboCurrentDsDivisionId'])?trim($_REQUEST['cboCurrentDsDivisionId']):null;
$currentElectorate           = isset($_REQUEST['txtCurrentElectorate'])?trim($_REQUEST['txtCurrentElectorate']):null;
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
    $sql="insert into `hrm_employee_residential`
            (emr_id, emr_permanent_address, emr_permanent_street, emr_permanent_city, emr_permanent_postal_code, emr_permanent_telephone, emr_permanent_mobile_no, emr_permanent_email, emr_permanent_country_id, emr_permanent_province_id, emr_permanent_district_id, emr_permanent_ds_division_id, emr_permanent_electorate, emr_current_address, emr_current_street, emr_current_city, emr_current_postal_code, emr_current_telephone_general_line, emr_current_telephone_direct_line, emr_current_mobile_no, emr_current_fax, emr_current_email, emr_current_country_id, emr_current_province_id, emr_current_district_id, emr_current_ds_division_id, emr_current_electorate, emr_remarks, emr_status, emr_company_id, emr_created_by, emr_created_on)
              values 
                ('$id', '$permanentAddress', '$permanentStreet', '$permanentCity', '$permanentPostalCode', '$permanentTelephone', '$permanentMobileNo', '$permanentEmail', '$permanentCountryId', '$permanentProvinceId', '$permanentDistrictId', '$permanentDsDivisionId', '$permanentElectorate', '$currentAddress', '$currentStreet', '$currentCity', '$currentPostalCode', '$currentTelephoneGeneralLine', '$currentTelephoneDirectLine', '$currentMobileNo', '$currentFax', '$currentEmail', '$currentCountryId', '$currentProvinceId', '$currentDistrictId', '$currentDsDivisionId', '$currentElectorate', '$remarks', '$status', '$companyId', '$createdBy', '". time()."')";
                
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
    $sql = "select * from hrm_employee_residential where emr_id='$id' and emr_company_id='$userCompanyId'";
    $result = $db->batchQuery($sql);
    if($row = mysqli_fetch_row($result)){
      //Update data to transaction header*******************************************
      $sql="update `hrm_employee_residential`
            set
              emr_id='$id',
              emr_permanent_address='$permanentAddress',
              emr_permanent_street='$permanentStreet',
              emr_permanent_city='$permanentCity',
              emr_permanent_postal_code='$permanentPostalCode',
              emr_permanent_telephone='$permanentTelephone',
              emr_permanent_mobile_no='$permanentMobileNo',
              emr_permanent_email='$permanentEmail',
              emr_permanent_country_id='$permanentCountryId',
              emr_permanent_province_id='$permanentProvinceId',
              emr_permanent_district_id='$permanentDistrictId',
              emr_permanent_ds_division_id='$permanentDsDivisionId',
              emr_permanent_electorate='$permanentElectorate',
              emr_current_address='$currentAddress',
              emr_current_street='$currentStreet',
              emr_current_city='$currentCity',
              emr_current_postal_code='$currentPostalCode',
              emr_current_telephone_general_line='$currentTelephoneGeneralLine',
              emr_current_telephone_direct_line='$currentTelephoneDirectLine',
              emr_current_mobile_no='$currentMobileNo',
              emr_current_fax='$currentFax',
              emr_current_email='$currentEmail',
              emr_current_country_id='$currentCountryId',
              emr_current_province_id='$currentProvinceId',
              emr_current_district_id='$currentDistrictId',
              emr_current_ds_division_id='$currentDsDivisionId',
              emr_current_electorate='$currentElectorate',
              emr_remarks='$remarks',
              emr_status='$status',
              emr_company_id='$companyId',
              emr_last_modified_by='$lastModifiedBy',
              emr_last_modified_on='". time()."'
            where emr_id='$id' and emr_company_id='$userCompanyId'";

    }
    else{
      //Add data to transaction header*******************************************
      $sql="insert into `hrm_employee_residential`
              (emr_id, emr_permanent_address, emr_permanent_street, emr_permanent_city, emr_permanent_postal_code, emr_permanent_telephone, emr_permanent_mobile_no, emr_permanent_email, emr_permanent_country_id, emr_permanent_province_id, emr_permanent_district_id, emr_permanent_ds_division_id, emr_permanent_electorate, emr_current_address, emr_current_street, emr_current_city, emr_current_postal_code, emr_current_telephone_general_line, emr_current_telephone_direct_line, emr_current_mobile_no, emr_current_fax, emr_current_email, emr_current_country_id, emr_current_province_id, emr_current_district_id, emr_current_ds_division_id, emr_current_electorate, emr_remarks, emr_status, emr_company_id, emr_created_by, emr_created_on)
                values 
                  ('$id', '$permanentAddress', '$permanentStreet', '$permanentCity', '$permanentPostalCode', '$permanentTelephone', '$permanentMobileNo', '$permanentEmail', '$permanentCountryId', '$permanentProvinceId', '$permanentDistrictId', '$permanentDsDivisionId', '$permanentElectorate', '$currentAddress', '$currentStreet', '$currentCity', '$currentPostalCode', '$currentTelephoneGeneralLine', '$currentTelephoneDirectLine', '$currentMobileNo', '$currentFax', '$currentEmail', '$currentCountryId', '$currentProvinceId', '$currentDistrictId', '$currentDsDivisionId', '$currentElectorate', '$remarks', '$status', '$companyId', '$createdBy', '". time()."')";

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
    
    $sql="update `hrm_employee_residential`
          set
            emr_is_deleted = '1',
            emr_deleted_on = '". time()."',
            emr_deleted_by = '$userId'
          where emr_id='$id' and emr_company_id='$userCompanyId'";
                
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





