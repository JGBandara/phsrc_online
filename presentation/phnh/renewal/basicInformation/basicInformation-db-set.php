<?php

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

$response = [];
//$autoNoType = "employeeInformation";   
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//--------------------------------------------
$txtName           = isset($_REQUEST['txtName'])?trim($_REQUEST['txtName']):null;
$txtRelIns         = isset($_REQUEST['txtRelIns'])?trim($_REQUEST['txtRelIns']):null;
$txtAddress           = isset($_REQUEST['txtAddress'])?trim($_REQUEST['txtAddress']):null;
$txtInsName           = isset($_REQUEST['txtInsName'])?trim($_REQUEST['txtInsName']):null;
$txtInsAddress           = isset($_REQUEST['txtInsAddress'])?trim($_REQUEST['txtInsAddress']):null;
$cboProvince           = $_REQUEST['cboProvince'];
$cboDistrict           = $_REQUEST['cboDistrict'];

$companyId           = isset($userCompanyId)?$userCompanyId:null;
$createdBy           = isset($userId)?$userId:null;
$lastModifiedBy           = isset($userId)?$userId:null;
$deletedBy           = isset($userId)?$userId:null;
//$details = json_decode($_REQUEST['detailList'], true);

if($requestType=='edit'){
  try{
    $db->begin();  
    if(!$intEditx){
      throw new exception('Permission is Denied ...');
    }
        //Update data to transaction header*******************************************
    $sql="update `institute_registration`
          set
            ins_owner_name='$txtName',
			ins_owner_relationship='$txtRelIns',
			ins_owner_address='$txtAddress',
			ins_institute_name='$txtInsName',
			ins_institute_address='$txtInsAddress',
			ins_province_id='$cboProvince',
			ins_district_id='$cboDistrict',
            ins_company_id='$companyId',
            ins_last_modified_by='$lastModifiedBy',
            ins_last_modified_on='". time()."'
          where ins_application_id='$id'";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;           
    // Upload Image
    /*if($_FILES['fileProfileImage']['size'] <> 0)
	{
		$uploadPath = $_FILES['fileProfileImage']['name'];
        $newImgName = saveFile($_FILES['fileProfileImage'], $entryId);
	}*/
    
    // ============================   Approval Entry    ================
//    $clsApprove = new cls_approval($db, $userCompanyId, $userLocationId, $userId);
//    $clsApprove->newApprovalEntry($autoNoType, $entryId, $noReference, true);
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Basic Information saved successfully! Proceed to Staff Information...';
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





