
<?php
session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";
require "{$backwardSeparator}classes/cls_reject.php";
include "{$backwardSeparator}dataAccess/serverAccessController.php";
include "{$backwardSeparator}vendor/php-image-resize-master/lib/ImageResize.php";
require "{$backwardSeperator}class/cls_alert.php";

$response = [];
 
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//--------------------------------------------
$paymentType           = isset($_REQUEST['cboPayType'])?trim($_REQUEST['cboPayType']):null;
$txtRegFee         = isset($_REQUEST['txtRegFee'])?trim($_REQUEST['txtRegFee']):null;
$txtStampFee           = isset($_REQUEST['txtStampFee'])?trim($_REQUEST['txtStampFee']):null;
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
     $sql = "select ins_application_id from institute_registration where institute_reg_id='$id' ";
    $result = $db->batchQuery($sql);
    while($row=  mysqli_fetch_array($result)){
        $referenceId=$row['ins_application_id'];
    }
    $sql = "select * from fpds_payment_detail where payment_detail_institute_id='$id' and payment_detail_company_id='$userCompanyId'";
    $result = $db->batchQuery($sql);
    if($row = mysqli_fetch_row($result)){
      //Update data to transaction header*******************************************
     $sql="update `fpds_payment_detail`
            set
					payment_reg_fee		='$txtRegFee',
					payment_stamp_fee   ='$txtStampFee',
					payment_amount      ='$txtAmount',
					payment_date     	='$txtPaymentDate',
					payment_branch      ='$txtPaymentBranch',
					payment_type		='$paymentType'
            where payment_detail_institute_id='$id' and payment_detail_company_id='$userCompanyId'";

    }
    else{
		//payment_reg_type_id=1(New Registration)
      //Add data to transaction header*******************************************
      $sql="insert into `fpds_payment_detail`
            ( payment_detail_institute_id,payment_reg_fee,payment_stamp_fee,payment_amount,payment_date,payment_branch,payment_type,payment_reg_type_id, payment_detail_company_id, payment_detail_created_by, payment_detail_created_on)
              values 
                ('$id','$txtRegFee','payment_stamp_fee','$txtAmount','$txtPaymentDate','$txtPaymentBranch','$paymentType','1','$userCompanyId', '$userCompanyId', now())";

    }
    
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;   
	
     // Upload Image
    if($_FILES['fileProfileImage']['size'] <> 0)
	{
		$uploadPath = $_FILES['fileProfileImage']['name'];
        $newImgName = saveFile($_FILES['fileProfileImage'], $entryId);
	}
	
	 $clsAlert = new cls_alert($db, $userCompanyId, $userLocationId, $userId);
          $clsAlert->referenceId = $entryId;
          $clsAlert->typeId = 13;
          $clsAlert->remarks = $remark;
          $clsAlert->notifyId = $officerSysId;
          $result =  $result && $clsAlert->newAlert();
	
	
    // $classApprove = new cls_reject($db, $userCompanyId, $userLocationId, $userId);
    // $classApprove->reject($referenceId);
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
//$newImgName=$imgName;
  if ($size <=10 && ($fType == "image/gif" || $fType == "image/jpeg" || $fType == "image/jpg" || $fType == "image/pjpeg" || $fType == "image/x-png" || $fType == "image/png")){
    if ($file["error"] > 0){
      throw new Exception('File Upload Error.');
    }
    else{
      $target1 = $backwardSeparator."img/BankSlip/fpds/" . $newImgName;
      $target2 = $backwardSeparator."img/BankSlip/fpds/40/" . $newImgName;
      $target3 = $backwardSeparator."img/BankSlip/fpds/32/" . $newImgName;
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
      $sql = "update `fpds_payment_detail`
          set
            payment_silp_name='$newImgName'
          where payment_detail_institute_id='$id'";
      $finalResult = $finalResult && $db->batchQuery($sql);
    }
  }
  else{
    throw new Exception('Invalid File Type or Size.');
  }
  return $newImgName;
}
?>





