
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

//include  "{$backwardSeparator}dataAccess/serverAccessController.php";
require_once $backwardSeparator.'dataAccess/connector.php';

use classes\cls_auto_number;
use classes\cls_approval;
use presentation\system\masterData\classes\cls_sys_users;

$model = new cls_sys_users($db);

$response = [];
$autoNoType = "user";   
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//--------------------------------------------
$userName           = isset($_REQUEST['txtUserName'])?trim($_REQUEST['txtUserName']):null;
$password           = isset($_REQUEST['txtPassword'])?trim($_REQUEST['txtPassword']):null;
$currentPassword    = isset($_REQUEST['txtCurrentPassword'])?trim($_REQUEST['txtCurrentPassword']):null;
$fullName           = isset($_REQUEST['txtFullName'])?trim($_REQUEST['txtFullName']):null;
$divisionId           = isset($_REQUEST['cboDivisionId'])?trim($_REQUEST['cboDivisionId']):null;
$contactNo           = isset($_REQUEST['txtContactNo'])?trim($_REQUEST['txtContactNo']):null;
$designationId           = isset($_REQUEST['cboDesignationId'])?trim($_REQUEST['cboDesignationId']):null;
$gender           = isset($_REQUEST['txtGender'])?trim($_REQUEST['txtGender']):null;
$email           = isset($_REQUEST['txtEmail'])?trim($_REQUEST['txtEmail']):null;
$resetPasswordTime           = isset($_REQUEST['txtResetPasswordTime'])?trim($_REQUEST['txtResetPasswordTime']):null;
$employeeId           = isset($_REQUEST['cboEmployeeId'])?trim($_REQUEST['cboEmployeeId']):null;
$remarks           = isset($_REQUEST['txtRemarks'])?trim($_REQUEST['txtRemarks']):null;
$status           = isset($_REQUEST['cboStatus'])?trim($_REQUEST['cboStatus']):null;
$companyId           = isset($userCompanyId)?$userCompanyId:null;
$createdBy           = isset($userId)?$userId:null;
$lastModifiedBy           = isset($userId)?$userId:null;
$deletedBy           = isset($userId)?$userId:null;

if($requestType=='add'){
  try{
    $db->begin();      
    if(!$intAddx){
      throw new exception('Permission is Denied ...');
    }
    if($anStatus == "Auto"){
    }
    elseif($amStatus == "Manual"){
      $noReference	= $no;
    }
    $sql="insert into `sys_users`
            (syu_user_name, syu_password, syu_full_name, syu_division_id, syu_contact_no, syu_designation_id, syu_gender, syu_email, syu_reset_password_time, syu_employee_id, syu_remarks, syu_status, syu_company_id, syu_created_by, syu_created_on)
              values 
                ('$userName', '".md5(md5($password))."', '$fullName', '$divisionId', '$contactNo', '$designationId', '$gender', '$email', '$resetPasswordTime', '$employeeId', '$remarks', '$status', '$companyId', '$createdBy', '". time()."')";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $db->insertId;           
    

    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $response['no'] 	= $noReference; 
        $response['id'] 	= $entryId;
        $db->commit();
    }
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
        $db->rollback();
    }
            
  }catch(Exception $e){

    $db->rollback();

    $response['type'] 		= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 			= $sql;                
  }
  
} 
elseif($requestType=='edit'){
  try{
    $db->begin();  
    if(!$intEditx){
      throw new exception('Permission is Denied ...');
    }
    $sql="update `sys_users`
          set
            syu_user_name='$userName',
            syu_full_name='$fullName',
            syu_division_id='$divisionId',
            syu_contact_no='$contactNo',
            syu_designation_id='$designationId',
            syu_gender='$gender',
            syu_email='$email',
            syu_reset_password_time='$resetPasswordTime',
            syu_employee_id='$employeeId',
            syu_remarks='$remarks',
            syu_status='$status',
            syu_company_id='$companyId',
            syu_last_modified_by='$lastModifiedBy',
            syu_last_modified_on='". time()."'
          where syu_id='$id' and syu_company_id='$userCompanyId'";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;           
    

    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $response['no'] 	= $noReference; 
        $response['id'] 	= $entryId;
        $db->commit();
    }
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
        $db->rollback();
    }
            
  }catch(Exception $e){

    $db->rollback();

    $response['type'] 		= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 			= $sql;                
  }
  
}
elseif($requestType=='delete'){
  try{
    $db->begin();      
    if(!$intDeletex){
      throw new exception('Permission is Denied ...');
    }
    
    $sql="update `sys_users`
          set
            syu_is_deleted = '1',
            syu_deleted_on = '". time()."',
            syu_deleted_by = '$userId'
          where syu_id='$id' and syu_company_id='$userCompanyId'";
                
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
        $db->rollback();
    }
            
  }catch(Exception $e){

    $db->rollback();

    $response['type'] 	= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 		= $sql;                
  }
  
} 
elseif($requestType=='passwordReset'){
  try{
    $db->begin(); 
    $sql="update `sys_users`
          set
            syu_password='".md5(md5($password))."',
            syu_last_modified_by='$lastModifiedBy',
            syu_last_modified_on='". time()."'
          where syu_id='$id' and syu_company_id='$userCompanyId'";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;           
 
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $response['no'] 	= $noReference; 
        $response['id'] 	= $entryId;
        $response['password'] 	= $password;
        $db->commit();
    }
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
        $db->rollback();
    }
            
  }catch(Exception $e){

    $db->rollback();

    $response['type'] 		= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 			= $sql;                
  }
  
}
elseif($requestType=='passwordChange'){
  try{
    $db->begin();  
    $finalResult = true;
    $sql = "select syu_id, syu_user_name, syu_password, syu_status, syu_email, syu_full_name, syu_company_id, syu_employee_id
            from sys_users u
            where syu_id =  '$id' and syu_password = '".md5(md5($currentPassword))."'
            limit 1";
    $result = $db->batchQuery($sql);
    if($row = mysqli_fetch_assoc($result)){
      $sql="update `sys_users`
            set
              syu_password='".md5(md5($password))."',
              syu_last_modified_by='$lastModifiedBy',
              syu_last_modified_on='". time()."'
            where syu_id='$id' and syu_company_id='$userCompanyId'";

      $finalResult = $db->batchQuery($sql);
    }
    else{
      throw new exception('Invalid Password ...');
    }

    $entryId = $id;           
    
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $response['no'] 	= $noReference; 
        $response['id'] 	= $entryId;
        $response['password'] 	= $password;
        $db->commit();
    }
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
        $db->rollback();
    }
            
  }catch(Exception $e){

    $db->rollback();

    $response['type'] 		= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 			= $sql;                
  }
}

echo json_encode($response);    
?>





