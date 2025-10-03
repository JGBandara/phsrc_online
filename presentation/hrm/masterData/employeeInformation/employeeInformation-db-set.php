
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

include "{$backwardSeparator}dataAccess/serverAccessController.php";
include "{$backwardSeparator}vendor/php-image-resize-master/lib/ImageResize.php";

//require_once $backwardSeparator.'dataAccess/connector.php';

use classes\cls_auto_number;
use classes\cls_approval;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;

$model = new cls_hrm_employee_information($db);

$response = [];
$autoNoType = "employeeInformation";   
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//--------------------------------------------
$no           = isset($_REQUEST['txtNo'])?trim($_REQUEST['txtNo']):null;
$callingName           = isset($_REQUEST['txtCallingName'])?trim($_REQUEST['txtCallingName']):null;
$epfNo           = isset($_REQUEST['txtEpfNo'])?trim($_REQUEST['txtEpfNo']):null;
$fingerPrintNo           = isset($_REQUEST['txtFingerPrintNo'])?trim($_REQUEST['txtFingerPrintNo']):null;
$joinedDate           = isset($_REQUEST['dtpJoinedDate'])?trim($_REQUEST['dtpJoinedDate']):null;
$permanentDate           = isset($_REQUEST['dtpPermanentDate'])?trim($_REQUEST['dtpPermanentDate']):null;
$confirmDate           = isset($_REQUEST['dtpConfirmDate'])?trim($_REQUEST['dtpConfirmDate']):null;
$confirmStatus           = isset($_REQUEST['optConfirmStatus'])?trim($_REQUEST['optConfirmStatus']):null;
$medicalStatus           = isset($_REQUEST['optMedicalStatus'])?trim($_REQUEST['optMedicalStatus']):null;
$resignedDate           = isset($_REQUEST['dtpResignedDate'])?trim($_REQUEST['dtpResignedDate']):null;
$retirementDate           = isset($_REQUEST['dtpRetirementDate'])?trim($_REQUEST['dtpRetirementDate']):null;
$imageName           = isset($_REQUEST['txtImageName'])?trim($_REQUEST['txtImageName']):null;
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
    $sql="insert into `hrm_employee_information`
            (emi_no, emi_calling_name, emi_epf_no, emi_finger_print_no, emi_joined_date, emi_permanent_date, emi_confirm_date, emi_confirm_status, emi_medical_status, emi_resigned_date, emi_retirement_date, emi_image_name, emi_remarks, emi_status, emi_company_id, emi_created_by, emi_created_on)
              values 
                ('$no', '$callingName', '$epfNo', '$fingerPrintNo', '$joinedDate', '$permanentDate', '$confirmDate', '$confirmStatus', '$medicalStatus', '$resignedDate', '$retirementDate', '$imageName', '$remarks', '$status', '$companyId', '$createdBy', '". time()."')";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $db->insertId;           
    
    // Upload Image
    if($_FILES['fileProfileImage']['size'] <> 0)
	{
		$uploadPath = $_FILES['fileProfileImage']['name'];
        $newImgName = saveFile($_FILES['fileProfileImage'], $entryId);
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
    $sql="update `hrm_employee_information`
          set
            emi_no='$no',
            emi_calling_name='$callingName',
            emi_epf_no='$epfNo',
            emi_finger_print_no='$fingerPrintNo',
            emi_joined_date='$joinedDate',
            emi_permanent_date='$permanentDate',
            emi_confirm_date='$confirmDate',
            emi_confirm_status='$confirmStatus',
            emi_medical_status='$medicalStatus',
            emi_resigned_date='$resignedDate',
            emi_retirement_date='$retirementDate',
            emi_image_name='$imageName',
            emi_remarks='$remarks',
            emi_status='$status',
            emi_company_id='$companyId',
            emi_last_modified_by='$lastModifiedBy',
            emi_last_modified_on='". time()."'
          where emi_id='$id' and emi_company_id='$userCompanyId'";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;           
    // Upload Image
    if($_FILES['fileProfileImage']['size'] <> 0)
	{
		$uploadPath = $_FILES['fileProfileImage']['name'];
        $newImgName = saveFile($_FILES['fileProfileImage'], $entryId);
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
    
    $sql="update `hrm_employee_information`
          set
            emi_is_deleted = '1',
            emi_deleted_on = '". time()."',
            emi_deleted_by = '$userId'
          where emi_id='$id' and emi_company_id='$userCompanyId'";
                
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
function saveFile($file,$id){
  global $db;
  global $backwardSeparator;
  global $finalResult;
  $size =  $file["size"] / 1028 / 1028;
  $fType = $file["type"];
  $imgName  = basename($file['name']);
  $ext = pathinfo($imgName, PATHINFO_EXTENSION);
  $newImgName       = $id.'.'.$ext;
  if ($size <=10 && ($fType == "image/gif" || $fType == "image/jpeg" || $fType == "image/jpg" || $fType == "image/pjpeg" || $fType == "image/x-png" || $fType == "image/png")){
    if ($file["error"] > 0){
      throw new Exception('File Upload Error.');
    }
    else{
      $target1 = $backwardSeparator."img/profile/" . $newImgName;
      $target2 = $backwardSeparator."img/profile/40/" . $newImgName;
      $target3 = $backwardSeparator."img/profile/32/" . $newImgName;
      move_uploaded_file($file["tmp_name"],$target1);
      // Resize Image
      $image = new Gumlet\ImageResize($target1);
      //$image->scale(10);
      $image->resizeToShortSide(256,true);
      $image->crop(256, 256);
      $image->save($target1);
      $image->resizeToShortSide(40);
      $image->crop(40, 40);
      $image->save($target2);
      $image->resizeToShortSide(32);
      $image->crop(32, 32);
      $image->save($target3);

      // save Image Name in DB
      $sql = "update `hrm_employee_information`
          set
            emi_image_name='$newImgName'
          where emi_id='$id'";
      $finalResult = $finalResult && $db->batchQuery($sql);
    }
  }
  else{
    throw new Exception('Invalid File Type or Size.');
  }
  return $newImgName;
}
?>





