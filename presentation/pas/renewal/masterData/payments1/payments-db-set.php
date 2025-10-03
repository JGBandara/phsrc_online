
<?php
session_start();
$backwardSeparator = "../../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

include "{$backwardSeparator}dataAccess/serverAccessController.php";
include "{$backwardSeparator}vendor/php-image-resize-master/lib/ImageResize.php";

$response = [];
 
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
$sql = "select ins_application_id from institute_registration where institute_reg_id='$id' ";
    $result = $db->singleQuery($sql);
    while($row=  mysqli_fetch_array($result)){
        $insId=$row['ins_application_id'];
    }
$_SESSION['insId']=$insId;
//--------------------------------------------
$paymentType           = isset($_REQUEST['cboPayType'])?trim($_REQUEST['cboPayType']):null;
$txtYear         = isset($_REQUEST['txtYear'])?trim($_REQUEST['txtYear']):null;
$_SESSION['regYear']=$txtYear;
$txtRegFee         = isset($_REQUEST['txtRegFee'])?trim($_REQUEST['txtRegFee']):null;
$txtStampFee           = isset($_REQUEST['txtStampFee'])?trim($_REQUEST['txtStampFee']):null;
$txtArrears           = isset($_REQUEST['txtArrears'])?trim($_REQUEST['txtArrears']):null;
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
        $id=$row['ins_application_id'];
    }
    $sql = "select * from institute_payment_detail where payment_detail_institute_id='$id' and payment_detail_company_id='$userCompanyId'";
    $result = $db->batchQuery($sql);
    if($row = mysqli_fetch_row($result)){
      //Update data to transaction header*******************************************
      $sql="update `institute_payment_detail`
            set
					payment_reg_year	='$txtYear',
					payment_reg_fee		='$txtRegFee',
					payment_stamp_fee   ='$txtStampFee',
					payment_amount      ='$txtAmount',
                                        payment_arrears     ='$txtArrears',
					payment_date     	='$txtPaymentDate',
					payment_branch      ='$txtPaymentBranch',
					payment_type		='$paymentType',
          is_renew='1'
            where payment_detail_institute_id='$id' and payment_detail_company_id='$userCompanyId'";

    }
    else{
		//payment_reg_type_id=1(New Registration)
      //Add data to transaction header*******************************************
      $sql="insert into `institute_payment_detail`
            ( payment_detail_institute_id,payment_reg_year,payment_reg_fee,payment_stamp_fee,payment_amount,payment_arrears,payment_date,payment_branch,payment_type,payment_reg_type_id, payment_detail_company_id, payment_detail_created_by, payment_detail_created_on,is_renew)
              values 
                ('$id','$txtYear','$txtRegFee','$txtStampFee','$txtAmount','$txtArrears','$txtPaymentDate','$txtPaymentBranch','$paymentType','1','$userCompanyId', '$userCompanyId', now(),'1')";

    }
    
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;   
	
     // Upload Image
    if($_FILES['fileProfileImage']['size'] <> 0)
	{
		$uploadPath = $_FILES['fileProfileImage']['name'];
        $newImgName = saveFile($txtYear,$_FILES['fileProfileImage'], $entryId);
	}
    // ============================   Approval Entry    ================
//    $clsApprove = new cls_approval($db, $userCompanyId, $userLocationId, $userId);
//    $clsApprove->newApprovalEntry($autoNoType, $entryId, $noReference, true);
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Your application has been submitted successfully.';
        $response['no'] 	= $noReference; 
        $response['id'] 	= $entryId;
		$response['payType']= $paymentType;
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
        $response['msg'] 	= 'Your application has been deleted successfully.';
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
function saveFile($txtYear,$file,$id){
  global $db;
  global $backwardSeparator;
  global $finalResult;
  $size =  $file["size"] / 1028 / 1028;
  $fType = $file["type"];
  $imgName  = basename($file['name']);
  $ext = pathinfo($imgName, PATHINFO_EXTENSION);
  $newImgName       = $txtYear.'-'.$id.'.'.$ext;
//$newImgName=$imgName;
  if ($size <=10 && ($fType == "image/gif" || $fType == "image/jpeg" || $fType == "image/jpg" || $fType == "image/pjpeg" || $fType == "image/x-png" || $fType == "image/png")){
    if ($file["error"] > 0){
      throw new Exception('File Upload Error.');
    }
    else{
      $target1 = $backwardSeparator."img/BankSlip/". $newImgName;
      $target2 = $backwardSeparator."img/BankSlip/fpds/40/" . $newImgName;
      $target3 = $backwardSeparator."img/BankSlip/fpds/32/" . $newImgName;
      move_uploaded_file($file["tmp_name"],$target1);
      // Resize Image
      $image = new Gumlet\ImageResize($target1);
      //$image->scale(10);
      

      // save Image Name in DB
      $sql = "update `institute_payment_detail`
          set
            payment_silp_name='$newImgName',
                paymet_is_success='1'
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





