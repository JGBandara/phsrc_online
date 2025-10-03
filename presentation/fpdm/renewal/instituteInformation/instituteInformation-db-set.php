<?php
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

$cboRecKeeping           = isset($_REQUEST['cboRecKeeping'])?trim($_REQUEST['cboRecKeeping']):null;
$txtSpecAvailability           = isset($_REQUEST['txtSpecAvailability'])?trim($_REQUEST['txtSpecAvailability']):null;
$txtXray           = isset($_REQUEST['txtXray'])?trim($_REQUEST['txtXray']):null;
$cboEmgKit           = isset($_REQUEST['cboEmgKit'])?trim($_REQUEST['cboEmgKit']):null;
$cboIfOtherFacility           = isset($_REQUEST['cboIfOtherFacility'])?trim($_REQUEST['cboIfOtherFacility']):null;
$cboOwnership           = isset($_REQUEST['cboOwnership'])?trim($_REQUEST['cboOwnership']):null;
$cboPracticing           = isset($_REQUEST['cboPracticing'])?trim($_REQUEST['cboPracticing']):null;
$txtSpeciality           = isset($_REQUEST['txtSpeciality'])?trim($_REQUEST['txtSpeciality']):null;
$txtDisposalMethod           = isset($_REQUEST['txtDisposalMethod'])?trim($_REQUEST['txtDisposalMethod']):null;
$txtStiMethod           = isset($_REQUEST['txtStiMethod'])?trim($_REQUEST['txtStiMethod']):null;
$cboAvAppoimentSystem           = isset($_REQUEST['cboAvAppoimentSystem'])?trim($_REQUEST['cboAvAppoimentSystem']):null;


//---------------------------------------------
$status           = isset($_REQUEST['cboStatus'])?trim($_REQUEST['cboStatus']):null;
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
    $sql = "select * from fpdm_institute_information where ins_info_institute_id='$id' and ins_info_company_id='$userCompanyId'";
    $result = $db->batchQuery($sql);
    if($row = mysqli_fetch_row($result)){
      //Update data to transaction header*******************************************
      $sql="update `fpdm_institute_information`
            set
					ins_info_record_keeping_id        			  ='$cboRecKeeping',
					ins_info_visiting_speciality_availability     ='$txtSpecAvailability',
					ins_info_x_ray_facility						  ='$txtXray',
					ins_info_emargancy_kit_availability 	      ='$cboEmgKit',
					ins_info_other_facility						  ='$cboIfOtherFacility',
					ins_info_owner								  ='$cboOwnership',
					ins_info_practice_type						  ='$cboPracticing',
					ins_info_speciality 						  ='$txtSpeciality',
					ins_info_disposal_method					  ='$txtDisposalMethod',
					ins_info_instruments_dressings				  ='$txtStiMethod',
					ins_info_appoinment_system				  ='$cboAvAppoimentSystem'
          		    where ins_info_institute_id='$id' and ins_info_company_id='$userCompanyId'";

    }
    else{
      //Add data to transaction header*******************************************
      $sql="insert into `fpdm_institute_information`
            ( ins_info_institute_id,ins_info_record_keeping_id,ins_info_visiting_speciality_availability,ins_info_x_ray_facility,ins_info_emargancy_kit_availability,ins_info_other_facility,ins_info_owner,ins_info_practice_type,ins_info_speciality,ins_info_disposal_method,ins_info_instruments_dressings,ins_info_appoinment_system,ins_info_status, ins_info_company_id, ins_info_created_by, ins_info_created_on)
              values              ('$id','$cboRecKeeping','$txtSpecAvailability','$cboLabFacility','$txtXray','$cboEmgKit','$cboIfOtherFacility','$cboOwnership','$cboPracticing','$txtSpeciality','$txtDisposalMethod','$txtStiMethod','$cboAvAppoimentSystem','1', '$companyId', '$createdBy', '". time()."')";

    }
    
    $finalResult = $db->batchQuery($sql);
    
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





