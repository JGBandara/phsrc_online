
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
$txtAmount           = isset($_REQUEST['txtAmount'])?trim($_REQUEST['txtAmount']):null;
$txtPaymentDate         = isset($_REQUEST['txtPaymentDate'])?trim($_REQUEST['txtPaymentDate']):null;
$txtPaymentBranch           = isset($_REQUEST['txtPaymentBranch'])?trim($_REQUEST['txtPaymentBranch']):null;

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
    $sql = "select * from fpdm_payment_detail where payment_detail_institute_id='$id' ";
    $result = $db->batchQuery($sql);
    if($row = mysqli_fetch_row($result)){
      //Update data to transaction header*******************************************
      $sql="update `fpdm_payment_detail`
            set
					payment_amount      ='$txtAmount',
					payment_date     	='$txtPaymentDate',
					payment_branch      ='$txtPaymentBranch',
					payment_type		='Bank'
            where payment_detail_institute_id='$id' ";

    }
    else{
      //Add data to transaction header*******************************************
      $sql="insert into `fpdm_payment_detail`
            ( payment_detail_institute_id,payment_amount,payment_date,payment_branch,payment_type,payment_info_status,payment_detail_company_id, payment_detail_created_by, payment_detail_created_on)
              values 
                ('$id','$txtAmount','$txtPaymentDate','$txtPaymentBranch','Bank','1', '$companyId', '$createdBy', now())";

    }
    
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;   
	
    
    // ============================   Approval Entry    ================
//    $clsApprove = new cls_approval($db, $userCompanyId, $userLocationId, $userId);
//    $clsApprove->newApprovalEntry($autoNoType, $entryId, $noReference, true);
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
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
  
}  // End If - Update
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
                
    echo $finalResult = $db->batchQuery($sql);
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





