<?php
session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

include  "{$backwardSeparator}dataAccess/serverAccessController.php";
$response = [];  
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//--------------------------------------------

$cboRecKeeping           = isset($_REQUEST['cboRecKeeping'])?trim($_REQUEST['cboRecKeeping']):null;
$txtSpecAvailability           = isset($_REQUEST['txtSpecAvailability'])?trim($_REQUEST['txtSpecAvailability']):null;
$cboLabFacility           = isset($_REQUEST['cboLabFacility'])?trim($_REQUEST['cboLabFacility']):null;
$txtXray           = isset($_REQUEST['txtXray'])?trim($_REQUEST['txtXray']):null;
$cboEmgKit           = isset($_REQUEST['cboEmgKit'])?trim($_REQUEST['cboEmgKit']):null;
$cboIfOtherFacility           = isset($_REQUEST['cboIfOtherFacility'])?trim($_REQUEST['cboIfOtherFacility']):null;
$cboOwnership           = isset($_REQUEST['cboOwnership'])?trim($_REQUEST['cboOwnership']):null;
$cboPracticing           = isset($_REQUEST['cboPracticing'])?trim($_REQUEST['cboPracticing']):null;
$txtSpeciality           = isset($_REQUEST['txtSpeciality'])?trim($_REQUEST['txtSpeciality']):null;
$txtDisposalMethod           = isset($_REQUEST['txtDisposalMethod'])?trim($_REQUEST['txtDisposalMethod']):null;
$txtStiMethod           = isset($_REQUEST['txtStiMethod'])?trim($_REQUEST['txtStiMethod']):null;


//---------------------------------------------
$status           = isset($_REQUEST['cboStatus'])?trim($_REQUEST['cboStatus']):null;
$companyId           = isset($userCompanyId)?$userCompanyId:null;
$createdBy           = isset($userId)?$userId:null;
$lastModifiedBy           = isset($userId)?$userId:null;
$deletedBy           = isset($userId)?$userId:null;


$sergDetail = json_decode($_REQUEST['sergDetail'], true);
$communication = json_decode($_REQUEST['communication'], true);
$quelification = json_decode($_REQUEST['quelification'], true);

if($requestType=='edit'){
  try{
    $db->begin();  
    if(!$intEditx){
      throw new exception('Permission is Denied ...');
    }
    
      $sql="update `fpds_institute_information`
            set
					ins_info_record_keeping_id        			  ='$cboRecKeeping',
					ins_info_visiting_speciality_availability     ='$txtSpecAvailability',
					ins_info_dental_lab_facility      			  ='$cboLabFacility',
					ins_info_x_ray_facility						  ='$txtXray',
					ins_info_emargancy_kit_availability 	      ='$cboEmgKit',
					ins_info_other_facility						  ='$cboIfOtherFacility',
					ins_info_owner								  ='$cboOwnership',
					ins_info_practice_type						  ='$cboPracticing',
					ins_info_speciality 						  ='$txtSpeciality',
					ins_info_disposal_method					  ='$txtDisposalMethod',
					ins_info_instruments_dressings				  ='$txtStiMethod'
          		    where ins_info_institute_id='$id' and ins_info_company_id='$userCompanyId'";
    
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;  
    
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Institution Information saved successfully! Proceed to Facilities....';
        $response['no'] 	= $noReference; 
        $response['id'] 	= $entryId;
        $db->commit();
        
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

echo json_encode($response);    
?>





