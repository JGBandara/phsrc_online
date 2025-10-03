
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
use presentation\system\masterData\classes\cls_sys_companies;

$model = new cls_sys_companies($db);

$response = [];
$autoNoType = "company";   
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//--------------------------------------------
$code           = isset($_REQUEST['txtCode'])?trim($_REQUEST['txtCode']):null;
$name           = isset($_REQUEST['txtName'])?trim($_REQUEST['txtName']):null;
$countryId           = isset($_REQUEST['cboCountryId'])?trim($_REQUEST['cboCountryId']):null;
$webSite           = isset($_REQUEST['txtWebSite'])?trim($_REQUEST['txtWebSite']):null;
$remarks           = isset($_REQUEST['txtRemarks'])?trim($_REQUEST['txtRemarks']):null;
$accountNo           = isset($_REQUEST['txtAccountNo'])?trim($_REQUEST['txtAccountNo']):null;
$registrationNo           = isset($_REQUEST['txtRegistrationNo'])?trim($_REQUEST['txtRegistrationNo']):null;
$vatNo           = isset($_REQUEST['txtVatNo'])?trim($_REQUEST['txtVatNo']):null;
$svatNo           = isset($_REQUEST['txtSvatNo'])?trim($_REQUEST['txtSvatNo']):null;
$workingDayType           = isset($_REQUEST['txtWorkingDayType'])?trim($_REQUEST['txtWorkingDayType']):null;
$baseCurrencyId           = isset($_REQUEST['cboBaseCurrencyId'])?trim($_REQUEST['cboBaseCurrencyId']):null;
$taxApplicable           = isset($_REQUEST['optTaxApplicable'])?trim($_REQUEST['optTaxApplicable']):null;
$nopayConsider           = isset($_REQUEST['optNopayConsider'])?trim($_REQUEST['optNopayConsider']):null;
$menuOrder           = isset($_REQUEST['txtMenuOrder'])?trim($_REQUEST['txtMenuOrder']):null;
$status           = isset($_REQUEST['cboStatus'])?trim($_REQUEST['cboStatus']):null;
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
//      $noReference	= $clsAutoNo->encodeNo($autoNo,"Co");
    }
    elseif($amStatus == "Manual"){
      $noReference	= $no;
    }
        //Add data to transaction header*******************************************
    $sql="insert into `sys_companies`
            (syc_code, syc_name, syc_country_id, syc_web_site, syc_remarks, syc_account_no, syc_registration_no, syc_vat_no, syc_svat_no, syc_working_day_type, syc_base_currency_id, syc_tax_applicable, syc_nopay_consider, syc_menu_order, syc_status, syc_created_by, syc_created_on)
              values 
                ('$code', '$name', '$countryId', '$webSite', '$remarks', '$accountNo', '$registrationNo', '$vatNo', '$svatNo', '$workingDayType', '$baseCurrencyId', '$taxApplicable', '$nopayConsider', '$menuOrder', '$status', '$createdBy', '". time()."')";
                
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
    $sql="update `sys_companies`
          set
            syc_code='$code',
            syc_name='$name',
            syc_country_id='$countryId',
            syc_web_site='$webSite',
            syc_remarks='$remarks',
            syc_account_no='$accountNo',
            syc_registration_no='$registrationNo',
            syc_vat_no='$vatNo',
            syc_svat_no='$svatNo',
            syc_working_day_type='$workingDayType',
            syc_base_currency_id='$baseCurrencyId',
            syc_tax_applicable='$taxApplicable',
            syc_nopay_consider='$nopayConsider',
            syc_menu_order='$menuOrder',
            syc_status='$status',
            syc_last_modified_by='$lastModifiedBy',
            syc_last_modified_on='". time()."'
          where syc_id='$id' ";
                
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
    
    $sql="update `sys_companies`
          set
            syc_is_deleted = '1',
            syc_deleted_on = '". time()."',
            syc_deleted_by = '$userId'
          where syc_id='$id' ";
                
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





