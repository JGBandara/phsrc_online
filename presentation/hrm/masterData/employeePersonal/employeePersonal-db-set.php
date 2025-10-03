
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-08
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
use presentation\hrm\masterData\classes\cls_hrm_employee_personal;

$model = new cls_hrm_employee_personal($db);

$response = [];
$autoNoType = "employeePersonal";   
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//--------------------------------------------
$initials           = isset($_REQUEST['txtInitials'])?trim($_REQUEST['txtInitials']):null;
$middleName           = isset($_REQUEST['txtMiddleName'])?trim($_REQUEST['txtMiddleName']):null;
$surname           = isset($_REQUEST['txtSurname'])?trim($_REQUEST['txtSurname']):null;
$nameDenotedByInitials  = isset($_REQUEST['txtNameDenotedByInitials'])?trim($_REQUEST['txtNameDenotedByInitials']):null;
$fullName           = isset($_REQUEST['txtFullName'])?trim($_REQUEST['txtFullName']):null;
$otherName           = isset($_REQUEST['txtOtherName'])?trim($_REQUEST['txtOtherName']):null;
$nicNo           = isset($_REQUEST['txtNicNo'])?trim($_REQUEST['txtNicNo']):null;
$nicIssueDate           = isset($_REQUEST['dtpNicIssueDate'])?trim($_REQUEST['dtpNicIssueDate']):null;
$nationality           = isset($_REQUEST['txtNationality'])?trim($_REQUEST['txtNationality']):null;
$race           = isset($_REQUEST['txtRace'])?trim($_REQUEST['txtRace']):null;
$religion           = isset($_REQUEST['txtReligion'])?trim($_REQUEST['txtReligion']):null;
$gender           = isset($_REQUEST['optGender'])?trim($_REQUEST['optGender']):null;
$dateOfBirth           = isset($_REQUEST['dtpDateOfBirth'])?trim($_REQUEST['dtpDateOfBirth']):null;
$bloodGroup           = isset($_REQUEST['txtBloodGroup'])?trim($_REQUEST['txtBloodGroup']):null;
$maritialStatusId           = isset($_REQUEST['optMaritialStatusId'])?trim($_REQUEST['optMaritialStatusId']):null;
$marriedDate           = isset($_REQUEST['dtpMarriedDate'])?trim($_REQUEST['dtpMarriedDate']):null;
$passportNo           = isset($_REQUEST['txtPassportNo'])?trim($_REQUEST['txtPassportNo']):null;
$passportType           = isset($_REQUEST['optPassportType'])?trim($_REQUEST['optPassportType']):null;
$passportIssueDate           = isset($_REQUEST['dtpPassportIssueDate'])?trim($_REQUEST['dtpPassportIssueDate']):null;
$passportIssuePlace           = isset($_REQUEST['txtPassportIssuePlace'])?trim($_REQUEST['txtPassportIssuePlace']):null;
$passportExpiryDate           = isset($_REQUEST['dtpPassportExpiryDate'])?trim($_REQUEST['dtpPassportExpiryDate']):null;
$passportCountries           = isset($_REQUEST['txtPassportCountries'])?trim($_REQUEST['txtPassportCountries']):null;
$drivingLicenseNo           = isset($_REQUEST['txtDrivingLicenseNo'])?trim($_REQUEST['txtDrivingLicenseNo']):null;
$drivingLicenseIssueDate    = isset($_REQUEST['dtpDrivingLicenseIssueDate'])?trim($_REQUEST['dtpDrivingLicenseIssueDate']):null;
$drivingLicenseExpiryDate   = isset($_REQUEST['dtpDrivingLicenseExpiryDate'])?trim($_REQUEST['dtpDrivingLicenseExpiryDate']):null;
$drivingLicenseVehicleClass = isset($_REQUEST['txtDrivingLicenseVehicleClass'])?trim($_REQUEST['txtDrivingLicenseVehicleClass']):null;
$remarks           = isset($_REQUEST['txtRemarks'])?trim($_REQUEST['txtRemarks']):null;
$status           = isset($_REQUEST['cboStatus'])?trim($_REQUEST['cboStatus']):null;
$companyId           = isset($userCompanyId)?$userCompanyId:null;
$createdBy           = isset($userId)?$userId:null;
$lastModifiedBy      = isset($userId)?$userId:null;
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
    $sql="insert into `hrm_employee_personal`
            (emp_id, emp_initials, emp_middle_name, emp_surname, emp_name_denoted_by_initials, emp_full_name, emp_other_name, emp_nic_no, emp_nic_issue_date, emp_nationality, emp_race, emp_religion, emp_gender, emp_date_of_birth, emp_blood_group, emp_maritial_status_id, emp_married_date, emp_passport_no, emp_passport_type, emp_passport_issue_date, emp_passport_issue_place, emp_passport_expiry_date, emp_passport_countries, emp_driving_license_no, emp_driving_license_issue_date, emp_driving_license_expiry_date, emp_driving_license_vehicle_class, emp_remarks, emp_status, emp_company_id, emp_created_by, emp_created_on)
              values 
                ('$id', '$initials', '$middleName', '$surname', '$nameDenotedByInitials', '$fullName', '$otherName', '$nicNo', '$nicIssueDate', '$nationality', '$race', '$religion', '$gender', '$dateOfBirth', '$bloodGroup', '$maritialStatusId', '$marriedDate', '$passportNo', '$passportType', '$passportIssueDate', '$passportIssuePlace', '$passportExpiryDate', '$passportCountries', '$drivingLicenseNo', '$drivingLicenseIssueDate', '$drivingLicenseExpiryDate', '$drivingLicenseVehicleClass', '$remarks', '$status', '$companyId', '$createdBy', '". time()."')";
                
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
    $sql = "select * from hrm_employee_personal where emp_id='$id' and emp_company_id='$userCompanyId'";
    $result = $db->batchQuery($sql);
    if($row = mysqli_fetch_row($result)){
      //Update data to transaction header*******************************************
      $sql="update `hrm_employee_personal`
            set
              emp_id='$id',
              emp_initials='$initials',
              emp_middle_name='$middleName',
              emp_surname='$surname',
              emp_name_denoted_by_initials='$nameDenotedByInitials',
              emp_full_name='$fullName',
              emp_other_name='$otherName',
              emp_nic_no='$nicNo',
              emp_nic_issue_date='$nicIssueDate',
              emp_nationality='$nationality',
              emp_race='$race',
              emp_religion='$religion',
              emp_gender='$gender',
              emp_date_of_birth='$dateOfBirth',
              emp_blood_group='$bloodGroup',
              emp_maritial_status_id='$maritialStatusId',
              emp_married_date='$marriedDate',
              emp_passport_no='$passportNo',
              emp_passport_type='$passportType',
              emp_passport_issue_date='$passportIssueDate',
              emp_passport_issue_place='$passportIssuePlace',
              emp_passport_expiry_date='$passportExpiryDate',
              emp_passport_countries='$passportCountries',
              emp_driving_license_no='$drivingLicenseNo',
              emp_driving_license_issue_date='$drivingLicenseIssueDate',
              emp_driving_license_expiry_date='$drivingLicenseExpiryDate',
              emp_driving_license_vehicle_class='$drivingLicenseVehicleClass',
              emp_remarks='$remarks',
              emp_status='$status',
              emp_company_id='$companyId',
              emp_last_modified_by='$lastModifiedBy',
              emp_last_modified_on='". time()."'
            where emp_id='$id' and emp_company_id='$userCompanyId'";
      
    }
    else{
      //Add data to transaction header*******************************************
      $sql="insert into `hrm_employee_personal`
            (emp_id, emp_initials, emp_middle_name, emp_surname, emp_name_denoted_by_initials, emp_full_name, emp_other_name, emp_nic_no, emp_nic_issue_date, emp_nationality, emp_race, emp_religion, emp_gender, emp_date_of_birth, emp_blood_group, emp_maritial_status_id, emp_married_date, emp_passport_no, emp_passport_type, emp_passport_issue_date, emp_passport_issue_place, emp_passport_expiry_date, emp_passport_countries, emp_driving_license_no, emp_driving_license_issue_date, emp_driving_license_expiry_date, emp_driving_license_vehicle_class, emp_remarks, emp_status, emp_company_id, emp_created_by, emp_created_on)
              values 
                ('$id', '$initials', '$middleName', '$surname', '$nameDenotedByInitials', '$fullName', '$otherName', '$nicNo', '$nicIssueDate', '$nationality', '$race', '$religion', '$gender', '$dateOfBirth', '$bloodGroup', '$maritialStatusId', '$marriedDate', '$passportNo', '$passportType', '$passportIssueDate', '$passportIssuePlace', '$passportExpiryDate', '$passportCountries', '$drivingLicenseNo', '$drivingLicenseIssueDate', '$drivingLicenseExpiryDate', '$drivingLicenseVehicleClass', '$remarks', '$status', '$companyId', '$createdBy', '". time()."')";   
      
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
    
    $sql="update `hrm_employee_personal`
          set
            emp_is_deleted = '1',
            emp_deleted_on = '". time()."',
            emp_deleted_by = '$userId'
          where emp_id='$id' and emp_company_id='$userCompanyId'";
                
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





