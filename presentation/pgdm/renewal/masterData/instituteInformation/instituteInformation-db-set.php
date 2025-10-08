
<?php

session_start();
$backwardSeparator = "../../../../../";
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
$instituteId             = $_REQUEST['cboSearch'];
//--------------------------------------------

$txtEstDate           = isset($_REQUEST['txtEstDate'])?trim($_REQUEST['txtEstDate']):null;
$txtBR           = isset($_REQUEST['txtBR'])?trim($_REQUEST['txtBR']):null;
$txtBOI           = isset($_REQUEST['txtBOI'])?trim($_REQUEST['txtBOI']):null;
$checkGroup		=($_REQUEST['checkGroup']?1:0);
$checkIndividual		=($_REQUEST['checkIndividual']?1:0);
$txtInsOther		=isset($_REQUEST['txtInsOther'])?trim($_REQUEST['txtInsOther']):null;
$checkRecSystem		=($_REQUEST['checkRecSystem']?1:0);
$checkRecKeeping		=($_REQUEST['checkRecKeeping']?1:0);
$txtOwnOther		=isset($_REQUEST['txtOwnOther'])?trim($_REQUEST['txtOwnOther']):null;
$txtHrPractice           = isset($_REQUEST['txtHrPractice'])?trim($_REQUEST['txtHrPractice']):null;
//---------------------------------------------
$companyId           = isset($userCompanyId)?$userCompanyId:null;
$createdBy           = isset($userId)?$userId:null;
$lastModifiedBy           = isset($userId)?$userId:null;
$deletedBy           = isset($userId)?$userId:null;
//$details = json_decode($_REQUEST['detailList'], true);


// =======================================================
//         Insert
// =======================================================
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
    $sql = "select * from institute_information where ins_info_institute_id='$id' ";
    $result = $db->batchQuery($sql);
    if($row = mysqli_fetch_row($result)){
			
      //Update data to transaction header*******************************************
      $sql="update `institute_information`
            set
					ins_date_of_stablishment        	='$txtEstDate',
					ins_br_no    						='$txtBR',
					ins_boi_registration      			='$txtBOI',
					ins_is_group				   	    ='$checkGroup',
					ins_is_individual 	                ='$checkIndividual',
					ins_other							='$txtInsOther',
					ins_is_com_base						='$checkRecSystem',
					ins_is_manual 						='$checkRecKeeping',
					ins_own_other                       ='$txtOwnOther',
					ins_practice_hr						='$txtHrPractice'
          		    where ins_info_institute_id         ='$id'";

    }
    else{
      //Add data to transaction header*******************************************
      $sql="insert into `institute_information`
	  ( ins_info_institute_id,ins_date_of_stablishment,ins_br_no,ins_boi_registration,ins_is_group,ins_is_individual,ins_other,ins_is_com_base,ins_is_manual,ins_own_other,ins_practice_hr, ins_info_company_id,ins_info_created_by, ins_info_created_on)
              values              ('$id','$txtEstDate','$txtBR','$txtBOI','$checkGroup','$checkIndividual','$txtInsOther','$checkRecSystem','$checkRecKeeping','$txtOwnOther','$txtHrPractice' ,'$companyId', '$createdBy', '". time()."')";
    }
    
    $finalResult = $db->batchQuery($sql);
	$entryId=$id;
    
    // ============================   Approval Entry    ================
//    $clsApprove = new cls_approval($db, $userCompanyId, $userLocationId, $userId);
//    $clsApprove->newApprovalEntry($autoNoType, $entryId, $noReference, true);
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Institution Information saved successfully! Proceed to Facilities....';
        $response['no'] 	= $noReference; 
        $response['id'] 	= $instituteId;
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





